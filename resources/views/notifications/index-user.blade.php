<div class="h-screen pt-24 max-w-8xl flex items-center flex-col">  
    <div class="">
        <div class="max-w-8xl mx-auto flex items-center justify-center">
            <div class="bg-custom-blacki overflow-hidden shadow-sm rounded-lg mx-2">
                <div class="px-32 p-8 bg-custom-blacki shadow-2xl text-xl lg:text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    My Notifications
                    @if(!$notifications->isEmpty())
                        ({{ count($notifications) }}) 
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-3xl float-right flex flex-col items-center justify-center ml-4 mt-4 w-full">
        <div class="text-sm  text-gray-100 w-full items-center justify-center">
            <select class="font-semibold rounded-lg bg-custom-blacki" wire:model="notificationType">
                <option value="unreadNotifications">
                    Unread Notifications
                </option>
                <option value="readNotifications">
                    Marked as Read 
                </option>
            </select>
        </div>

        @forelse($notifications as $notification)
            <div wire:key="{{ $loop->index }}-admin-user-notif" class="mt-8             lg:ml-9 flex flex-row p-1  text-black bg-green-200 border-4 border-green-500 rounded-md">
                @if($notification['type'] == 'App\Notifications\OrderStatusUpdatedNotification')
                <div class="p-2 px-2 lg:px-32">
                    Your order #{{ $notification['data']['invoice number'] }} is now {{ $notification['data']['status'] }}!
                    <a href="{{ route('orders.index') }}">
                        <span class="font-bold underline text-custom-violet">
                            View your orders
                        </span>  
                    </a>
                </div>
                @elseif($notification['type'] == 'App\Notifications\ProductCreatedNotification')
                <div class="p-2 px-2 lg:px-32">
                    New {{ $notification['data']['fabric'] }} {{ $notification['data']['category'] }}! *{{ $notification['data']['product name'] }}* 
                    <a href="{{ route('shop.index') }}">
                        <span class="font-bold">
                            Shop now
                        </span>  
                    </a> 
                </div>
                @endif
                
                <div class="flex flex-row gap-5 ml-24 xl:ml-2 items-center">
                    <div class="w-32">
                        {{ $notification['created_at']->toDayDateTimeString() }}
                    </div>
                    
                    @if($notificationType != 'readNotifications')
                    <div>
                        <x-button type="button" wire:click="markAsRead('{{ $notification['id'] }}')" class="w-32 items-center align-center hover:bg-purple-400 hover:text-purple-100 text-XL font-semibold text-white px-1 py-2 bg-custom-violet">
                            Mark as Read
                        </x-button>
                    </div>
                    @endif

                    <div>
                        <x-button type="button" wire:click="delete('{{ $notification['id'] }}')" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500">
                            Delete
                        </x-button>
                    </div>
                </div> 
            </div>        
        @empty
            <div class="text-2xl flex justify-center items-center font-bold text-custom-text">
                You have no notifications.
            </div>      
        @endforelse
        <div class="text-sm font-medium text-gray-900">
            {{ $notifications->links() }}
        </div>
    </div>
</div>
