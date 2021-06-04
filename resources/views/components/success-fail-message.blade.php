@if (session('success'))
    <div {{ $attributes }}>
        <div class="font-medium text-green-600">
            {{ __('Success!') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-green-600">
            {{ session('success') }}
        </ul>
    </div>
@elseif (session('fail'))
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            {{ session('fail') }}
        </ul>
    </div>
@endif