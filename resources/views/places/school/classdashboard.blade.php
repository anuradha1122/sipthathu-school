<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
            {{ __('Class Profile') }}
        </h2>
    </x-slot>
    <div class="py-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="mx-auto sm:px-6 lg:px-8">
            <main class="flex-1 overflow-y-auto">
                <div class="mb-6">
                    <!-- Breadcrumb -->
                    <x-breadcrumb :items="[
                        'Home' => route('dashboard'),
                        'School Dashboard' => route('school.dashboard'),
                        'Class Dashboard' => null,
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
                                <button
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white dark:text-gray-100 font-bold py-3 px-8 rounded-full transition duration-300">
                                    Search
                                </button>

                                <a href="{{ route('school.classsetup') }}"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white dark:text-gray-100 font-bold py-3 px-8 rounded-full transition duration-300">
                                    Class Setup
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">Class List</h3>
                        <button
                            class="px-4 py-2 bg-primary-500 dark:bg-primary-600 text-white rounded-lg hover:bg-primary-600 dark:hover:bg-primary-700 text-sm">View
                            All</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th
                                        class="py-3 px-4 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        #</th>
                                    <th
                                        class="py-3 px-4 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Class</th>
                                    <th
                                        class="py-3 px-4 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Class Teacher</th>
                                    <th
                                        class="py-3 px-4 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Medium</th>
                                    <th
                                        class="py-3 px-4 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Students</th>
                                    <th
                                        class="py-3 px-4 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="py-3 px-4 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $class)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $classes->firstItem() + $loop->index }}</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $class->class }}</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $class->teacher }}</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $class->medium }}</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $class->studentCount }}</td>
                                        @if ($class->teacher == null AND $class->medium == null AND $class->studentCount == null)
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-1 text-xs text-white bg-red-500 rounded">Incomplete</span>
                                            </td>
                                        @elseif( $class->teacher == null OR $class->medium == null OR $class->studentCount == null)
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-1 text-xs text-white bg-yellow-500 rounded">Pending</span>
                                            </td>
                                        @else
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-1 text-xs text-white bg-green-500 rounded">Completed</span>
                                            </td>
                                        @endif

                                        <td class="py-3 px-4">
                                            <a href="#" class="text-blue-500 dark:text-blue-400 hover:underline">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                        <div class="pagination">
                            {{ $classes->links() }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>


