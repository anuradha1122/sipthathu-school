<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
            {{ __('Principal Full Report') }}
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
                        'Principal Report List' => route('principal.reportlist'),
                        'Principal Full Report' => null
                    ]" />
                </div>
                @livewire('principalFullReport')
            </main>
        </div>
    </div>
</x-app-layout>
