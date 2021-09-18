<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <x-success-fail-message />

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Which method do you want to receive your password reset link with?') }}
        </div>

        <form method="POST" action="{{ route('select.method') }}">
            @csrf

            <div class="mb-4 text-sm text-gray-600">
                <div>
                    <input type="radio" name="method" value="email">
                    <label>Email</label>
                </div>
                
                <div>
                    <input type="radio" name="method" value="phone">
                    <label>Phone</label>
                </div>
            </div>     
            
            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Select') }}
                </x-button>
            </div>
        </form>  
    </x-auth-card>
</x-guest-layout>
