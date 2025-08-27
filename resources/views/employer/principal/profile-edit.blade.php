<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
            {{ __('Principal Detail Edit') }}
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
                        'Principal Dashboard' => route('principal.dashboard'),
                        'Principal Profile' => route('principal.profile', ['id' => $principal->cryptedId]),
                        'Principal Profile Edit' => null
                    ]" />
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden w-full">
                    <div class="p-6">

                        <p class="text-gray-600 dark:text-gray-400 mb-2">You are about to change below user's details</p>
                        <!-- Add your report content here -->
                        <p class="text-gray-600 dark:text-gray-400">{{ $principal->nameWithInitials}}</p>
                    </div>
                    <form method="POST" action="{{ route('principal.profileupdate') }}" class="p-6 space-y-4">
                        @csrf
                        <div class="space-y-2">

                            <!-- Filters -->
                            <div class="space-y-2">

                                @if ($category == 'position')
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Position</label>
                                            <x-form-list-input-field name="position" id="position" :options="$positions" />
                                            @error('position') <span  class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                @endif

                                @if ($category == 'password')
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <div>
                                            <p>send password reset link to email</p>
                                        </div>
                                    </div>
                                @endif

                                <input type="hidden" name="category" value="{{ $category }}">
                                <input type="hidden" name="userId" value="{{ $principal->id }}">
                                <div class="flex items-center justify-start gap-2 mx-4">
                                    <button type="submit" name="action" value="submit"
                                        class="mt-4 p-2 items-center justify-center transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                                        Submit
                                    </button>
                                    <button type="submit" name="action" value="Back"
                                        class="mt-4 p-2 items-center justify-center transition duration-200 bg-green-500 hover:bg-green-600 focus:bg-green-700 focus:shadow-sm focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 text-white rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                                        Back
                                    </button>
                                </div>
                                @if(session('success'))
                                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                                        {{ session('error') }}
                                    </div>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
