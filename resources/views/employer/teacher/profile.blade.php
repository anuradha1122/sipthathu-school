<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
            {{ __('Teacher Profile') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="mx-auto sm:px-6 lg:px-8">
            <main class="flex-1 overflow-y-auto">
                <div class="mb-6">
                    <!-- Breadcrumb -->
                    <x-breadcrumb :items="[
                        'Home' => route('dashboard'),
                        'Teacher Dashboard' => route('teacher.dashboard'),
                        'Profile' => null,
                    ]" />
                </div>

                <div>
                    <div class="mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                        <div class="md:flex">
                            <!-- Teacher Image -->
                            <div class="md:w-1/4 p-6 flex justify-center">
                                <div class="relative">
                                    <img class="w-48 h-48 rounded-full object-cover border-4 border-indigo-500"
                                        src="https://images.unsplash.com/photo-1577880216142-8549e9488dad?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                                        alt="Teacher profile picture" />
                                </div>
                            </div>

                            <!-- Teacher Info -->
                            <div class="md:w-3/4 p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $teacher->nameWithInitials }}
                                        </h1>
                                        <p class="text-indigo-600 dark:text-indigo-400 font-semibold">NIC Number: {{ $teacher->nic }}</p>
                                        </p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button
                                            class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 p-2 rounded-full hover:bg-indigo-200 dark:hover:bg-indigo-800">
                                            <i data-lucide="mail"></i>
                                        </button>
                                        <button
                                            class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 p-2 rounded-full hover:bg-indigo-200 dark:hover:bg-indigo-800">
                                            <i data-lucide="phone-call"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-2 gap-2">
                                        <i data-lucide="calendar-days"></i>
                                        <span>Date of Birth: {{ \Carbon\Carbon::parse($teacher->birthDay)->format('F j, Y') }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-4 gap-2">
                                        <i data-lucide="map-pin"></i>
                                        <span>Permanent Address:
                                            {{ $teacher->permAddressLine1 }},
                                            {{ $teacher->permAddressLine2 }},
                                            {{ $teacher->permAddressLine3 }},
                                        </span>

                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-4 gap-2">
                                        <i data-lucide="map-pin"></i>
                                        <span>Residential Address:
                                            {{ $teacher->tempAddressLine1 }},
                                            {{ $teacher->tempAddressLine2 }},
                                            {{ $teacher->tempAddressLine3 }},
                                        </span>

                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-4 gap-2">
                                        <i data-lucide="mail"></i>
                                        <span>Email: {{ $teacher->email }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-4 gap-2">
                                        <i data-lucide="phone-call"></i>
                                        <span>Contact: {{ $teacher->mobile1 }} / WhatsApp: {{ $teacher->mobile2 }}</span>
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
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $teacher->race }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Religion</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $teacher->religion }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Civil Status</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $teacher->civilStatus }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Gender</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $teacher->gender }}</p>
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
                                                {{ $teacher->province ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($teacher->province)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Province</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $teacher->province ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $teacher->district ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($teacher->district)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">District</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $teacher->district ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $teacher->dsDivision ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($teacher->dsDivision)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">DS Division</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $teacher->dsDivision ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $teacher->gnDivision ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($teacher->gnDivision)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">GN Division</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $teacher->gnDivision ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <div class="p-2 rounded-full mr-3
                                                {{ $teacher->educationDivision ? 'bg-indigo-100 dark:bg-indigo-900' : 'bg-red-100 dark:bg-red-900' }}">

                                                @if($teacher->educationDivision)
                                                    <i data-lucide="check" class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                                @else
                                                    <i data-lucide="x" class="text-red-600 dark:text-red-300 text-xs"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Res. Education  Division</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $teacher->educationDivision ?? 'Not Available' }}
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
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $teacher->race }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Religion</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $teacher->religion }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Civil Status</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $teacher->civilStatus }}</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mr-3">
                                                <i data-lucide="graduation-cap"
                                                    class="text-indigo-600 dark:text-indigo-300 text-xs"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-100">Gender</h4>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $teacher->gender }}</p>
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




                        <!-- Contact Button -->
                        <div class="mt-8 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-end items-center p-6">
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
