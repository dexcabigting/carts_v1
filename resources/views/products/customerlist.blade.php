<div class="h-auto lg:pl-20 xl:pl-80 lg:mt-5">
    <div class="pt-12 pb-5">
        <div class="max-w-6xl mx-auto">
            <!-- <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row gap-5 p-6 bg-custom-blacki shadow-2xl overflow-x-auto">

                </div>
            </div> -->
        </div>
    </div>
    
    <div class="w-full max-w-sm lg:max-w-6xl h-auto lg:pl-3 xl:pl-20 2xl:pl-80 lg:mt-5 ml-5 lg:ml-0 flex items-center justify-center">
        <div class="flex flex-col">
            <div class="my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <table class="table-auto min-w-full divide-y divide-gray-200 border-4 border-gray-500">
                        <thead class="bg-custom-blacki ">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Customer Name
                                </th>
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
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Actions
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Custom Price
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-custom-text divide-y divide-gray-200">
                            @foreach ($tshirt_details as $index => $tshirt_detail)
                            <tr> 
                                <td class="px-6 py-4 whitespace-nowrap"> 
                                    <div class="text-sm font-medium text-gray-100">
                                        fritz
                                    </div>
                                </td>
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
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <button type="button" data-value="{{ str_replace('"', '', $tshirt_detail->tshirt_pdf) }}" class="btn-export-pdf p-2 bg-blue-600  border border-transparent font-semibold text-xs text-white uppercase">
                                            EXPORT TO PDF
                                        </button> 
                                    </div>
                                    @if (!$tshirt_detail->is_approve)
                                        <div>
                                            <button
                                                class="btn-open-modal p-2 bg-yellow-500 border border-transparent font-semibold text-xs text-white uppercase"
                                                data-id="{{ $tshirt_detail->id }}">
                                                Approve
                                            </button> 
                                        </div>
                                    @endif
                                </div>                                                                
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                     
                                    <div class="text-sm font-medium text-gray-100">
                                        {{ str_replace('"', '', $tshirt_detail->custom_price) }}
                                    </div>                                      
                                </td>
                                <td>
                                </td>
                            </tr>
                            @endforeach
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
