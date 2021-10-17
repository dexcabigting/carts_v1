<div class="w-full flex justify-center items-center h-screen">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full sm:px-6 lg:px-8">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    @include('users.create')
                </div>
            </div>
        </div>
    </div>
</div>
    
            
