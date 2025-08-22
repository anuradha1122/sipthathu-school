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
                        'Teacher Dashboard' => null,
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
                                <button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'teacher-search')"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white dark:text-gray-100 font-bold py-3 px-8 rounded-full transition duration-300">
                                    Search
                                </button>
                                <x-modal name="teacher-search" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                    @livewire('teacher-search')
                                </x-modal>
                                <a href="{{ route('teacher.reportlist') }}"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white dark:text-gray-100 font-bold py-3 px-8 rounded-full transition duration-300">
                                    Reports
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Teacher Image -->
                    <div class="w-full my-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Total Teachers</p>
                                <h2 class="text-3xl font-bold text-purple-700 mt-2">{{ $totalTeachers }}</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Male Teachers</p>
                                <h2 class="text-3xl font-bold text-green-600 mt-2">{{ $maleTeachers }}</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Female Teachers</p>
                                <h2 class="text-3xl font-bold text-blue-600 mt-2">{{ $femaleTeachers }}</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Male to Female Ratio</p>
                                <h2 class="text-3xl font-bold text-red-500 mt-2">{{ $maleToFemaleRatio }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md mb-4">
                        <div class="p-4 border-b font-bold text-purple-700">Retirement Next Inline</div>
                        <table class="w-full text-left">
                            <thead class="bg-purple-50">
                                <tr>
                                    <th class="p-4">Name</th>
                                    <th class="p-4">Subject</th>
                                    <th class="p-4">Role</th>
                                    <th class="p-4">Retirement Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr class="border-t">
                                        <td class="p-4">{{ $teacher->nameWithInitials }}</td>
                                        <td class="p-4">{{ $teacher->subjectName }}</td>
                                        <td class="p-4">{{ $teacher->positionName }}</td>
                                        <td class="p-4 text-green-600 font-bold">{{ $teacher->retirementDate }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>



                </div>
            </main>
        </div>
    </div>
</x-app-layout>
