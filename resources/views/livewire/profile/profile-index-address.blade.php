<div>
    @if($createModal)
        @livewire('profile.profile-create-address')
    @elseif($deleteModal)
        @livewire('profile.profile-delete-address', ['id' => $selectedAddress])
    @endif

    @if(auth()->user()->role_id == 1)
        @include('profile.index-address-admin')
    @else
        @include('profile.index-address-user')
    @endif
</div>
