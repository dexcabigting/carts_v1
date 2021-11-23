<div>
    @if($viewModal)
        @livewire('orders.orders-view', [])
    @endif

    @if(auth()->user()->role_id == 1)
        @include('orders.index-admin')
    @else
        @include('orders.index-user')
    @endif
</div>
