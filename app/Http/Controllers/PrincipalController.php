<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PrincipalController extends Controller
{
    public function index()
    {
        $baseQuery = User::join('user_in_services', 'users.id', '=', 'user_in_services.userId')
            ->join('user_service_appointments', 'user_service_appointments.userServiceId', '=', 'user_in_services.id')
            ->join('user_service_appointment_positions', 'user_service_appointment_positions.userServiceAppointmentId', '=', 'user_service_appointments.id')
            ->join('positions', 'user_service_appointment_positions.positionId', '=', 'positions.id')
            ->join('personal_infos', 'personal_infos.userId', '=', 'users.id')
            ->where('user_in_services.active', 1)
            ->where('user_in_services.serviceId', 3)
            ->where('user_service_appointments.active', 1)
            ->where('user_service_appointment_positions.current', 1)
            ->whereNull('user_service_appointments.releasedDate')
            ->whereNull('user_in_services.releasedDate')
            ->where('user_service_appointments.workPlaceId', session('workPlaceId'));

        // 🔹 First 5 principals approaching retirement
        $principals = (clone $baseQuery)
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
        $totalPrincipals = (clone $baseQuery)->count();

        $malePrincipals = (clone $baseQuery)
            ->where('personal_infos.genderId', 1)
            ->count();

        $femalePrincipals = (clone $baseQuery)
            ->where('personal_infos.genderId', 2)
            ->count();

        if ($malePrincipals == 0 && $femalePrincipals == 0) {
            $maleToFemaleRatio = "0:0"; // no Principals
        } elseif ($femalePrincipals == 0) {
            $maleToFemaleRatio = $malePrincipals . ":0"; // only males
        } elseif ($malePrincipals == 0) {
            $maleToFemaleRatio = "0:" . $femalePrincipals; // only females
        } else {
            // Simplify ratio using gcd
            $gcd = function($a, $b) use (&$gcd) {
                return $b == 0 ? $a : $gcd($b, $a % $b);
            };
            $divisor = $gcd($malePrincipals, $femalePrincipals);
            $maleToFemaleRatio = ($malePrincipals / $divisor) . ":" . ($femalePrincipals / $divisor);
        }

        $option = [
            'Dashboard' => route('dashboard'),
            'Principal Dashboard' => null
        ];

        return view('employer.principal.dashboard', compact(
            'option',
            'principals',
            'totalPrincipals',
            'malePrincipals',
            'femalePrincipals',
            'maleToFemaleRatio'
        ));
    }
}
