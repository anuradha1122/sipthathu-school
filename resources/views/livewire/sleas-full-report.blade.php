<div class="bg-white rounded-xl shadow-md overflow-hidden w-full">
    <form wire:submit.prevent="submit" class="p-6 space-y-4">
        <div class="space-y-2">

            <div class="flex items-center justify-end gap-2 mx-4">
                <button type="submit" name="action" value="web"
                    class="mt-4 p-2 items-center justify-center transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                    Get Web
                </button>
                <button type="submit" name="action" value="web"
                    class="mt-4 p-2 items-center justify-center transition duration-200 bg-red-500 hover:bg-red-600 focus:bg-red-700 focus:shadow-sm focus:ring-4 focus:ring-red-500 focus:ring-opacity-50 text-white rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                    Get PDF
                </button>
                <button type="submit" name="action" value="web"
                    class="mt-4 p-2 items-center justify-center transition duration-200 bg-green-500 hover:bg-green-600 focus:bg-green-700 focus:shadow-sm focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 text-white rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                    Get Excel
                </button>
            </div>

            <!-- Filters -->
            <div class="space-y-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Race</label>
                        <x-form-list-input-field name="" id="" wire:model="race" :options="$raceList" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Religion</label>
                        <x-form-list-input-field name="" id="" wire:model="religion" :options="$religionList" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Civil Status</label>
                        <x-form-list-input-field name="" id="" wire:model="civilStatus" :options="$civilStatusList" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <x-form-list-input-field name="" id="" wire:model="gender" :options="$genderList" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Birthday Start From</label>
                        <x-form-text-input-field class="block mt-1 w-full" type="date" wire:model="birthDayStart" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Birthday To</label>
                        <x-form-text-input-field class="block mt-1 w-full" type="date" wire:model="birthDayEnd" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Service Start From</label>
                        <x-form-text-input-field class="block mt-1 w-full" type="date" wire:model="serviceStart" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Service To</label>
                        <x-form-text-input-field class="block mt-1 w-full" type="date" wire:model="serviceEnd" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">School Start From</label>
                        <x-form-text-input-field class="block mt-1 w-full" type="date" wire:model="schoolAppointStart" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">School To</label>
                        <x-form-text-input-field class="block mt-1 w-full" type="date" wire:model="schoolAppointEnd" />
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Results -->
    @if($showResults)
        <div class="mt-6">
            <div class="bg-white w-full shadow-sm border border-gray-200 rounded-lg p-1">
                <ul class="space-y-1">
                    @foreach ($results as $resultsItem)
                    <li class="p-2 rounded-md bg-gray-100 duration-300 flex items-center gap-2">
                        <img src="https://www.shutterstock.com/image-vector/blank-avatar-photo-place-holder-600nw-1114445501.jpg"
                            alt="" class="w-12 h-12 rounded-full hidden md:block" />
                        <a href="{{ route('principal.profile', ['id' => $resultsItem->usId ]) }}" target="_blank" class="w-full gap-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="mx-2">
                                <span class="font-medium block">{{ $resultsItem->userName }}</span>
                                <span class="text-gray-600 text-sm">{{ $resultsItem->nic }}</span>
                            </div>
                            <div class="mx-2">
                                <span class="text-gray-600 text-sm block">{{ $resultsItem->race }}</span>
                                <span class="text-gray-600 text-sm block">{{ $resultsItem->religion }}</span>
                                <span class="text-gray-600 text-sm">{{ $resultsItem->civilStatus }}</span>
                            </div>
                            <div class="mx-2">
                                <span class="font-medium block">{{ $resultsItem->birthDay }}</span>
                                <span class="text-gray-600 text-sm">{{ $resultsItem->gender }}</span>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-4">
                {{ $results->links() }}
            </div>
        </div>
    @endif
</div>
