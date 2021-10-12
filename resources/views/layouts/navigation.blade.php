<nav x-data="{ open: false }" class="bg-custom-blacki">

<div class="hidden md:flex flex-col md:flex-row h-full md:w-full">
  <div @click.away="open = false" class="flex flex-col w-full md:w-64 text-gray-700 bg-custom-blacki dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0" x-data="{ open: false }">
    <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-center">
      <div class="items-center flex justify-center text-lg font-semibold tracking-widest text-gray-100 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Admin</div>
      <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
          <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
       
   
      <x-nav-link class="block w-full px-4 py-2 mt-2 text-sm font-semibold text-gray-100 bg-transparenthover:text-gray-100 focus:text-gray-900 hover:bg-purple-900 focus:bg-custom-violet" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
      
      <div class="mx-4">
      <svg class="w-6 h-6 fill-current text-gray-100" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 64 64" viewBox="0 0 64 64"><g transform="translate(280 380)"><path d="M-264.2-339.9c-4.4 0-7.9-3.5-7.9-7.9 0-4.4 3.5-7.9 7.9-7.9 4.4 0 7.9 3.5 7.9 7.9C-256.3-343.5-259.8-339.9-264.2-339.9L-264.2-339.9zM-264.2-352.8c-2.7 0-4.9 2.2-4.9 4.9 0 2.7 2.2 4.9 4.9 4.9 2.7 0 4.9-2.2 4.9-4.9C-259.3-350.5-261.5-352.8-264.2-352.8L-264.2-352.8zM-232.1-356c-4.4 0-7.9-3.5-7.9-7.9s3.5-7.9 7.9-7.9 7.9 3.5 7.9 7.9S-227.8-356-232.1-356L-232.1-356zM-232.1-368.8c-2.7 0-4.9 2.2-4.9 4.9s2.2 4.9 4.9 4.9 4.9-2.2 4.9-4.9S-229.4-368.8-232.1-368.8L-232.1-368.8zM-232.1-323.9c-4.4 0-7.9-3.5-7.9-7.9s3.5-7.9 7.9-7.9 7.9 3.5 7.9 7.9S-227.8-323.9-232.1-323.9L-232.1-323.9zM-232.1-336.7c-2.7 0-4.9 2.2-4.9 4.9s2.2 4.9 4.9 4.9 4.9-2.2 4.9-4.9S-229.4-336.7-232.1-336.7L-232.1-336.7z"/><polyline  points="-238.6 -333.2 -259.2 -343.5 -257.8 -346.4 -237.1 -336.1 -238.6 -333.2"/><polyline points="-257.8 -349.3 -259.2 -352.1 -238.6 -362.4 -237.1 -359.6 -257.8 -349.3"/></g></svg>
      </div>
      {{ __('Dashboard') }}
      </x-nav-link>
      
      @if(auth()->user()->role_id == 1)
                       
                        <x-nav-link class="block w-full px-4 py-2 mt-2 text-sm font-semibold text-gray-100 bg-transparenthover:text-gray-100 focus:text-gray-900 hover:bg-purple-900 focus:bg-custom-violet" :href="route('dashboard')" :href="route('users.index')" :active="request()->routeIs('users.index')">
                        <div class="mx-4">
                        <svg class="w-6 h-6 fill-current text-gray-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"/></svg>
                        </div>
                        
                        {{ __('Users') }}
                        </x-nav-link>
                        <x-nav-link class="block w-full px-4 py-2 mt-2 text-sm font-semibold text-gray-100 bg-transparenthover:text-gray-100 focus:text-gray-900 hover:bg-purple-900 focus:bg-custom-violet" :href="route('dashboard')" :href="route('products.index')" :active="request()->routeIs('products.index')">
                            
                        <div class="mx-4">
                        <svg class="w-6 h-6 fill-current text-gray-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.47,7.37s0,0,0-.08l-.06-.15a.71.71,0,0,0-.07-.09.94.94,0,0,0-.09-.12l-.09-.07L20,6.78l-7.5-4.63a1,1,0,0,0-1.06,0L4,6.78l-.09.08-.09.07a.94.94,0,0,0-.09.12.71.71,0,0,0-.07.09l-.06.15s0,0,0,.08a1.15,1.15,0,0,0,0,.26v8.74a1,1,0,0,0,.47.85l7.5,4.63h0a.47.47,0,0,0,.15.06s.05,0,.08,0a.86.86,0,0,0,.52,0s.05,0,.08,0a.47.47,0,0,0,.15-.06h0L20,17.22a1,1,0,0,0,.47-.85V7.63A1.15,1.15,0,0,0,20.47,7.37ZM11,19.21l-5.5-3.4V9.43L11,12.82Zm1-8.12L6.4,7.63,12,4.18l5.6,3.45Zm6.5,4.72L13,19.21V12.82l5.5-3.39Z"/></svg>
                        </div>
                        {{ __('Products') }}
                        </x-nav-link>
    </nav>
  </div>
</div>
    <!-- Primary Navigation Menu -->
    <div class="absolute top-0 right-0 mr-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @else
                        <x-nav-link class="text-white text-xl focus:text-custom-violet" :href="route('dashboard')" :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                            {{ __('Shop') }}
                        </x-nav-link>
                        <x-nav-link class="text-white text-xl focus:text-custom-violet" :href="route('dashboard')" :href="route('carts.index')" :active="request()->routeIs('carts.index')">
                            {{ __('Carts') }}
                        </x-nav-link>
                    @endif
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="my-8 sm:flex sm:items-center sm:ml-6 text">
            <img src="../img/Group19.png" alt="">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-100 hover:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- My Profile -->
                        <x-dropdown-link :href="route('profile.index')">
                            {{ __('My Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            @if (auth()->user()->role_id == 1)
            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                {{ __('Users') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Products') }}
            </x-responsive-nav-link>
            @else
            <x-responsive-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                {{ __('Shop') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('carts.index')" :active="request()->routeIs('carts.index')">
                {{ __('Carts') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- My Profile -->
                <x-responsive-nav-link :href="route('profile.index')">
                    {{ __('My Profile') }}
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
