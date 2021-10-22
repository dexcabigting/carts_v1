<div class="h-screen lg:ml-80 lg:mt-9">
    <div class="pt-12 pb-5">
        <div class="max-w-6xl mx-auto">
            <!-- <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row gap-5 p-6 bg-custom-blacki shadow-2xl overflow-x-auto">

                </div>
            </div> -->
        </div>
    </div>
    
    <div class="max-w-6xl mx-auto ">
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
                            </tr>
                        </thead>

                        <tbody class="bg-custom-text divide-y divide-gray-200">
                            @foreach ($tshirt_details as $tshirt_detail)
                            <tr> 
                                <td class="px-6 py-4 whitespace-nowrap"> 
                                    <div class="text-sm font-medium text-gray-100">
                                        {{ str_replace('"', '', $tshirt_detail->customer_name) }}
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
                                            $each_measurement = json_decode($tshirt_detail->tshirt_measurements,true);

                                            foreach($each_measurement as $key => $value)
                                                echo $key.": ".$value."<br/>";
                                                
                                        @endphp
                                    </div>                                      
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                     
                                    <div class="text-sm font-medium text-gray-100">
                                        {{ str_replace('"', '', $tshirt_detail->created_date->format('Y-m-d')) }}
                                    </div>                                      
                                </td>
                                <td class="flex px-6 py-4 whitespace-nowrap">
                                    
                                    <button type="button" data-value="{{ str_replace('"', '', $tshirt_detail->tshirt_pdf) }}" class="btn-export-pdf p-2 bg-blue-600  border border-transparent font-semibold text-xs text-white uppercase">
                                        EXPORT TO PDF
                                    </button>                                                                  
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>	
    <script>
        $(document).ready(function(){
            $(".btn-export-pdf").on("click",function(){
                var exportData = $(this).data("value");
                
                const downloadLink = document.createElement("a");
                const fileName = "Custom-Details.pdf";
                downloadLink.href = exportData;
                downloadLink.download = fileName;
                downloadLink.click();
            });
        });
    </script>
    <div class="pb-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4">
            </div>
        </div>
    </div>
</div>