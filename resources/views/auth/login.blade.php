<x-guest-layout class="overflow-x-hidden">
    <x-auth-card>

    <section class="flex flex-row justify-center items-center md:w-full">

        <div class="h-auto md:my-12 border-24 w-full shadow-xl mx-24 md:mx-32 bg-no-repeat bg-contain justify-center">
              <img class="2xl:inline-flex hidden float-right w-2/5"src="img/GROI.png" alt="">
            <div class="flex justify-start items-center py-12">
                <div class="flex justify-center items-center flex-col md:ml-32">
                  
                    <img class="2xl:ml-64 w-40 h-40 md:w-48 md:h-48 mb-12" src="img/Group 20.svg" alt=""/>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}"  class="w-full max-w-sm ">
            @csrf

            <!-- Email Address -->
            <div  class="md:flex md:items-center mb-6">
            <div  class="md:w-1/3">
                <x-label class="block text-gray-500 font-semibold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name" for="email" :value="__('Email')" />
</div>
<div class="md:w-2/3">
                <x-input  class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-96 h-14 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="email" placeholder="Email" type="email" name="email" :value="old('email')" required autofocus />
            </div>
</div>

            <!-- Password -->
            <div  class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <x-label  class="block text-gray-500 font-semibold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-password" :value="__('Password')" />
</div>
<div class="md:w-2/3">
                <x-input id="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-96 h-14 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                   for="password" type="password" placeholder="Password"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
            </div>

            <!-- Remember Me -->
            <div class="md:flex md:items-center mb-6">
                 <div class="md:w-1/3"></div>
                <label for="remember_me" class="md:w-2/3 block text-gray-500 font-semibold">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Login -->
            <div class="w-full flex flex-col justify-center items-center">
                <div class="md:flex md:items-center justify-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-3xl font-semibold text-center text-white px-12 py-6 w-96 bg-custom-violet my-3">
                    {{ __('Log in') }}
                </x-button>
</div>
</div>
<div class="flex items-center justify-center mt-4">
    <div class="ml-10"></div>
    <!-- Forgot Password  -->
                @if (Route::has('select.method-index'))
                    <a class="underline text-base text-center text-gray-100 hover:text-custom-violet" href="{{ route('select.method-index') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
</div>
        </form>
</div>
</div>
</div>
</section>
    </x-auth-card>
</x-guest-layout>
