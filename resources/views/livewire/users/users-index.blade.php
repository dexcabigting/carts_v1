<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    @if($deleteModal)
        @livewire('users.users-delete', ['id' => $this->checkedKeys])
    @endif

    @include('users.index', ['users' => $users])
</div>
