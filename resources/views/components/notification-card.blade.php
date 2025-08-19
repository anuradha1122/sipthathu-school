<div class=" flex gap-3">
    <div class="w-full flex flex-col gap-2 bg-white dark:bg-gray-800 p-6 ">
        <div class="flex gap-2">
            <i data-lucide="bell-dot" class="w-10 h-10 bg-gray-300 dark:bg-gray-700 p-2 object-cover rounded-full"></i>
            <div class="flex flex-col">
                <div class="flex gap-2 items-center dark:text-white">
                    <h4 class="text-lg font-semibold">{{  $author ?? ' Author' }}</h4>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $time ?? 'Just now' }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 border border-gray-200 dark:border-gray-600 rounded-md ml-10">
            <div class="flex flex-col p-4 hover:cursor-pointer">
                <h4 class="text-lg font-semibold dark:text-white hover:text-blue-800 dark:hover:text-blue-400">
                    {{ $title ?? 'Notification Title' }}
                </h4>
                <p class="text-sm text-gray-500 hover:text-blue-800 dark:hover:text-blue-400 dark:text-gray-300">
                    {{ $slot }}
                </p>
            </div>
        </div>
    </div>
</div>
