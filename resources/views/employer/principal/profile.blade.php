<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
            {{ __('Principal Profile') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="mx-auto sm:px-6 lg:px-8">
            <main class="flex-1 overflow-y-auto">
                <div class="mb-6">
                    <!-- Breadcrumb -->
                    <x-breadcrumb :items="[
                        'Home' => route('dashboard'),
                        'Principal Dashboard' => route('principal.dashboard'),
                        'Profile' => null,
                    ]" />
                </div>

                <div>
                    <div class="mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                        <div class="md:flex">
                            <!-- Principal Image -->
                            <div class="md:w-1/4 p-6 flex justify-center">
                                <div class="relative">
                                    <img class="w-48 h-48 rounded-full object-cover border-4 border-indigo-500"
                                        src="https://images.unsplash.com/photo-1577880216142-8549e9488dad?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                                        alt="Principal profile picture" />
                                </div>
                            </div>

                            <!-- Principal Info -->
                            <div class="md:w-3/4 p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $principal->nameWithInitials.' ['.$principal->nic.']' }}
                                        </h1>
                                        <p class="text-indigo-600 dark:text-indigo-400 font-semibold">Position: {{ $currentAppointment->position }}</p>
                                        </p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('principal.profileedit', [
                                                'id' => $principal->cryptedId,
                                                'category' => 'position'
                                            ]) }}"
                                        class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 p-2 rounded-full hover:bg-indigo-200 dark:hover:bg-indigo-800 inline-flex items-center justify-center">
                                            <i data-lucide="edit"></i>
                                        </a>

                                        {{-- <button
                                            class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 p-2 rounded-full hover:bg-indigo-200 dark:hover:bg-indigo-800">
                                            <i data-lucide="phone-call"></i>
                                        </button> --}}
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-2 gap-2">
                                        <i data-lucide="user"></i>
                                        <span>Full Name: {{ $principal->name }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-2 gap-2">
                                        <i data-lucide="calendar-days"></i>
                                        <span>Date of Birth: {{ \Carbon\Carbon::parse($principal->birthDay)->format('F j, Y') }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-4 gap-2">
                                        <i data-lucide="map-pin"></i>
                                        <span>Permanent Address:
                                            {{ $principal->permAddressLine1 }},
                                            {{ $principal->permAddressLine2 }},
                                            {{ $principal->permAddressLine3 }},
                                        </span>

                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-4 gap-2">
                                        <i data-lucide="map-pin"></i>
                                        <span>Residential Address:
                                            {{ $principal->tempAddressLine1 }},
                                            {{ $principal->tempAddressLine2 }},
                                            {{ $principal->tempAddressLine3 }},
                                        </span>

                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-4 gap-2">
                                        <i data-lucide="mail"></i>
                                        <span>Email: {{ $principal->email }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-4 gap-2">
                                        <i data-lucide="phone-call"></i>
                                        <span>Contact: {{ $principal->mobile1 }} / WhatsApp: {{ $principal->mobile2 }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

                        <!-- Profile Details -->
                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Personal Info -->
                                <div>
                                    <h3
                                        class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-graduation-cap text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Personal Info
                                    </h3>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Race</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $principal->race }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Religion</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $principal->religion }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Civil Status</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $principal->civilStatus }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Gender</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $principal->gender }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Location Info -->
                                <div>
                                    <h3
                                        class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-book text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Location Info
                                    </h3>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $principal->province ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($principal->province)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Province</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $principal->province ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $principal->district ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($principal->district)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">District</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $principal->district ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $principal->dsDivision ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($principal->dsDivision)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">DS Division</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $principal->dsDivision ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $principal->gnDivision ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($principal->gnDivision)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">GN Division</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $principal->gnDivision ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $principal->educationDivision ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($principal->educationDivision)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Res. Education  Division</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $principal->educationDivision ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

                        <!-- Profile Details -->
                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Personal Info -->
                                <div>
                                    <h3
                                        class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-graduation-cap text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Personal Info
                                    </h3>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Race</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $principal->race }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Religion</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $principal->religion }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Civil Status</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $principal->civilStatus }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Gender</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $principal->gender }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Location Info -->
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-book text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Family Info
                                    </h3>

                                    <ul class="space-y-3">
                                        @forelse($family ?? [] as $member)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="users" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $member->memberType == 1 ? 'Wife' : ($member->memberType == 2 ? 'Child' : 'Other') }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Name:</strong> {{ $member->name ?? 'Not Available' }}<br>
                                                        <strong>Profession:</strong> {{ $member->profession ?? 'Not Available' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No family information available.</li>
                                        @endforelse
                                    </ul>
                                </div>


                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

                        <!-- Profile Details -->
                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-graduation-cap text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Education Qualifications
                                    </h3>

                                    <ul class="space-y-3">
                                        @forelse($educationQualifications ?? [] as $qualification)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="award" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $qualification->name ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Effective Date:</strong> {{ $qualification->effectiveDate ?? 'Not Available' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No education qualifications available.</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-graduation-cap text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Professional Qualifications
                                    </h3>

                                    <ul class="space-y-3">
                                        @forelse($professionalQualifications ?? [] as $qualification)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="briefcase" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $qualification->name ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Effective Date:</strong> {{ $qualification->effectiveDate ?? 'Not Available' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No professional qualifications available.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

                        <!-- Profile Details -->
                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-graduation-cap text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Ranking Infos
                                    </h3>

                                    <ul class="space-y-3">

                                        @forelse($currentServiceRanks ?? [] as $rank)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="medal" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $rank['rank'] ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Effective Date:</strong> {{ $rank['rankedDate'] ?? 'Not Available' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No Ranks available.</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-graduation-cap text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Service Infos
                                    </h3>

                                    <ul class="space-y-3">
                                        @forelse($currentService ?? [] as $service)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-green-100 dark:bg-green-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="check" class="text-green-600 dark:text-green-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $service['serviceName'] ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Effective Date:</strong> {{ $service['appointedDate'] ?? 'Not Available' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No current Service available.</li>
                                        @endforelse

                                        @forelse($previousServices ?? [] as $service)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="badge" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $service['serviceName'] ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Effective Date:</strong> {{ $service['servicePeriod'] ?? 'Not Available' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No Previous Service available.</li>
                                        @endforelse
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

                        <!-- Appointment Details -->
                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center justify-between">
                                        <!-- Left side (icon + title) -->
                                        <span class="flex items-center">
                                            <i class="fas fa-graduation-cap text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                            Appointment Infos
                                        </span>


                                    </h3>

                                    <ul class="space-y-3">
                                        @forelse($categorizedAppointments['currentAppointment'] as $ca)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-green-100 dark:bg-green-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="check" class="text-green-600 dark:text-green-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $ca->workPlaceName ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Appointed Date:</strong> {{ $ca->appointedDate ?? 'Not Available' }}
                                                    </p>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Current Position:</strong> {{ $currentAppointment->position ?? 'Not Available' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No current Appointment available.</li>
                                        @endforelse

                                        @forelse($categorizedAppointments['previousAppointment'] as $pa)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="calendar" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $pa->workPlaceName ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Appointment Period:</strong>
                                                        {{ $pa->appointedDate ? \Carbon\Carbon::parse($pa->appointedDate)->format('Y-m-d') : 'Not Available' }}
                                                        to
                                                        {{ $pa->releasedDate ? \Carbon\Carbon::parse($pa->releasedDate)->format('Y-m-d') : 'Present' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No current Appointment available.</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                                        <i class="fas fa-graduation-cap text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                        Attachment Infos
                                    </h3>

                                    <ul class="space-y-3">
                                        @forelse($categorizedAppointments['currentAttachedAppointment'] as $caa)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-green-100 dark:bg-green-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="check" class="text-green-600 dark:text-green-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $caa->workPlaceName ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Appointed Date:</strong> {{ $caa->appointedDate ?? 'Not Available' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No current Attached Appointment available.</li>
                                        @endforelse

                                        @forelse($categorizedAppointments['previousAttachedAppointment'] as $paa)
                                            <li class="flex items-start">
                                                <!-- Left Icon -->
                                                <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                    <i data-lucide="calendar" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                </div>

                                                <!-- Right Content -->
                                                <div>
                                                    <h4 class="font-medium text-gray-800 dark:text-gray-100">
                                                        {{ $paa->workPlaceName ?? 'Not Available' }}
                                                    </h4>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                        <strong>Appointment Period:</strong>
                                                        {{ $paa->appointedDate ? \Carbon\Carbon::parse($paa->appointedDate)->format('Y-m-d') : 'Not Available' }}
                                                        to
                                                        {{ $paa->releasedDate ? \Carbon\Carbon::parse($paa->releasedDate)->format('Y-m-d') : 'Present' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 dark:text-gray-400">No previous Attached Appointment available.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>




                        <!-- Contact Button -->
                        <div class="mt-8 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-end items-center p-6">
                                <a href="{{ route('principal.profileedit', [
                                    'id' => $principal->cryptedId,
                                    'category' => 'password'
                                    ]) }}"
                                    class="bg-red-600 hover:bg-red-700 text-white dark:text-gray-100 font-bold py-3 px-8 rounded-full transition duration-300 inline-block text-center">
                                     Reset Password
                                </a>

                                <button
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white dark:text-gray-100 font-bold py-3 px-8 rounded-full transition duration-300">
                                    Download Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
