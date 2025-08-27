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
                        'Class Setup' => null,
                    ]" />
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden w-full">
                    <div class="p-6">

                        <p class="text-gray-600 dark:text-gray-400 mb-2">You are about to change below user's details</p>

                    </div>
                    <form method="POST" action="{{ route('school.classstore') }}" class="p-6 space-y-4">
                        @csrf
                        <div class="space-y-2">

                            <!-- Filters -->
                            <div class="space-y-2">


                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">1. Grade 1</label>
                                        <x-form-text-input-field name="grade1" id="grade1" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">2. Grade 2</label>
                                        <x-form-text-input-field name="grade2" id="grade2" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">3. Grade 3</label>
                                        <x-form-text-input-field name="grade3" id="grade3" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">4. Grade 4</label>
                                        <x-form-text-input-field name="grade4" id="grade4" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">5. Grade 5</label>
                                        <x-form-text-input-field name="grade5" id="grade5" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">6. Grade 6</label>
                                        <x-form-text-input-field name="grade6" id="grade6" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">7. Grade 7</label>
                                        <x-form-text-input-field name="grade7" id="grade7" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">8. Grade 8</label>
                                        <x-form-text-input-field name="grade8" id="grade8" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">9. Grade 9</label>
                                        <x-form-text-input-field name="grade9" id="grade9" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">10. Grade 10</label>
                                        <x-form-text-input-field name="grade10" id="grade10" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">11. Grade 11</label>
                                        <x-form-text-input-field name="grade11" id="grade11" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">12. Grade 12 Art</label>
                                        <x-form-text-input-field name="grade12art" id="grade12art" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">13. Grade 12 Commerce</label>
                                        <x-form-text-input-field name="grade12commerce" id="grade12commerce" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">14. Grade 12 Science</label>
                                        <x-form-text-input-field name="grade12science" id="grade12science" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">15. Grade 12 Technology</label>
                                        <x-form-text-input-field name="grade12technology" id="grade12technology" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">16. Grade 12-13 Years</label>
                                        <x-form-text-input-field name="grade1213years" id="grade1213years" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">17. Grade 13 Art</label>
                                        <x-form-text-input-field name="grade13art" id="grade13art" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">18. Grade 13 Commerce</label>
                                        <x-form-text-input-field name="grade13commerce" id="grade13commerce" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">19. Grade 13 Science</label>
                                        <x-form-text-input-field name="grade13science" id="grade13science" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">20. Grade 13 Technology</label>
                                        <x-form-text-input-field name="grade13technology" id="grade13technology" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">21. Grade 13-13 Years</label>
                                        <x-form-text-input-field name="grade1313years" id="grade1313years" type="number" value="0" step="1" min="0" max="25" />

                                        <label class="block text-sm font-medium text-gray-700">22. Special Education</label>
                                        <x-form-text-input-field name="specialedu" id="specialedu" type="number" value="0" step="1" min="0" max="25" />



                                        @error('position') <span  class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="flex items-center justify-start gap-2 mx-4">
                                    <button type="submit" name="action" value="submit"
                                        class="mt-4 p-2 items-center justify-center transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                                        Submit
                                    </button>
                                    <a href="{{ route('school.classprofile') }}" type="button"
                                        class="mt-4 p-2 items-center justify-center transition duration-200 bg-green-500 hover:bg-green-600 focus:bg-green-700 focus:shadow-sm focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 text-white rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                                        Back
                                    </a>
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

{{-- <x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcrumb :list="$option" />
            <div class="isolate bg-white px-6 py-10 sm:py-10 lg:px-8">
                <form method="POST" action="{{ route('school.classstore') }}" class="mx-auto mt-8 max-w-xl sm:mt-8" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-x-2 gap-y-4 sm:grid-cols-3">

                        <x-form-number-input-section size="sm:col-span-1" name="grade1" id="grade1" value="0" label="Grade 1" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade2" id="grade2" value="0" label="Grade 2" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade3" id="grade3" value="0" label="Grade 3" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade4" id="grade4" value="0" label="Grade 4" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade5" id="grade5" value="0" label="Grade 5" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade6" id="grade6" value="0" label="Grade 6" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade7" id="grade7" value="0" label="Grade 7" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade8" id="grade8" value="0" label="Grade 8" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade9" id="grade9" value="0" label="Grade 9" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade10" id="grade10" value="0" label="Grade 10" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade11" id="grade11" value="0" label="Grade 11" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade12art" id="grade12art" value="0" label="Grade 12 Art" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade12commerce" id="grade12commerce" value="0" label="Grade 12 Commerce" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade12science" id="grade12science" value="0" label="Grade 12 Science" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade12technology" id="grade12technology" value="0" label="Grade 12 Technology" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade1213years" id="grade1213years" value="0" label="Grade 12-13 Years" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade13art" id="grade13art" value="0" label="Grade 12 Art" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade13commerce" id="grade13commerce" value="0" label="Grade 12 Commerce" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade13science" id="grade13science" value="0" label="Grade 12 Science" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade13technology" id="grade13technology" value="0" label="Grade 12 Technology" />
                        <x-form-number-input-section size="sm:col-span-1" name="grade1313years" id="grade1313years" value="0" label="Grade 12-13 Years" />
                        <x-form-number-input-section size="sm:col-span-1" name="specialedu" id="specialedu" value="0" label="Special Education" />


                    </div>
                    <div class="mt-10">
                        <x-form-button-primary size="" text="Setup" modelBinding=""/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> --}}