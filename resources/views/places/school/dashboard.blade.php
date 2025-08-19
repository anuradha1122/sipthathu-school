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
                                <p class="text-sm text-gray-500">Total Users</p>
                                <h2 class="text-3xl font-bold text-purple-700 mt-2">1,240</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Revenue</p>
                                <h2 class="text-3xl font-bold text-green-600 mt-2">$24,500</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">New Orders</p>
                                <h2 class="text-3xl font-bold text-blue-600 mt-2">320</h2>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-sm text-gray-500">Pending Tickets</p>
                                <h2 class="text-3xl font-bold text-red-500 mt-2">12</h2>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md mb-4">
                        <div class="p-4 border-b font-bold text-purple-700">User List</div>
                        <table class="w-full text-left">
                            <thead class="bg-purple-50">
                                <tr>
                                    <th class="p-4">Name</th>
                                    <th class="p-4">Email</th>
                                    <th class="p-4">Role</th>
                                    <th class="p-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-4">John Doe</td>
                                    <td class="p-4">john@example.com</td>
                                    <td class="p-4">Admin</td>
                                    <td class="p-4 text-green-600 font-bold">Active</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-4">Jane Smith</td>
                                    <td class="p-4">jane@example.com</td>
                                    <td class="p-4">Editor</td>
                                    <td class="p-4 text-yellow-500 font-bold">Pending</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                </div>
            </main>
        </div>
    </div>
</x-app-layout>
