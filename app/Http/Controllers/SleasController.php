<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateSleasRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\UserInService;
use App\Models\UserServiceAppointment;
use App\Models\UserServiceAppointmentPosition;
use App\Models\EducationQualification;
use App\Models\ProfessionalQualification;
use App\Models\FamilyInfo;
use App\Models\Position;

class SleasController extends Controller
{
    public function index()
    {
        $baseQuery = User::join('user_in_services', 'users.id', '=', 'user_in_services.userId')
            ->join('user_service_appointments', 'user_service_appointments.userServiceId', '=', 'user_in_services.id')
            ->join('user_service_appointment_positions', 'user_service_appointment_positions.userServiceAppointmentId', '=', 'user_service_appointments.id')
            ->join('positions', 'user_service_appointment_positions.positionId', '=', 'positions.id')
            ->join('personal_infos', 'personal_infos.userId', '=', 'users.id')
            ->where('user_in_services.active', 1)
            ->where('user_in_services.serviceId', 4)
            ->where('user_service_appointments.active', 1)
            ->where('user_service_appointment_positions.current', 1)
            ->whereNull('user_service_appointments.releasedDate')
            ->whereNull('user_in_services.releasedDate')
            ->where('user_service_appointments.workPlaceId', session('workPlaceId'));

        // 🔹 First 5 sleass approaching retirement
        $sleass = (clone $baseQuery)
            ->select(
                'users.id AS userId',
                'users.name',
                'users.nic',
                'users.email',
                'users.nameWithInitials',
                'user_in_services.appointedDate',
                'user_service_appointments.appointedDate AS appointmentDate',
                'user_service_appointment_positions.positionId',
                'personal_infos.birthday',
                'positions.name AS positionName',
                DB::raw('DATE_ADD(personal_infos.birthday, INTERVAL 60 YEAR) AS retirementDate')
            )
            ->orderBy('retirementDate', 'asc')
            ->limit(5)
            ->get();

        // 🔹 Teacher counts
        $totalSleass = (clone $baseQuery)->count();

        $maleSleass = (clone $baseQuery)
            ->where('personal_infos.genderId', 1)
            ->count();

        $femaleSleass = (clone $baseQuery)
            ->where('personal_infos.genderId', 2)
            ->count();

        if ($maleSleass == 0 && $femaleSleass == 0) {
            $maleToFemaleRatio = "0:0"; // no Sleass
        } elseif ($femaleSleass == 0) {
            $maleToFemaleRatio = $maleSleass . ":0"; // only males
        } elseif ($maleSleass == 0) {
            $maleToFemaleRatio = "0:" . $femaleSleass; // only females
        } else {
            // Simplify ratio using gcd
            $gcd = function($a, $b) use (&$gcd) {
                return $b == 0 ? $a : $gcd($b, $a % $b);
            };
            $divisor = $gcd($maleSleass, $femaleSleass);
            $maleToFemaleRatio = ($maleSleass / $divisor) . ":" . ($femaleSleass / $divisor);
        }

        return view('employer.sleas.dashboard', compact(
            'sleass',
            'totalSleass',
            'maleSleass',
            'femaleSleass',
            'maleToFemaleRatio'
        ));
    }

    public function reportlist()
    {
        return view('employer.sleas.reportlist');
    }

    public function fullreportcurrent()
    {
        $results =[];
        return view('employer.sleas.fullreportcurrent',compact('results'));
    }

