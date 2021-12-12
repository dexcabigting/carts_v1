<div>
    @if($isAdmin)
        @include('notifications.index-admin')
    @else
        @include('notifications.index-user')
    @endif
</div>
