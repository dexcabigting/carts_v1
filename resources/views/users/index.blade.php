<div class ="h-screen items-center pt-14 2xl:pt-40 lg:pt-20 xl:pl-2 2xl:pl-44 w-full flex flex-col">
    <div class="flex flex-col items-center justify-center">
        <div class="w-full">
            <div class="inline-flex ">
                <div class="inline-flex ml-6 lg:ml-0 p-7 px-9 md:px-2 2xl:px-7 bg-custom-blacki shadow-2xl overflow-x-auto">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex mx-12 md:m-0">
                    <div>
                        <x-button wire:click.prevent="openCreateModal()" class="mx-2 hover:bg-purple-900 hover:text-purple-100 text-sm 2xl:text-xl font-semibold text-white px-4 py-2 bg-custom-violet my-3">
                            {{ __('Create User') }}
                        </x-button>
                    </div>

                    @if($query != 'users')
                        <div wire:key="{{ $query }}" class="">
                            <button wire:click.prevent="restoreUsers()"
                                type="button" {{ (!$checkedUsers) ?  'disabled' : null }}
                                class="px-4 py-2 my-3 bg-green-600 border border-transparent text-sm 2xl:text-xl font-semibold text-white hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedUsers) cursor-not-allowed @endif">
                                {{ __('Bulk Restore') }} 
                                @if ($checkedUsers)
                                    ({{ count($checkedUsers) }})
                                @endif
                            </button>
                        </div>
                    @else
                        <div wire:key="{{ $query }}" class="">
                            <button wire:click.prevent="openDeleteModal(@json($this->checked_keys))"
                                type="button" {{ (!$checkedUsers) ?  'disabled' : null }}
                                class="mx-2 hover:bg-red-900 hover:text-purple-100 text-sm 2xl:text-xl font-semibold text-white px-4 py-2 bg-red-600 my-3 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedUsers) cursor-not-allowed @endif">
                                {{ __('Bulk Delete') }} 
                                @if ($checkedUsers)
                                    ({{ count($checkedUsers) }})
                                @endif
                            </button>
                        </div>
                    @endif

                  
                    </div>

                    <!-- Users -->
                    <div class="xl:ml-0">
                        <div class="font-medium text-gray-100 py-4">
                            <div class="flex flex-col items-center justify-items-center lg:flex-row mx-2">
                                <div class="mx-2">
                                <x-label :value="__('Users')" class="text-gray-50 inline-block font-bold text-sm mx-1 xl:text-xl" />
                                </div>
                                <div class="inline-flex">
                                    <select wire:model="query" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                        <option value="users">
                                                <x-label :value="__('Users')" class="inline-block" />
                                        </option>

                                        <option value="deletedUsers">
                                            <x-label :value="__('Deleted Users')" class="inline-block" />
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order By -->
                    <div class="xl:ml-0">
                        <div class="font-medium text-gray-100 py-4">
                            <div class="flex flex-col items-center justify-items-center lg:flex-row mx-2">
                                <div class="mx-2">
                                <x-label :value="__('Order By')" class="text-gray-50 inline-block font-bold text-sm mx-1 xl:text-xl" />
                                </div>
                                <div class="inline-flex">
                                    <select wire:model="sortBy" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                        <option value="role_id">
                                                <x-label :value="__('Role')" class="inline-block" />
                                        </option>
                                        
                                        <option value="name">
                                                <x-label :value="__('Name')" class="inline-block" />
                                        </option>

                                        <option value="created_at">
                                            <x-label :value="__('Date Created')" class="inline-block" />
                                        </option>
                                    </select>
                                    <select wire:model="orderBy" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                        <option value="asc">
                                            <x-label :value="__('Ascending')" class="inline-block" />
                                        </option>

                                        <option value="desc">
                                            <x-label :value="__('Descending')" class="inline-block" />
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>   

                    </div>
                      <!-- Search Bar -->
                      
                      <div class="hidden col-span-2 lg:col-span-2 md:grid items-center align-center relative lg:w-64">
                        <x-input class="h-9 pr-10" type="search" wire:model="search" autofocus />
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 fill-current text-custom-violet absolute right-0" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Reset Filter -->
                    <div class="ml-2 align-center items-center flex  col-span-2">
                        <x-button title="Reset Filter" type="button" wire:click="resetFilter()">
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
</svg>
                        </x-button>
                    </div>
            </div>
        </div>
    </div>


    <div class="max-w-md lg:max-w-none lg:ml-0 ml-4">
        <div class="flex flex-col">
            <div class="my-2 overflow-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden  border-gray-200 sm:rounded-lg">
                        <table class="table-auto max-w-full divide-y divide-gray-200 border-4 border-gray-500">
                        <thead class="bg-custom-black">
                            <tr>
                                <th scope="col" class="md:px-6 px-2 py-3 float-left">
                                    <div>
                                        <input type="checkbox" name="" wire:model="selectAll"
                                        {{ (count($users) == 0) ?  'disabled' : null }}
                                        class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring-indigo-200 focus:ring-opacity-50 @if (count($users) == 0) cursor-not-allowed @endif">
                                    </div>
                                </th>
                                <th scope="col" class="md:px-6 px-2 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    No.
                                </th>
                                <th scope="col" class="md:px-6 px-2 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="md:px-6 px-2 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="md:px-6 px-2 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="md:px-6 px-2 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Actions
                                </th>
                                <th scope="col" class="md:px-6 px-2 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Date Created
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-custom-blacki divide-y divide-gray-200 overflow-auto">
                            @forelse ($users as $index => $user)
                            <tr>
                                <td class="md:px-6 px-2 py-4" wire:key="user-{{ $loop->index }}">
                                    @if($user->role_id == 2)
                                        <div wire:key="user-checkbox-{{ $loop->index }}">
                                            <input @if($user->role_id == 1) {{ $disabled }} @endif type="checkbox" wire:model="checkedUsers.{{ $user->id }}"
                                            class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    @endif
                                </td>

                                <td class="md:px-6 px-2 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-100">
                                        {{ $users->firstItem() + $index }}
                                    </div>
                                </td>

                                <td class="md:px-6 px-2 py-4 whitespace-nowrap ">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="lg:h-10 lg:w-10 w-5 h-5 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm lg:text-xl font-medium text-gray-100">
                                            {{ $user->name }}
                                            </div>
                                            <div class="text-sm text-gray-100">
                                            {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="md:px-6 px-2 py-4 whitespace-nowrap">
                                    @if($user->email_verified_at == !null)
                                    <span class="p-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Verified') }}
                                    </span>
                                    @else
                                    <span class="p-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Unverified') }}
                                    </span>
                                    @endif
                                </td>

                                <td class="md:px-6 px-2 py-4 whitespace-nowrap">
                                    @if($user->role_id == 1)
                                    <span class="p-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-custom-violet text-white">
                                        {{ $user->role->role }}
                                    </span>
                                    @else
                                    <span class="p-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $user->role->role }}
                                    </span>
                                    @endif
                                </td>

                                <td class="flex md:px-6 px-2 py-4 whitespace-nowrap">
                                    @if(!$user->trashed())
                                        <div wire:key="{{ $loop->index }}-edit">
                                            <button wire:click.prevent="openEditModal({{ $user->id }})" class="p-2 bg-green-600 border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Edit') }}
                                                </span>
                                            </button>
                                        </div>

                                        @if($user->role_id != 1)
                                        <div wire:key="{{ $loop->index }}-delete">
                                            <button wire:click.prevent="openDeleteModal({{ $user->id }})" class="p-2 border border-transparent font-semibold text-xs bg-red-600 text-white uppercase tracking-normal hover:bg-red-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Delete') }}
                                                </span>
                                            </button>
                                        </div>
                                        @endif
                                    @else
                                        <div wire:key="{{ $loop->index }}-restore">
                                            <button wire:click.prevent="restoreUser({{ $user->id }})" class="p-2 bg-green-600 border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Restore') }}
                                                </span>
                                            </button>
                                        </div>
                                    @endif
                                </td>

                                <td class="md:px-6 px-2 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-100">
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="md:px-6 px-2 py-4 text-center" colspan="7">
                                    <div>
                                        <span class="font-semibold text-xl text-white leading-tight">
                                            {{ __('There are no matches!') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-6xl mx-auto sm:md:px-6 px-2 lg:px-8">
            <div class="mt-4">
                {{ $users->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    window.addEventListener('exceptionAlert', event => {
        alert('An error occured! ' + event.detail.error);  
    });
</script>
