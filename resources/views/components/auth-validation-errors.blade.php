@props(['errors'])

@if ($errors->any())
<div class="flex justify-center items-center w-full lg:pl-44">
    <div class="flex items-center w-auto md:ml-16 p-3 mb-4 rounded-md bg-red-100 border-4 border-red-500 text-red-500">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
        </div>
        
        <div class="w-72">
            <div class="font-bold text-base ml-5">
                {{ __('Whoops! Something went wrong.') }}
            </div>

            <div >
                <ul class="mt-3 list-disc list-inside text-sm font-semibold">
                    @foreach ($errors->all() as $error)
                        <li class="ml-4">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    </div>
@endif
