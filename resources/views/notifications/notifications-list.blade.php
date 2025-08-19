<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
            {{ __('Notifications') }}
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
                        'Notifications' => null,
                    ]" />
                </div>
                <div class="mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            {{ __('Recent Notifications') }}
                        </h3>
                        @if (!$notifications)
                            <p class="text-gray-500 dark:text-gray-400">{{ __('No notifications found.') }}</p>
                        @else
                            <ul class="space-y-2">
                                @foreach ($notifications as $notification)
                                    <li class="w-full flex flex-col">
                                        <x-notification-card title="{{ $notification->title }}" :author="$notification->author"
                                            :time="$notification->created_at">
                                            {{ $notification->message }}
                                        </x-notification-card>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
