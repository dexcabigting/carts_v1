<div class="h-screen">  
    <div class="pt-12 pb-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm rounded-lg mx-2">
                <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    My Notifications
                    {{ count($notifications) }} 
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-3xl mx-auto flex flex-col gap-5">
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
            <div wire:key="{{ $loop->index }}-admin-user-notif" class="flex flex-row gap-5 p-1 text-black bg-green-200 border-4 border-green-500 rounded-md">
                <div class="p-2">
                    @if(auth()->user()->role_id == 1)
                       {{ $notification['data']['user'] }} has ordered {{ $notification['data']['invoice number'] }}
                    @else
                        Your order # {{ $notification['data']['invoice number'] }} is now {{ $notification['data']['status'] }} 
                    @endif    
                </div>
                
                <div class="flex flex-row gap-5">
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
            <div class="text-xl text-white">
                You have no notifications.
            </div>      
        @endforelse
    </div>
</div>
