<!-- Alpine.js for submenu toggle -->
<div class="w-full bg-blue-950 text-white relative">
    <!-- Logo Section -->
    <div class=" p-3 flex items-center space-x-2 bg-blue-950 border-b-2 border-blue-900">
        <i data-lucide="layout-dashboard" class="w-10 h-10"></i>
        <h1 class="text-xl font-bold">DashPanel</h1>
    </div>

    <!-- Navigation Menu -->
    <div class="mt-6 space-y-1">
        <x-nav-link-left :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="w-full ">
            <i data-lucide="gauge" class="w-5 h-5"></i>
            <span>Dashboard</span>
        </x-nav-link-left>

        <x-nav-link-left :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')" class="w-full ">
            <i data-lucide="user" class="w-5 h-5"></i>
            <span>SLTS</span>
        </x-nav-link-left>

        <x-nav-link-left :href="route('principal.dashboard')" :active="request()->routeIs('principal.dashboard')" class="w-full ">
            <i data-lucide="graduation-cap" class="w-5 h-5"></i>
            <span>SLPS</span>
        </x-nav-link-left>

        <x-nav-link-left :href="route('school.dashboard')" :active="request()->routeIs('school.dashboard')" class="w-full ">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span>School</span>
        </x-nav-link-left>
        <x-nav-link-left :href="route('school.dashboard')" :active="request()->routeIs('school.dashboard')" class="w-full ">
            <i data-lucide="building" class="w-5 h-5"></i>
            <span>School</span>
        </x-nav-link-left>

        <!-- Settings with submenu using Alpine.js -->
        <div x-data="{ open: localStorage.getItem('settingsMenuOpen') === 'true',
            toggle() {
                this.open = !this.open;
                localStorage.setItem('settingsMenuOpen', this.open);
            }}">
            <!-- Settings toggle -->
            <button type="button" @click="toggle"
                class="w-full flex items-center justify-between px-4 py-2 hover:bg-blue-900 transition">

                <div class="flex items-center space-x-2">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    <span>Settings</span>
                </div>

                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': open }"></i>
            </button>

            <!-- Submenu -->
            <div x-show="open" x-transition class="ml-8 mt-1 space-y-1">
                <x-nav-sub-link-left href="{{ route('teacher.profile') }}" :active="request()->routeIs('teacher.profile')" class="w-full">
                    <span>My Profile</span>
                </x-nav-sub-link-left>

                <x-nav-sub-link-left href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.edit')" class="w-full">
                    <span>Update Profile</span>
                </x-nav-sub-link-left>
            </div>
        </div>




        <x-nav-link-left :href="route('employer.employment')" :active="request()->routeIs('employer.employment')" class="w-full ">
            <i data-lucide="file-text" class="w-5 h-5"></i>
            <span>Employment</span>
        </x-nav-link-left>

        <!-- Transfer with submenu using Alpine.js -->
        <div x-data="{ openTransfer: localStorage.getItem('transferMenuOpen') === 'true',
            toggle() {
                this.openTransfer = !this.openTransfer;
                localStorage.setItem('transferMenuOpen', this.openTransfer);
            }}">
            <!-- Transfer toggle -->
            <button type="button" @click="toggle"
                class="w-full flex items-center justify-between px-4 py-2 hover:bg-blue-900 transition">

                <div class="flex items-center space-x-2">
                    <i data-lucide="squares-subtract" class="w-5 h-5" ></i>
                    <span>Transfer</span>
                </div>

                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': openTransfer }"></i>
            </button>

            <!-- Transfer Submenu -->
            <div x-show="openTransfer" x-transition class="ml-8 mt-1 space-y-1">
                <x-nav-sub-link-left href="{{ route('teacher.transfer-application') }}" :active="request()->routeIs('teacher.transfer-application')" class="w-full">
                    <span>Request</span>
                </x-nav-sub-link-left>

                <x-nav-sub-link-left href="{{ route('teacher.transfer-application-status') }}" :active="request()->routeIs('teacher.transfer-application-status')" class="w-full">
                    <span>Status</span>
                </x-nav-sub-link-left>
            </div>
        </div>

        <x-nav-link-left :href="route('inquiry')" :active="request()->routeIs('inquiry')" class="w-full ">
            <i data-lucide="file-pen-line" class="w-5 h-5" ></i>
            <span>Inquiry</span>
        </x-nav-link-left>

        <x-nav-link-left :href="route('circular')" :active="request()->routeIs('circular')" class="w-full ">
            <i data-lucide="paperclip" class="w-5 h-5"></i>
            <span>Circular Manager</span>
        </x-nav-link-left>

        <x-nav-link-left :href="route('news')" :active="request()->routeIs('news')" class="w-full ">
            <i data-lucide="newspaper" class="w-5 h-5"></i>
            <span>Importance Updates</span>
        </x-nav-link-left>

    </div>
</div>
