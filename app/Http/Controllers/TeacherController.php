<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTeacherFullReportRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\UserInService;
use App\Models\UserServiceAppointment;
use App\Models\UserServiceAppointmentPosition;
use App\Models\EducationQualification;
use App\Models\ProfessionalQualification;
use App\Models\FamilyInfo;

class TeacherController extends Controller
{
    public function index()
    {

        $option = [
            'Dashboard' => route('dashboard'),
            'Teacher Dashboard' => null
        ];

        //dd($teacherCounts);
        return view('employer.teacher.dashboard',compact('option'));
    }

    public function reportlist()
    {
        $option = [
            'Dashboard' => route('dashboard'),
            'Teacher Dashboard' => route('teacher.dashboard'),
            'Teacher Reports' => null
        ];

        return view('employer.teacher.reportlist',compact('option'));
    }

    public function fullreportcurrent()
    {
        $results =[];
        $option = [
            'Dashboard' => route('dashboard'),
            'Teacher Dashboard' => route('teacher.dashboard'),
            'Teacher Reports' => route('teacher.reportlist'),
            'Teacher Full Report' => null,
        ];
        return view('employer.teacher.fullreportcurrent',compact('option', 'results'));
    }

    public function search()
    {
        $option = [
            'Dashboard' => route('dashboard'),
            'Teacher Dashboard' => route('teacher.dashboard'),
            'Teacher Search' => null
        ];
        return view('employer.teacher.search',compact('option'));
    }


