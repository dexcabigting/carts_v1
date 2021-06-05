<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="pb-4">
                        <x-success-fail-message />
                        <x-validation-errors :errors="$errors" />

                        <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                            {{ __('Customer Credentials') }}
                        </h2>

                        <form method="POST" action="{{ route('customers.update', [$customer->id]) }}">
                            @method('PUT')
                            @csrf

                            <div>
                                <x-label for="name" :value="__('Name')"/>
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $customer->name }}" autofocus required />
                            </div>

                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $customer->email }}" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button>
                                    {{ __('Update Credentials') }}
                                </x-button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
