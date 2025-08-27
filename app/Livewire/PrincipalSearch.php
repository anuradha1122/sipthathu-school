<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class PrincipalSearch extends Component
{

    public $search = '';
    public function mount()
    {

    }

    public function render()
    {
        $results = collect(); // empty collection by default

        if (strlen($this->search) >= 2) {
            $results = User::join('user_in_services', 'users.id', '=', 'user_in_services.userId')
                ->join('user_service_appointments', 'user_in_services.id', '=', 'user_service_appointments.userServiceId')
                ->leftjoin('personal_infos', 'users.id', '=', 'personal_infos.userId')
                ->when($this->search, function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('users.name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('users.nic', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('users.nameWithInitials', 'LIKE', '%' . $this->search . '%');
                    });
                })
                ->where('user_service_appointments.current', 1)
                ->whereNull('user_service_appointments.releasedDate')
                ->where('user_service_appointments.workPlaceId', session('workPlaceId'))
                ->where('user_in_services.serviceId', 3)
                ->select('users.*', 'personal_infos.profilePicture')
                ->paginate(6);

            $results->getCollection()->transform(function ($item) {
                $item->usId = Crypt::encryptString($item->id);
                return $item;
            });
        }

        return view('livewire.principal-search', [
            'searchResults' => $results
        ]);
    }
}
