<div class="h-screen pt-20 ml-5 lg:ml-32 xl:ml-48 lg:pt-40  2xl:ml-96 max-w-8xl flex flex-col">  
    <div class="pt-12 pb-6">
        <div class="max-w-8xl mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm rounded-lg mx-2">
                <div class="px-32 p-8 bg-custom-blacki shadow-2xl text-xl lg:text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    My Notifications
                    @if(!$notifications->isEmpty())
                        {{ count($notifications) }} 
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-3xl ml-2 float-right flex flex-col gap-5 w-full">
        <div class="text-sm font-medium text-gray-900">
            <select wire:model="notificationType">
                <option value="unreadNotifications">
                    Unread Notifications
                </option>
                <option value="readNotifications">
                    Marked as Read 
                </option>
            </select>
        </div>

        @forelse($notifications as $notification)
            <div wire:key="{{ $loop->index }}-admin-user-notif" class="lg:ml-9 flex flex-row p-1  text-black bg-green-200 border-4 border-green-500 rounded-md">
                @if($notification['type'] == 'App\Notifications\OrderCreatedNotification') 
                    <div class="p-2 px-2 lg:px-32">
                        {{ $notification['data']['user'] }} has ordered {{ $notification['data']['invoice number'] }}   
                    </div>
                @elseif($notification['type'] == 'App\Notifications\RegisteredNotification')
                    <div class="p-2 px-2 lg:px-32">
                        {{ $notification['data']['name'] }} ({{ $notification['data']['email'] }}) has registered {{ $notification['created_at']->diffForHumans() }}   
                    </div>
                @elseif($notification['type'] == 'App\Notifications\ProductVariantCommentCreatedNotification')
                <div class="p-2 px-2 lg:px-32">
                    {{ $notification['data']['user'] }} commented on {{ $notification['data']['product'] }}:{{ $notification['data']['product variant'] }} "{{ $notification['data']['comment'] }}" {{ $notification['created_at']->diffForHumans() }}   
                </div>
                @endif
                
                <div class="flex flex-row gap-5 ml-24 xl:ml-32">
                    @if($notificationType != 'readNotifications')
                    <div>
                        <x-button type="button" wire:click="markAsRead('{{ $notification['id'] }}')" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500">
                            Mark as Read
                        </x-button>
                    </div>
                    @endif

                    <div>
                        <x-button type="button" wire:click="delete  ('{{ $notification['id'] }}')" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500">
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
