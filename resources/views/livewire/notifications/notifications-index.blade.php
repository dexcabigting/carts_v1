<div>
    {{--<div>
        @if(auth()->user()->role_id == 1)
            @foreach(auth()->user()->notifications as $notification) 
                @if($notification->type == 'App\Notifications\OrderCreatedNotification')
                    <div class="text-white">
                        {{ $notification->data['user'] }} created order {{ $notification->data['invoice number'] }} {{ $notification->created_at->diffForhumans() }} 
                    </div> 
                @endif
            @endforeach
        @else
            @foreach(auth()->user()->notifications as $notification) 
                @if($notification->type == 'App\Notifications\OrderStatusUpdatedNotification')
                    <div class="text-white">
                        Your order # {{ $notification->data['invoice number'] }} is now {{ $notification->data['status'] }} 
                    </div> 
                @endif
            @endforeach
        @endif
    </div>--}}

    <div>
        @foreach($notifications as $notification)
            {{ Hello }}
        @endforeach
    </div>
</div>
