<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Models\Race;
use App\Models\Religion;
use App\Models\CivilStatus;
use App\Models\District;
use App\Models\SchoolAuthority;
use App\Models\SchoolEthnicity;
use App\Models\SchoolClass;
use App\Models\SchoolDensity;
use App\Models\SchoolFacility;
use App\Models\SchoolGender;
use App\Models\SchoolLanguage;

class PrincipalFullReport extends Component
{
    use WithPagination;

    public $race;
    public $religion;
    public $civilStatus;
    public $gender;
    public $birthDayStart;
    public $birthDayEnd;
    public $serviceStart;
    public $serviceEnd;
    public $schoolAppointStart;
    public $schoolAppointEnd;

    public $raceList;
    public $religionList;
    public $civilStatusList;
    public $genderList;

    public $showResults = false; // only show results after submit

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        // Load filter lists
        $this->raceList = Race::where('active', 1)->pluck('name', 'id');
        $this->religionList = Religion::where('active', 1)->pluck('name', 'id');
        $this->civilStatusList = CivilStatus::where('active', 1)->pluck('name', 'id');
        $this->genderList = collect([
            1 => 'Male',
            2 => 'Female',
        ]);
    }

    public function submit()
    {
        $this->resetPage(); // Reset pagination when new search is submitted
        $this->showResults = true; // display results
    }

    public function getResultsProperty()
    {
        if (!$this->showResults) {
            return collect();
        }

        $results = DB::table('users')
        ->join('personal_infos', function ($join) {
            $join->on('users.id', '=', 'personal_infos.userId')
                 ->where('personal_infos.active', 1);
        })
        ->leftJoin('civil_statuses', function ($join) {
            $join->on('personal_infos.civilStatusId', '=', 'civil_statuses.id')
                 ->where('civil_statuses.active', 1);
        })
        ->leftJoin('religions', function ($join) {
            $join->on('personal_infos.religionId', '=', 'religions.id')
                 ->where('religions.active', 1);
        })
        ->leftJoin('races', function ($join) {
            $join->on('personal_infos.raceId', '=', 'races.id')
                 ->where('races.active', 1);
        })
        ->leftJoin('user_in_services', function ($join) {
            $join->on('user_in_services.userId', '=', 'users.id')
                 ->where('user_in_services.active', 1)
                 ->where('user_in_services.serviceId', 3);
        })
        ->leftJoin('user_service_appointments', function ($join) {
            $join->on('user_service_appointments.userServiceId', '=', 'user_in_services.id')
                 ->where('user_service_appointments.active', 1)
                 ->where('user_service_appointments.current', 1)
                 ->whereNull('user_service_appointments.releasedDate');
        })
        ->leftJoin('work_places', function ($join) {
            $join->on('user_service_appointments.workPlaceId', '=', 'work_places.id')
                 ->where('work_places.active', 1);
        })
        ->leftJoin('schools', function ($join) {
            $join->on('schools.workPlaceId', '=', 'work_places.id')
                 ->where('schools.active', 1);
        })
        ->when($this->race, fn($query) => $query->where('personal_infos.raceId', $this->race))
        ->when($this->religion, fn($query) => $query->where('personal_infos.religionId', $this->religion))
        ->when($this->civilStatus, fn($query) => $query->where('personal_infos.civilStatusId', $this->civilStatus))
        ->when($this->gender, fn($query) => $query->where('personal_infos.genderId', $this->gender))
        ->when($this->birthDayStart && $this->birthDayEnd, fn($query) =>
            $query->whereBetween('personal_infos.birthDay', [$this->birthDayStart, $this->birthDayEnd])
        )
        ->when($this->serviceStart && $this->serviceEnd, fn($query) =>
            $query->whereBetween('user_in_services.appointedDate', [$this->serviceStart, $this->serviceEnd])
        )
        ->when($this->schoolAppointStart && $this->schoolAppointEnd, fn($query) =>
            $query->whereBetween('user_service_appointments.appointedDate', [$this->schoolAppointStart, $this->schoolAppointEnd])
        )
        ->when(session('schoolId'), fn($query) => $query->where('schools.id', session('schoolId')))
        ->select(
            'users.id', // ✅ Needed for encrypt
            'users.name AS userName',
            'users.nameWithInitials',
            'users.nic',
            'users.email',
            'races.name AS race',
            'religions.name AS religion',
            'civil_statuses.name AS civilStatus',
            DB::raw("CASE
                WHEN personal_infos.genderId = 1 THEN 'Male'
                WHEN personal_infos.genderId = 2 THEN 'Female'
                ELSE 'Other'
             END AS gender"),
            'personal_infos.birthDay'
        )
        ->orderBy('personal_infos.birthDay', 'DESC')
        ->orderBy('users.name', 'DESC')
        ->paginate(10);

        $results->getCollection()->transform(function ($item) {
            $item->usId = Crypt::encryptString($item->id);
            return $item;
        });

        return $results; // ✅ Important
    }


    public function render()
    {
        return view('livewire.principal-full-report', [
            'results' => $this->results, // access computed property
        ]);
    }
}