    public function profile(Request $request)
    {
        //dd($request->all());
        if($request->has('id')){
            try{

                $decryptedId = Crypt::decryptString($request->id);
                //dd($decryptedId);
                $sleas = User::leftjoin('personal_infos', 'users.id', '=', 'personal_infos.userId')
                ->leftjoin('races', 'personal_infos.raceId', '=', 'races.id')
                ->leftjoin('religions', 'personal_infos.religionId', '=', 'religions.id')
                ->leftjoin('civil_statuses', 'personal_infos.civilStatusId', '=', 'civil_statuses.id')
                ->leftjoin('contact_infos', 'users.id', '=', 'contact_infos.userId')
                ->leftjoin('location_infos', 'users.id', '=', 'location_infos.userId')
                ->leftJoin('offices', 'location_infos.educationDivisionId', '=', 'offices.id')
                ->leftJoin('work_places AS educationDivisions', 'offices.workPlaceId', '=', 'educationDivisions.id')
                ->leftjoin('gn_divisions', 'location_infos.gnDivisionId', '=', 'gn_divisions.id')
                ->leftjoin('ds_divisions', 'gn_divisions.dsId', '=', 'ds_divisions.id')
                ->leftjoin('districts', 'ds_divisions.districtId', '=', 'districts.id')
                ->leftjoin('provinces', 'districts.provinceId', '=', 'provinces.id')
                ->where('users.id', $decryptedId)
                ->select(
                    'users.id AS userId','users.name AS name','users.nic','users.email','users.nameWithInitials',
                    'personal_infos.birthDay','personal_infos.profilePicture',
                    DB::raw("CASE
                        WHEN personal_infos.genderId = 1 THEN 'Male'
                        WHEN personal_infos.genderId = 2 THEN 'Female'
                        ELSE 'Unknown'
                    END AS gender"),
                    'races.name AS race',
                    'religions.name AS religion',
                    'civil_statuses.name AS civilStatus',
                    'contact_infos.*',
                    'educationDivisions.name AS educationDivision',
                    'gn_divisions.name AS gnDivision',
                    'ds_divisions.name AS dsDivision',
                    'districts.name AS district',
                    'provinces.name AS province',
                )
                ->first();
                if ($sleas) {
                    $sleas->cryptedId = $request->id;
                }

                $combinedData = UserInService::join('services', function ($join) {
                        $join->on('user_in_services.serviceId', '=', 'services.id')
                            ->where('services.active', 1);
                    })
                    ->leftJoin('user_service_in_ranks', function ($join) {
                        $join->on('user_in_services.id', '=', 'user_service_in_ranks.userServiceId')
                            ->where('user_service_in_ranks.active', 1);
                    })
                    ->leftJoin('ranks', function ($join) {
                        $join->on('user_service_in_ranks.rankId', '=', 'ranks.id')
                            ->where('ranks.active', 1);
                    })
                    ->where('user_in_services.userId', $decryptedId)
                    ->where('user_in_services.active', 1)
                    ->select(
                        'user_in_services.id AS userServiceId',
                        'user_in_services.appointedDate',
                        'user_in_services.releasedDate',
                        'user_in_services.current AS currentService',
                        'services.name AS serviceName',
                        'user_service_in_ranks.id AS serviceRankId',
                        'user_service_in_ranks.rankId',
                        'user_service_in_ranks.rankedDate',
                        'user_service_in_ranks.current AS currentRank',
                        'ranks.name AS rank'
                    )
                    ->get();


                // Partition services into current and previous
                $partitionedData = $combinedData->partition(function ($item) {
                    return $item->currentService == 1 && is_null($item->releasedDate);
                });

                // Get distinct current services (no ranks)
                $currentService = $partitionedData[0]
                    ->unique('userServiceId')
                    ->map(function ($item) {
                        return [
                            'userServiceId' => $item->userServiceId,
                            'serviceName' => $item->serviceName,
                            'appointedDate' => $item->appointedDate,
                        ];
                    }); // Keep as a collection

                // Extract current service IDs
                $currentServiceIds = $currentService->pluck('userServiceId');

                $previousServices = $partitionedData[1]
                ->unique('userServiceId')
                ->map(function ($item) {
                    $servicePeriod = "from {$item->appointedDate} to " . ($item->releasedDate ?? 'present');
                    return [
                        'userServiceId' => $item->userServiceId,
                        'serviceName' => $item->serviceName,
                        'servicePeriod' => $servicePeriod,
                    ];
                }); // Keep as a collection
                //dd($previousServices);
                $previousServiceIds = $previousServices->pluck('userServiceId');

                $currentServiceRanks = $combinedData->filter(function ($item) use ($currentServiceIds) {
                    return $currentServiceIds->contains($item->userServiceId) && !is_null($item->serviceRankId);
                })->map(function ($item) {
                    return [
                        'userServiceId' => $item->userServiceId,
                        'rank' => $item->rank,
                        'rankedDate' => $item->rankedDate,
                    ];
                });

                $previousServiceRanks = $combinedData->filter(function ($item) use ($previousServiceIds) {
                    return $previousServiceIds->contains($item->userServiceId) && !is_null($item->serviceRankId);
                })->map(function ($item) {
                    $rankPeriod = "from {$item->rankedDate}";
                    return [
                        'userServiceId' => $item->userServiceId,
                        'formattedRank' => "{$item->rank} {$rankPeriod}",
                    ];
                });


                // Convert to an array for Blade if needed
                $previousServiceRanksArray = $previousServiceRanks->pluck('formattedRank', 'userServiceId')->toArray();
                //dd($previousServiceRanksArray);

                // Fetch appointments and categorize them into current and previous based on the service IDs
                $appointments = UserServiceAppointment::join('work_places', 'user_service_appointments.workPlaceId', '=', 'work_places.id')
                    ->whereIn('user_service_appointments.userServiceId', $currentServiceIds)
                    ->orWhereIn('user_service_appointments.userServiceId', $previousServiceIds)
                    ->select(
                        'user_service_appointments.*',
                        'work_places.name AS workPlaceName',
                        'work_places.censusNo AS censusNo',
                        'work_places.categoryId AS workPlaceCategory'
                    )
                    ->get();

                // Categorize appointments
                $categorizedAppointments = [
                    'currentAppointment' => $appointments->filter(fn($a) => is_null($a->releasedDate) && $a->appointmentType == 1)
                        ->map(fn($a) => (object) [
                            'id' => $a->id,
                            'workPlaceName' => $a->workPlaceName,
                            'censusNo' => $a->censusNo,
                            'category' => $a->workPlaceCategory,
                            'appointedDate' => $a->appointedDate,
                            'releasedDate' => $a->releasedDate,
                        ])->values(),

                    'previousAppointment' => $appointments->filter(fn($a) => !is_null($a->releasedDate) && $a->appointmentType == 1)
                        ->map(fn($a) => (object) [
                            'id' => $a->id,
                            'workPlaceName' => $a->workPlaceName,
                            'censusNo' => $a->censusNo,
                            'category' => $a->workPlaceCategory,
                            'appointedDate' => $a->appointedDate,
                            'releasedDate' => $a->releasedDate,
                        ])->values(),

                    'currentAttachedAppointment' => $appointments->filter(fn($a) => is_null($a->releasedDate) && $a->appointmentType == 2)
                        ->map(fn($a) => (object) [
                            'id' => $a->id,
                            'workPlaceName' => $a->workPlaceName,
                            'censusNo' => $a->censusNo,
                            'category' => $a->workPlaceCategory,
                            'appointedDate' => $a->appointedDate,
                            'releasedDate' => $a->releasedDate,
                        ])->values(),

                    'previousAttachedAppointment' => $appointments->filter(fn($a) => !is_null($a->releasedDate) && $a->appointmentType == 2)
                        ->map(fn($a) => (object) [
                            'id' => $a->id,
                            'workPlaceName' => $a->workPlaceName,
                            'censusNo' => $a->censusNo,
                            'category' => $a->workPlaceCategory,
                            'appointedDate' => $a->appointedDate,
                            'releasedDate' => $a->releasedDate,
                        ])->values(),
                ];

                // Get current appointment (only one)
                $currentAppointment = $appointments
                ->first(fn($a) => is_null($a->releasedDate) && $a->appointmentType == 1);

                if ($currentAppointment) {
                // Get its current position
                $currentPosition = UserServiceAppointmentPosition::join(
                        'positions',
                        'user_service_appointment_positions.positionId',
                        '=',
                        'positions.id'
                    )
                    ->where('user_service_appointment_positions.userServiceAppointmentId', $currentAppointment->id)
                    ->where('user_service_appointment_positions.current', 1)
                    ->select('positions.name as positionName')
                    ->first();

                // Attach position to appointment object
                $currentAppointment->position = $currentPosition->positionName ?? null;
                }

                //dd($categorizedAppointments);



                $educationQualifications = EducationQualification::join('education_qualification_infos', 'education_qualification_infos.educationQualificationId', '=', 'education_qualifications.id')
                ->where('education_qualification_infos.userId', $decryptedId)
                ->where('education_qualification_infos.active', 1)
                ->where('education_qualifications.active', 1)
                ->select('education_qualifications.name','education_qualification_infos.effectiveDate')
                ->get();
                //dd($educationQualifications);

                $professionalQualifications = professionalQualification::join('professional_qualification_infos', 'professional_qualification_infos.professionalQualificationId', '=', 'professional_qualifications.id')
                ->where('professional_qualification_infos.userId', $decryptedId)
                ->where('professional_qualification_infos.active', 1)
                ->where('professional_qualifications.active', 1)
                ->select('professional_qualifications.name', 'professional_qualification_infos.effectiveDate')
                ->get();

                $family = FamilyInfo::leftJoin('family_member_types', 'family_infos.memberType', '=', 'family_member_types.id')
                ->where('family_infos.userId', $decryptedId)
                ->where('family_infos.active', 1)
                ->select('family_infos.*')
                ->get();


                return view('employer.sleas.profile', compact(
                    'sleas',
                    'currentService',
                    'previousServices',
                    'currentServiceRanks',
                    'previousServiceRanksArray',
                    'categorizedAppointments',
                    'currentAppointment',
                    'educationQualifications',
                    'professionalQualifications',
                    'family',
                ));


            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Redirect to the search page or show an error message for invalid ID
                return redirect()->route('sleas.dashboard')->with('error', 'Invalid sleas ID provided.');
            }

        }else{
            return redirect()->route('sleas.dashboard');
        }
    }

    public function profileedit(Request $request)
    {
        if($request->has('id') && $request->has('category')){
            try{

                $decryptedId = Crypt::decryptString($request->id);
                $category = $request->category;

                $sleas = User::find($decryptedId);

                if ($sleas) {
                    $sleas->cryptedId = $request->id;
                }

                $positions = collect([]);
                if($category == 'position')
                {
                    $positions = Position::where('id', '<=', 2)
                     ->where('active', 1)
                     ->get()->pluck('name', 'id');
                }



                return view('employer.sleas.profile-edit', compact(
                    'sleas',
                    'positions',
                    'category',
                ));


            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Redirect to the search page or show an error message for invalid ID
                return redirect()->route('sleas.dashboard')->with('error', 'Invalid sleas ID provided.');
            }

        }else{
            return redirect()->route('sleas.dashboard');
        }
    }

    public function profileupdate(UpdateSleasRequest $request)
    {
        //dd($request->all());
        $category = $request->input('category');
        $userId   = $request->input('userId');


        if ($category === 'position') {
            $positionId = $request->input('position');
            $userData = DB::table('users')
            ->join('user_in_services as uis', 'users.id', '=', 'uis.userId')
            ->join('user_service_appointments as usa', 'uis.id', '=', 'usa.userServiceId')
            ->join('user_service_appointment_positions as usap', 'usa.id', '=', 'usap.userServiceAppointmentId')
            ->where('users.id', $userId)
            ->where('usap.current', 1)
            ->where('usa.releasedDate', null)
            ->where('uis.releasedDate', null)
            ->select(
                'users.id as userId',
                'uis.id as userInServiceId',
                'usa.id as userServiceAppointmentId',
                'usap.id as userServiceAppointmentPositionId',
                'usap.positionId'
            )
            ->first();
            if ($userData) {
                // Update the position
                DB::table('user_service_appointment_positions')
                    ->where('id', $userData->userServiceAppointmentPositionId)
                    ->update(['positionId' => $positionId]);

                return redirect()->back()->with('success', 'Position has been updated successfully.');
            } else {
                return redirect()->back()->with('error', 'No active position found for this Director.');
            }
        }

        if ($category === 'password') {
            $user = User::find($userId);
            if ($user) {


                return redirect()->back()->with('success', 'Password chaging link has been send to email and mobile number.');
            } else {
                return redirect()->back()->with('error', 'User not found.');
            }
        }
    }
}
