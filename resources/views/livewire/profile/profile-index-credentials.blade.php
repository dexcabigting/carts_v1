<div>

    @if(auth()->user()->role_id == 1)
        @include('profile.index-credentials-admin')
    @else
        @include('profile.index-credentials-user')
    @endif
</div>
