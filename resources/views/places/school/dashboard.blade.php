<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
            {{ __('School Profile') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="mx-auto sm:px-6 lg:px-8">
            <main class="flex-1 overflow-y-auto">
                <div class="mb-6">
                    <!-- Breadcrumb -->
                    <x-breadcrumb :items="[
                        'Home' => route('dashboard'),
                        'School Dashboard' => null,
                    ]" />
                </div>

                <div>
                    <div class="mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                        <div class="md:flex p-4">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, eum nesciunt adipisci
                                quos distinctio ex minima enim quibusdam doloremque. Repudiandae quam deserunt aliquid
                                sapiente adipisci cupiditate odio eligendi numquam est.</p>
                        </div>

                        <!-- Download Button -->
                        <div class="mt-8 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-end items-center p-6 gap-2">
                                <a href="{{ route('school.classprofile') }}"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white dark:text-gray-100 font-bold py-3 px-8 rounded-full transition duration-300">
                                    Classes
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Teacher Image -->
                    <div class="w-full my-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Teachers</p>
                                <h2 class="text-3xl font-bold text-purple-700 mt-2">{{ $userCounts['teacherCount'] }}</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Principals</p>
                                <h2 class="text-3xl font-bold text-green-600 mt-2">{{ $userCounts['principalCount'] }}</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Development Officers</p>
                                <h2 class="text-3xl font-bold text-blue-600 mt-2">{{ $userCounts['developmentOfficerCount'] }}</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Students</p>
                                <h2 class="text-3xl font-bold text-red-500 mt-2">{{ $studentCount }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md mb-4">
                        <div class="p-4 border-b font-bold text-purple-700">School Authority</div>
                        <table class="w-full text-left">
                            <thead class="bg-purple-50">
                                <tr>
                                    <th class="p-4">Category</th>
                                    <th class="p-4">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-4">Provincial Department</td>
                                    <td class="p-4">{{ $school->divisionOfficeName }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">Education Zone</td>
                                    <td class="p-4">{{ $school->zoneOfficeName }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">Education Division</td>
                                    <td class="p-4">{{ $school->provinceOfficeName }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-white rounded-lg shadow-md mb-4">
                        <div class="p-4 border-b font-bold text-purple-700">School Categories</div>
                        <table class="w-full text-left">
                            <thead class="bg-purple-50">
                                <tr>
                                    <th class="p-4">Category</th>
                                    <th class="p-4">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-4">School Authority</td>
                                    <td class="p-4">{{ $school->schoolAuthority }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">School Class Category</td>
                                    <td class="p-4">{{ $school->className }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">School Ethnicity Category</td>
                                    <td class="p-4">{{ $school->ethnicityName }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">School Language Category</td>
                                    <td class="p-4">{{ $school->languageName }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">School Gender Category</td>
                                    <td class="p-4">{{ $school->genderName }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">School Main Religion</td>
                                    <td class="p-4">{{ $school->religionName }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">School Density Category</td>
                                    <td class="p-4">{{ $school->densityName }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">School Facility Level</td>
                                    <td class="p-4">{{ $school->facilityName }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
