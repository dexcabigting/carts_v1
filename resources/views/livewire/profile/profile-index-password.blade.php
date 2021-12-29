<div>
    @if(auth()->user()->role_id == 1)
        @include('profile.index-password-admin')
    @else
        @include('profile.index-password-user')
    @endif
</div>
