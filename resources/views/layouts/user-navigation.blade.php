<nav x-data="{ open: false }" class="bg-custom-black">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                

                <!-- Navigation Links -->
                <div class="nav-container-class hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(auth()->user()->role_id == 2)
                        <x-nav-link class="text-white text-xl focus:text-custom-violet" :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                            {{ __('Shop') }}
                        </x-nav-link>
                        <x-nav-link class="text-white text-xl focus:text-custom-violet" :href="route('carts.index')" :active="request()->routeIs('carts.index')">
                            {{ __('Carts') }}
                        </x-nav-link>
                        <x-nav-link class="text-white text-xl focus:text-custom-violet" :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                            {{ __('Orders') }}
                        </x-nav-link>

                    @if((new \Jenssegers\Agent\Agent())->isDesktop())
                        <x-nav-link class="text-white text-xl focus:text-custom-violet" :href="route('products.customize')" :active="request()->routeIs('products.customize')">
                            {{ __('Customize') }}
                        </x-nav-link>
                    @endif
                        
                        <x-nav-link class="text-white text-xl focus:text-custom-violet" :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                            {{ __('Reservations') }}
                        </x-nav-link>
                    @endif
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="flex flex-row text-white"> 
                    <div>
                        <a href="{{ route('notifications.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />    
                            </svg>
                        </a>
                    </div>
                    <div>
                        @livewire('notifications.notifications-counter')
                    </div>                    
                </div>
                <img src="{{ asset('img/user.png') }}" alt="" class="rounded-full w-10 h-10 mx-4 border-4 border-custom-violet">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-100 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="">
                                @livewire('dropdown.dropdown-name')
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- My Profile -->
                        <x-dropdown-link :href="route('profile.index')" class="font-semibold bg-custom-blacki text-white hover:text-gray-100 focus:text-gray-100 hover:bg-purple-900 focus:bg-custom-violet">
                            {{ __('My Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('notifications.index')" class="font-semibold bg-custom-blacki text-white hover:text-gray-100 focus:text-gray-100 hover:bg-purple-900 focus:bg-custom-violet">
                            {{ __('Notifications') }}
                            <div wire:key="{{ mt_rand(00, 99) }}-dropdown-notif" class="float-right">
                                @livewire('notifications.notifications-counter')
                            </div>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                class="font-semibold bg-custom-blacki text-white hover:text-gray-100 focus:text-gray-100 hover:bg-purple-900 focus:bg-custom-violet">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="absolute right-8 top-2 lg:hidden block">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-100 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->role_id == 2)
                <x-responsive-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                    {{ __('Shop') }}
                </x-responsive-nav-link>
               

                <x-responsive-nav-link :href="route('carts.index')" :active="request()->routeIs('carts.index')">
                    {{ __('Carts') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                    {{ __('Orders') }}
                </x-responsive-nav-link>

                @if((new \Jenssegers\Agent\Agent())->isDesktop())

                    <x-responsive-nav-link :href="route('products.customize')" :active="request()->routeIs('products.customize')">
                        {{ __('Customize') }}
                    </x-responsive-nav-link>

                @endif

                <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                    {{ __('Reservations') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div>
                @livewire('responsive-settings.responsive-settings-name-and-email')
            </div>

            <div class="mt-3 space-y-1">
                <!-- My Profile -->
                <x-responsive-nav-link :href="route('profile.index')">
                    {{ __('My Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('notifications.index')">
                    {{ __('Notifications') }}
                    <div wire:key="{{ mt_rand(00, 99) }}-responsive-notif">
                        @livewire('notifications.notifications-counter')
                    </div> 
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
