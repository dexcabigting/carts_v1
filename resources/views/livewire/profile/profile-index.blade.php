<div>
    @if(auth()->user()->role_id == 1)
        @include('profile.index-admin')
    @else
        @include('profile.index-user')
    @endif
</div>
