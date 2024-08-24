<nav x-data="{ open: false }" class="flex items-center justify-between py-3 px-6 border-b border-gray-10">
    <div id="header-left" class="flex items-center">
        <a href="{{ route('home') }}">
            <x-application-mark />
        </a>
        <div class="top-menu ml-10">
            <div class="flex space-x-4">
                {{-- <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link> --}}
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-nav-link>
            </div>
        </div>
    </div>
    <div id="header-right" class="flex items-center md:space-x-6">
        <div class="flex space-x-5">
            @auth
                @include('layouts.elements.hearder-auth')
            @else
                @include('layouts.elements.header-guest')
            @endauth
        </div>
    </div>
</nav>
