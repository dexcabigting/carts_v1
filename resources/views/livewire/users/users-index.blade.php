<div>

    @if($createModal)
        @livewire('users.users-create')
    @elseif($deleteModal)
        @livewire('users.users-delete', ['id' => $userId])   
    @endif

    @include('users.index', ['users' => $users])
</div>
            
