<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <x-success-fail-message />

        <div class="flex justify-center items-center w-full mb-4 text-4xl font-extrabold text-center px- text-gray-200">
            {{ __('Which method do you want to receive your password reset link with?') }}
        </div>

        <form class="flex justify-center items-center flex-col" method="POST" action="{{ route('select.method-store') }}">
            @csrf

            <div class="mb-4 text-sm text-gray-600">
                <div class="my-4 ">
                    <input type="radio" name="method" value="email">
                    <label class=" font-bold text-xl">Email</label>
                </div>
                
                <div>
                    <input type="radio" name="method" value="phone">
                    <label class=" font-bold text-xl">Phone</label>
                </div>
            </div>     
            
            <div class="bg-custom-violet text-5xl px-16 py-4 hover:bg-purple-900 text-white flex mt-4">
                <x-button class="font-extrabold">
                    {{ __('Select') }}
                </x-button>
            </div>
        </form>  
    </x-auth-card>
</x-guest-layout>
