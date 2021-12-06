<div>
    @if($createModal)
        @livewire('profile.profile-create-address')
    @elseif($deleteModal)
        @livewire('profile.profile-delete-address', ['id' => $selectedAddress])
    @endif

    @include('profile.index-address')
</div>
