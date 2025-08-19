<div>
    <div class="flex m-4">
        <!-- Search Input Section -->
        <div class="flex items-center flex-1 px-2 space-x-2">
            <span>
                <i data-lucide="search" class="w-6 h-6 text-gray-500 dark:text-gray-900"></i>
            </span>
            <input type="text" placeholder="Search"
                class="w-full px-4 py-3 text-gray-600 dark:text-gray-300 rounded-md bg-gray-50 dark:bg-gray-400 border border-sky-600 focus:bg-gray-100 dark:focus:bg-gray-700" />
        </div>
        <!-- Close Button -->
        <button type="button" x-on:click="$dispatch('close')"
            class="flex-shrink-0 p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
            <i data-lucide="x" class="w-6 h-6 text-gray-500 dark:text-gray-400"></i>
        </button>
    </div>

    <div class="px-4 py-2">
        <!-- Search Results Section -->
        <div class="space-y-2">
            @if ($searchResults === null)
                
            @else
                @foreach ($searchResults as $result)
                    
                @endforeach
            @endif
        </div>

    </div>
</div>
