<div class="h-auto lg:pl-3 xl:pl-20 2xl:pl-80 lg:mt-5">
    <div class="mt-12 bg-custom-blacki max-w-md lg:max-w-6xl mx-auto ml-5 lg:ml-0">
                <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    My Reservations
                </div>
    </div>
    
    <div class="max-w-md lg:max-w-6xl mx-auto ml-5 lg:ml-0">
        <div class="flex flex-col">
            <div class="my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <table class="table-auto min-w-full divide-y divide-gray-200 border-4 border-gray-500">
                        <thead class="bg-custom-blacki ">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Jersey Type
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Fabric
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Measurement
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Actions
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Custom Price
                                </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Date Reserved
                                </th>
                                </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Completion Date
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-custom-text divide-y divide-gray-200">
                            @forelse ($tshirt_details as $tshirt_detail)
                            <tr> 
                                <td class="px-6 py-4 whitespace-nowrap"> 
                                    <div class="text-sm font-medium text-gray-100">
                                        {{ str_replace('"', '', $tshirt_detail->tshirt_type) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                     
                                    <div class="text-sm font-medium text-gray-100">
                                        {{ str_replace('"', '', $tshirt_detail->tshirt_fabric) }}
                                    </div>                                      
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                     
                                    <div class="text-sm font-medium text-gray-100">
                                        @php
                                            $each_measurement = json_decode($tshirt_detail->tshirt_jersey_measurements,true);
                                            
                                            echo "<h3>Jersey</h3>";

                                            foreach($each_measurement as $key => $value)
                                                echo $key.": ".$value."<br/>";
                                                
                                            $each_short_measurement = json_decode($tshirt_detail->tshirt_short_measurements,true);
                                            
                                            echo "<br/><h3>Jersey Short</h3>";

                                            foreach($each_short_measurement as $key => $value)
                                                echo $key.": ".$value."<br/>";
                                        @endphp
                                    </div>                                      
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-100">
                                        @if(!$tshirt_detail->is_approve)
                                            Pending
                                        @else
                                            Approved
                                        @endif
                                    </div>                                                                
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex flex-row">                                     
                                    @if($tshirt_detail->is_approve)
                                    <div>
                                        <a href="">
                                            <button type="button" class="p-2 bg-custom-violet hover:bg-purple-900 hover:text-purple-100 border border-transparent font-semibold text-xs text-white uppercase tracking-wide focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </a>
                                    </div>
                                    @else
                                    <div>
                                        <button type="button" class="p-2 bg-red-600  border border-transparent font-semibold text-xs text-white uppercase tracking-normal hover:bg-red-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>

                                            </span>
                                        </button>
                                    </div>  
                                    @endif                                
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                     
                                    <div class="text-sm font-medium text-gray-100">
                                         &#8369;{{ number_format($tshirt_detail->custom_price, 2) }}
                                    </div>                                      
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                     
                                    <div class="text-sm font-medium text-gray-100">
                                        {{ $tshirt_detail->created_at->diffForHumans() }}
                                    </div>                                      
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                     
                                    <div class="text-sm font-medium text-gray-100">
                                        @if($tshirt_detail->custom_estimate_delivery)
                                        {{ $tshirt_detail->custom_estimate_delivery->toFormattedDateString() }}
                                        @endif
                                    </div>                                      
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="px-6 py-4 text-center w-full items-center" colspan="8">
                                    <div>
                                        <span class="font-semibold text-xl text-gray-100  leading-tight">
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

    <div id="approve-modal" hidden class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
			
			<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

			<div class="modal-body-class inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
			<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
				<div class="sm:flex sm:items-start">
				
				<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
					<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Approve Custom Product
					</h3>
					<div class="mt-2">
                        
                    <input id="id-holder" type="hidden" />
					<label for="note">
                        Note:
                        <textarea id="note" cols="30" rows="2">
                        </textarea>
                    </label>
					</div>
					<div class="mt-2">
					<label for="price">
                        Price:
                        <input id="price" type="number" />
                    </label>
					</div>
					<div class="mt-2">
					<label for="estimate-delivery">
                        Estimate Delivery:
                        <input id="estimate-delivery" type="date" />
                    </label>
					</div>
				</div>
				</div>
			</div>
			<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" 
                        id="btn-approve" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent 
                        shadow-sm px-4 py-2 bg-green-400 text-base font-medium text-white hover:bg-green-500 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-green-400 sm:ml-3 sm:text-sm">
				    APPROVE
				</button>
				<button type="button" 
                        id="btn-close" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent 
                        shadow-sm px-4 py-2 bg-gray-300 text-base font-medium text-white hover:bg-gray-400 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-gray-300 sm:ml-3 sm:text-sm">
				    CLOSE
				</button>
			</div>
			</div>
		</div>
	</div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>	
	<script src="{{asset('js/admin-modules/approve-module.js')}}"></script>
    <div class="pb-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4">
            </div>
        </div>
    </div>
</div>
