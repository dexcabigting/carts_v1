<div>
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />
        
    <div class="grid grid-rows-2 grid-cols-2 lg:grid-rows-1 lg:grid-cols-3 justify-end items-start mb-4 gap-4 lg:gap-2">
        <!-- Delete Button -->
        <div class="">                       
            <button wire:click.prevent="deleteChecked()"          
                type="button" {{ (!$checkedUsers) ?  'disabled' : null }}
                class="px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedUsers) cursor-not-allowed @endif">
                {{ __('Delete Selected') }} 
                @if ($checkedUsers)
                    ({{ count($checkedUsers) }})
                @endif
            </button>
        </div>

        <!-- Sort By and Order By -->
        <div class="flex">
            <div class="text-sm font-medium text-gray-900">
                <span>
                    {{ _('Sort By') }}
                </span>
                <select wire:model="sortBy" 
                class="text-sm font-medium text-gray-900 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                    <option value="Name">Name</option>
                    <option value="Email">Email</option>
                </select>
            </div>

            <div class="text-sm font-medium text-gray-900">
                <span>
                    {{ _('Order By') }}
                </span>
                <select wire:model="orderBy" 
                class="text-sm font-medium text-gray-900 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                    <option value="asc">Earliest</option>
                    <option value="desc">Latest</option>
                </select>
            </div>
        </div>
        
        <!-- Search Bar -->
        <div class="col-span-2 lg:col-span-1 grid items-center relative lg:w-full">
            <x-input class="pr-10" placeholder="Search by {{ $sortBy }}" type="search" wire:model="search" autofocus />
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 fill-current text-indigo-300 absolute right-0" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
    
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table-auto min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 float-left">
                                <div>
                                    <input type="checkbox" name="" wire:model="selectAll" 
                                    {{ (count($users) == 0) ?  'disabled' : null }}
                                    class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring-indigo-200 focus:ring-opacity-50 @if (count($users) == 0) cursor-not-allowed @endif">
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date Created
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($users as $index => $user)
                        <tr> 
                            <td class="px-6 py-4" wire:key="user-{{ $loop->index }}">
                                <div>
                                    <input type="checkbox" wire:model="checkedUsers.{{ $user->id }}" 
                                    class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap"> 
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $users->firstItem() + $index }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                        {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->email_verified_at == !null)
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

                            <td class="flex px-6 py-4 whitespace-nowrap">
                                <div>
                                    <a href="{{ route('users.edit', [$user->id]) }} ">
                                        <button class="p-2 bg-green-500 rounded-l-md border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                                {{ __('Edit') }}
                                            </span>
                                        </button>
                                    </a>    
                                </div>

                                <div>
                                    <button class="p-2 bg-red-500 rounded-r-md border border-transparent font-semibold text-xs text-white uppercase tracking-normal hover:bg-red-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                        wire:click.prevent="deleteRow({{ $user->id }})"
                                        onclick="confirm('Are you sure you want to delete this record?') || event.stopImmediatePropagation()">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ __('Delete') }}
                                        </span>
                                    </button>
                                </div>                                                                         
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4 text-center" colspan="6">
                                <div>
                                    <span class="font-semibold text-xl text-gray-800 leading-tight">
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

    <div class="mt-4">
        {{ $users->onEachSide(5)->links() }}
    </div>

    <div class="flex items-center justify-start mt-4">
        <a href="{{ route('users.create') }}">
            <x-button>
                {{ __('Create User') }}
            </x-button>
        </a>
    </div>                
</div>