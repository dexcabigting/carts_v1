<x-guest-layout>
    <x-auth-card>
        
        <div class="flex justify-center items-center flex-col my-24">
        <h1 class="text-9xl font-extrabold text-custom-text">THANK YOU!</h1>
        <div class="flex justify-center">
        <div class="mb-4 text-xl w-1/2 font-bold text-center text-white">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
        </div>
        <div class="mt-4 flex items-center justify-between flex-col">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button class="hover:bg-purple-900 hover:text-purple-100 text-3xl font-bold text-white px-12 py-6 my-6 w-full bg-custom-violet">
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>
            <h1 class="font-bold text-gray-500">or</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="my-4 underline text-base text-gray-100 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
        </div>
    </x-auth-card>
</x-guest-layout>