    public function profile(Request $request)
    {
        if($request->has('id')){
            try{

                $option = [
                    'Dashboard' => 'dashboard',
                    'Teacher Dashboard' => 'teacher.dashboard',
                    'Teacher Search' => 'teacher.search',
                    'Teacher Profile' => route('teacher.profile', ['id' => $request->id]),
                ];

                $decryptedId = Crypt::decryptString($request->id);
                //dd($decryptedId);
                $teacher = User::leftjoin('personal_infos', 'users.id', '=', 'personal_infos.userId')
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
                if ($teacher) {
                    $teacher->cryptedId = $request->id;
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
                        $servicePeriod = "from {$item->appointedDate} to " . ($item->releasedDate ?? 'present');
                        return [
                            'userServiceId' => $item->userServiceId,
                            'formattedService' => "{$item->serviceName} {$servicePeriod}",
                        ];
                    }); // Keep as a collection

                // Extract current service IDs
                $currentServiceIds = $currentService->pluck('userServiceId');

                // If you need to convert $currentService to an array for Blade:
                $currentServiceArray = $currentService->pluck('formattedService', 'userServiceId')->toArray();


                $previousServices = $partitionedData[1]
                ->unique('userServiceId')
                ->map(function ($item) {
                    $servicePeriod = "from {$item->appointedDate} to " . ($item->releasedDate ?? 'present');
                    return [
                        'userServiceId' => $item->userServiceId,
                        'formattedService' => "{$item->serviceName} {$servicePeriod}",
                    ];
                }); // Keep as a collection

                $previousServiceIds = $previousServices->pluck('userServiceId');

                // If you need to convert $previousServices to an array for Blade:
                $previousServicesArray = $previousServices->pluck('formattedService', 'userServiceId')->toArray();


                $currentServiceRanks = $combinedData->filter(function ($item) use ($currentServiceIds) {
                    return $currentServiceIds->contains($item->userServiceId) && !is_null($item->serviceRankId);
                })->map(function ($item) {
                    $rankPeriod = "from {$item->rankedDate}";
                    return [
                        'userServiceId' => $item->userServiceId,
                        'formattedRank' => "{$item->rank} {$rankPeriod}",
                    ];
                });
                //dd($currentServiceRanks);
                // Convert to an array for Blade if needed
                $currentServiceRanksArray = $currentServiceRanks->pluck('formattedRank')->toArray();
                //dd($currentServiceRanksArray);
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

                // Partition appointments into categories based on their attributes
                $appointmentsPartitioned = $appointments->groupBy(function ($appointment) {
                if (is_null($appointment->releasedDate)) {
                    return $appointment->appointmentType == 1 ? 'currentAppointments' : 'currentAttachAppointments';
                } elseif (!is_null($appointment->releasedDate)) {
                    return $appointment->appointmentType == 1 ? 'previousAppointments' : 'previousAttachAppointments';
                }
                return null; // Ignore other cases
                });

                // Map the partitions to IDs
                $currentAppointmentIds = $appointmentsPartitioned->get('currentAppointments', collect())->pluck('id')->toArray();
                $previousAppointmentIds = $appointmentsPartitioned->get('previousAppointments', collect())->pluck('id')->toArray();
                $currentAttachAppointmentIds = $appointmentsPartitioned->get('currentAttachAppointments', collect())->pluck('id')->toArray();
                $previousAttachAppointmentIds = $appointmentsPartitioned->get('previousAttachAppointments', collect())->pluck('id')->toArray();

                // Format and return results for each category
                $currentAppointments = $appointmentsPartitioned->get('currentAppointments', collect())
                ->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'formattedAppointment' => "{$appointment->workPlaceName} from {$appointment->appointedDate}",
                    ];
                })->pluck('formattedAppointment', 'id')->toArray();

                $previousAppointments = $appointmentsPartitioned->get('previousAppointments', collect())
                ->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'formattedAppointment' => "{$appointment->workPlaceName} from {$appointment->appointedDate} to {$appointment->releasedDate}",
                    ];
                })->pluck('formattedAppointment', 'id')->toArray();

                $currentAttachAppointments = $appointmentsPartitioned->get('currentAttachAppointments', collect())
                ->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'formattedAppointment' => "{$appointment->workPlaceName} from {$appointment->appointedDate}",
                    ];
                })->pluck('formattedAppointment', 'id')->toArray();

                $previousAttachAppointments = $appointmentsPartitioned->get('previousAttachAppointments', collect())
                ->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'formattedAppointment' => "{$appointment->workPlaceName} from {$appointment->appointedDate} to {$appointment->releasedDate}",
                    ];
                })->pluck('formattedAppointment', 'id')->toArray();


                $positions = UserServiceAppointmentPosition::join('positions', 'user_service_appointment_positions.positionId', '=', 'positions.id')
                    ->whereIn('user_service_appointment_positions.userServiceAppointmentId', array_merge(
                        $currentAppointmentIds,
                        $previousAppointmentIds,
                        $currentAttachAppointmentIds,
                        $previousAttachAppointmentIds
                    ))
                    ->select(
                        'user_service_appointment_positions.*',
                        'positions.name AS position'
                    )
                    ->get();

                // Partition positions into categories based on appointment IDs
                $positionsPartitioned = $positions->groupBy(function ($position) use (
                    $currentAppointmentIds,
                    $previousAppointmentIds,
                    $currentAttachAppointmentIds,
                    $previousAttachAppointmentIds,
                ) {
                    if (in_array($position->userServiceAppointmentId, $currentAppointmentIds)) {
                        return 'currentPositions';
                    } elseif (in_array($position->userServiceAppointmentId, $previousAppointmentIds)) {
                        return 'previousPositions';
                    } elseif (in_array($position->userServiceAppointmentId, $currentAttachAppointmentIds)) {
                        return 'currentAttachPositions';
                    } elseif (in_array($position->userServiceAppointmentId, $previousAttachAppointmentIds)) {
                        return 'previousAttachPositions';
                    }
                    return null; // Ignore other cases
                });

                // Map the partitions to structured data
                $currentPositions = $positionsPartitioned->get('currentPositions', collect())
                    ->map(function ($position) {
                        return [
                            'id' => $position->id,
                            'positionName' => $position->position,
                            'details' => $position->toArray(),
                        ];
                })->values();

                $previousPositions = $positionsPartitioned->get('previousPositions', collect())
                    ->map(function ($position) {
                        return [
                            'id' => $position->id,
                            'positionName' => $position->position,
                            'details' => $position->toArray(),
                        ];
                })->values();

                $currentAttachPositions = $positionsPartitioned->get('currentAttachPositions', collect())
                    ->map(function ($position) {
                        return [
                            'id' => $position->id,
                            'positionName' => $position->position,
                            'details' => $position->toArray(),
                        ];
                })->values();

                $previousAttachPositions = $positionsPartitioned->get('previousAttachPositions', collect())
                    ->map(function ($position) {
                        return [
                            'id' => $position->id,
                            'positionName' => $position->position,
                            'details' => $position->toArray(),
                        ];
                })->values();


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

                //dd($family);

                //dd($family);
                return view('employer.teacher.profile', compact(
                    'teacher',
                    'currentServiceArray',
                    'previousServicesArray',
                    'currentServiceRanksArray',
                    'previousServiceRanksArray',
                    'currentAppointments',
                    'previousAppointments',
                    'currentAttachAppointments',
                    'previousAttachAppointments',
                    'currentPositions',
                    'previousPositions',
                    'currentAttachPositions',
                    'previousAttachPositions',
                    'educationQualifications',
                    'professionalQualifications',
                    'family',
                    'option'
                ));


            }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Redirect to the search page or show an error message for invalid ID
                return redirect()->route('teacher.search')->with('error', 'Invalid teacher ID provided.');
            }

        }else{
            return redirect()->route('teacher.search');
        }
    }
    // public function profile()
    // {
    //     return view('employer.teacher.profile');
    // }

    public function transferApplication()
    {
        return view('employer.teacher.teacher-transfer-application');
    }

    public function transferApplicationStatus()
    {
        return view('employer.teacher.teacher-transfer-application-status');
    }
}
