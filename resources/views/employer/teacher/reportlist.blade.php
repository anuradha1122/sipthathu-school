<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
            {{ __('Teacher Report List') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="mx-auto sm:px-6 lg:px-8">
            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto">
                <div class="mb-6">
                    <!-- Breadcrumb -->
                    <x-breadcrumb :items="[
                        'Home' => route('dashboard'),
                        'Teacher Dashboard' => route('teacher.dashboard'),
                        'Teacher Report List' => null,
                    ]" />
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden w-full">
                    <div class="p-6">

                        <p class="text-gray-600 dark:text-gray-400 mb-4">This is a placeholder for the full filter report
                            content.</p>
                        <!-- Add your report content here -->
                        <p class="text-gray-600 dark:text-gray-400">Report details will be displayed here.</p>
                    </div>
                    <div class="mt-6">
                        <div class="bg-white w-full shadow-sm border border-gray-200 rounded-lg p-1">
                            <ul class="space-y-1">
                                <li class="p-2 rounded-md bg-gray-100 duration-300 flex items-center gap-2">
                                    <a href="{{ route('teacher.fullreportcurrent') }}" class="w-full gap-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1">
                                        <div class="mx-2">
                                            <span class="font-medium block">Teacher Full Report</span>
                                            <span class="text-gray-600 text-sm">This will allow you to get fully customize report about your school teachers</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>