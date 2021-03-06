<div class="h-1/2 mt-4 2xl:mx-64 lg:mx-40">
    <div class="" id="slider">
        <div id="line">

        </div>

        <ul class="h-1/2" id="move">
            <li><img src="img/flyers2.jpg"></li>
            <li><img src="img/flyers.jpg"></li>
            <li><img src="img/NEW_JERSEY_SIZE_CHART.jpg"></li>
            <li><img src="img/NEW_LONG_SLEEVE_SIZE_CHART.jpg"></li>
            <li><img src="img/NEW_SHIRT_SIZE_CHART.jpg"></li>
        </ul>
        <div id="back">
            <
        </div>
        <div id="forword">
            >
        </div>
        <div id="dots">
            
        </div>
        
    </div>
</div>
<script>
window.onload = function() {

let slider = document.querySelector('#slider');
let move = document.querySelector('#move');
let moveLi = Array.from(document.querySelectorAll('#slider #move li'));
let forword = document.querySelector('#slider #forword');
let back = document.querySelector('#slider #back');
let counter = 1;
let time = 3000;
let line = document.querySelector('#slider #line');
let dots = document.querySelector('#slider #dots');
let dot;

for (i = 0; i < moveLi.length; i++) {

    dot = document.createElement('li');
    dots.appendChild(dot);
    dot.value = i;
}

dot = dots.getElementsByTagName('li');

line.style.animation = 'line ' + (time / 1000) + 's linear infinite';
dot[0].classList.add('active');

function moveUP() {

    if (counter == moveLi.length) {

        moveLi[0].style.marginLeft = '0%';
        counter = 1;

    } else if (counter >= 1) { 

        moveLi[0].style.marginLeft = '-' + counter * 100 + '%';
        counter++;
    } 

    if (counter == 1) {

        dot[moveLi.length - 1].classList.remove('active');
        dot[0].classList.add('active');

    } else if (counter > 1) {

        dot[counter - 2].classList.remove('active');
        dot[counter - 1].classList.add('active');

    }

}

function moveDOWN() {

    if (counter == 1) {

        moveLi[0].style.marginLeft = '-' + (moveLi.length - 1) * 100 + '%';
        counter = moveLi.length;
        dot[0].classList.remove('active');
        dot[moveLi.length - 1].classList.add('active');

    } else if (counter <= moveLi.length) {

        counter = counter - 2;
        moveLi[0].style.marginLeft = '-' + counter * 100 + '%';   
        counter++;

        dot[counter].classList.remove('active');
        dot[counter - 1].classList.add('active');

    }  

}

for (i = 0; i < dot.length; i++) {

    dot[i].addEventListener('click', function(e) {

        dot[counter - 1].classList.remove('active');
        counter = e.target.value + 1;
        dot[e.target.value].classList.add('active');
        moveLi[0].style.marginLeft = '-' + (counter - 1) * 100 + '%';

    });

}

forword.onclick = moveUP;
back.onclick = moveDOWN;

// let autoPlay = setInterval(moveUP, time);

slider.onmouseover = function() {

    // autoPlay = clearInterval(autoPlay);
    line.style.animation = '';

}

slider.onmouseout = function() {

    // autoPlay = setInterval(moveUP, time);
    line.style.animation = 'line ' + (time / 1000) + 's linear infinite';

}

}

</script>
<div>
    <div class="items-center lg:mx-40 2xl:mx-64">
        <div class="mx-2 md:mx-auto">
            <div class="shadow-xl overflow-hidden rounded-lg">
                <div class="block md:flex md:flex-row items-center md:justify-center py-6 bg-custom-blacki overflow-x-auto">
                    <!-- Filters -->
                    <div class="px-12 flex flex-col xl:flex-row">
                        <div class="flex flex-col xl:flex-row items-center justify-center text-base font-medium text-gray-100 py-4 my-2 md:my-0">
                            <div class="flex 2xl:flex-row flex-col items-center justify-center">
                                <div class="flex flex-col xl:flex-row justify-center items-center"> 
                                    <div>
                                <select wire:model="category" class="my-2 mx-2 text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                    <option value="All" selected>
                                        <x-label value="All categories" class="inline-block" />
                                    </option>
                                    @foreach($categories as $category)

                                    <option value="{{ $category->id }}">
                                        <x-label value="{{ $category->ctgr_name }}" class="inline-block" />
                                    </option>
                                    @endforeach
                                </select>

                                <select wire:model="fabric" class="my-2 mx-2 text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                    <option value="All" selected>
                                        <x-label value="All fabrics" class="inline-block" />
                                    </option>
                                    @foreach($fabrics as $fabric)
                                    <option value="{{ $fabric->id }}">
                                        <x-label value="{{ $fabric->fab_name }}" class="inline-block" />
                                    </option>
                                    @endforeach
                                </select>
                                </div>
                                <div>
                                <div>
                                <select wire:model="sortBy" class="my-2 mx-2 text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="prd_name">
                                        <x-label value="Name" class="inline-block" />
                                    </option>
                                    <option value="prd_price">
                                        <x-label value="Price" class="inline-block" />
                                    </option>
                                </select>

                                <select wire:model="orderBy" class="my-2 mx-2 text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <<option value="asc">
                                        <x-label value="Ascending" class="inline-block" />
                                    </option>
                                    <option value="desc">
                                        <x-label value="Descending" class="inline-block" />
                                    </option>
                                </select>
                                </div>

                                </div>

                                
                                <div class="flex md:flex-row flex-col">
                                    <div class="flex flex-row">
                                <div class="my-2 mx-2 text-sm font-medium bg-custom-blacki text-white rounded-xl shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                    <input wire:model.debounce.500ms="min" placeholder="Minimum Price" type="text" class="rounded-lg text-black w-32"/>
                                    @error('min') <span class="text-red-500 text-sm font-small">{{ $message }}</span> @enderror
                                </div>

                                <div class="my-2 text-sm font-medium bg-custom-blacki text-white rounded-xl shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                    <input wire:model.debounce.500ms="max" placeholder="Maximum Price" type="text" class="rounded-lg text-black w-32"/>
                                    @error('max') <span class="text-red-500 text-sm font-small">{{ $message }}</span> @enderror
                                </div>
                                </div>
                            
                        <div class="flex flex-row w-full md:-ml-8">

                    <!-- Search Bar -->
                    <div class="text-black col-span-2 lg:col-span-2 grid items-center align-center ml-2 lg:ml-12 relative md:w-64 xl:w-72 2xl:w-64">
                        <x-input class="h-9 pr-4" type="search" wire:model.debounce.500ms="search" autofocus />
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 fill-current text-indigo-300 absolute right-0" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    

                     <!-- Reset Filter -->
                    <div class="2xl:ml-4  lg:items-center align-center col-span-2 grid">
                        <x-button title="Reset" type="button" wire:click="resetFilter()" class="hover:text-purple-100 text-sm font-semibold text-white mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>   
                        {{ __('') }}
                        </x-button>
                    </div>
                    </div>
                    
                    
                        </div>
                        
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <div class="my-12 pb-6 w-full justify-center items-center flex">
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 max-w-6xl md:mx-24 lg:mx-auto mx-4 xl:mx-auto">
            @forelse ($products as $product)
            <!-- Loop Content -->
            <div class="w-full flex flex-col gap-5 p-5 border-4 border-gray-500 bg-custom-blacki h-auto overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="p-5 bg-white m-auto rounded-lg relative">
                    <div class="text-black text-l absolute top-5 left-5">
                        Sold: {{ $product->product_variants_sum_sold_count }}
                    </div>
                    <img class="bg-black py-2 px-2 h-10 w-10 absolute top-0 right-0 rounded-tr-md" src="img/Group 12.svg">
                    <div class="flex-none m-auto p-10 bg-white shadow-2xl">
                        <img class="h-40 w-40" src="{{ Storage::url('public/'.$product->product_variants->first()->front_view) }}" />
                    </div>

                    <div class="text-black text-2xl absolute bottom-5 right-5">
                        &#8369;{{ number_format($product->prd_price, 2) }}
                    </div>
                </div>

                <div class="text-white font-bold text-2xl ">
                    {{ $product->prd_name }}
                </div>

                <div>
                    <div class="flex  flex-wrap text-white text-center">
                    @php
                        $sizes = [
                            '2XS' => 0,
                            'XS' => 0,
                            'S' => 0,
                            'M' => 0,
                            'L' => 0,
                            'XL' => 0,
                            '2XL' => 0
                        ];
                    @endphp
                    
                    @foreach($product->product_variants as $productVariant)
                        @foreach($productVariant->product_stock->sizes->toArray() as $column => $value)
                            @if($value > 0) 
                                @php
                                    $sizes[$column] = $sizes[$column] + $value;
                                @endphp
                            @endif
                            {{--<div class="p-1 border border-gray-300 rounded-lg w-10">
                                {{ $column }}
                                <div class="justify p-1 border border-gray-300 rounded-lg">
                                    {{ $value }}
                                </div>
                            </div>--}}
                        @endforeach
                    @endforeach

                    @foreach($sizes as $column => $value)
                        <div class="p-1 border border-gray-300 rounded-lg w-10">
                            {{ $column }}
                            <div class="justify p-1 border border-gray-300 rounded-lg">
                                {{ $value }}
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="text-white text-l">
                    {{ $product->fabric->fab_name }} {{ $product->category->ctgr_name }}
                </div>

                <div class="flex flex-row justify-end gap-5 absolute bottom-0 right-0 pb-2 pr-5">
                    <div>
                        @if($product->isAuthUserLikedProduct())
                        <x-button wire:click.prevent="unlikeProduct({{ $product->id }})" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 rounded-md bg-custom-violet" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                        </x-button>
                        @else
                        <x-button wire:click.prevent="likeProduct({{ $product->id }})" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 rounded-md hover:bg-custom-violet" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                        </x-button>
                        @endif
                    </div>

                    <div>
                        <x-button wire:click.prevent="openCartModal({{ $product->id }})" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 rounded-md hover:bg-custom-violet" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </x-button>
                    </div>

                </div>
            </div>
            @empty
            <div class="flex justify-center items-center w-full ">
                <div class="text-gray-400 font-bold text-2xl md:text-4xl text-center">
                    <h1>There are no results</h1>
                </div>
            </div>
            @endforelse
            <div wire:loading wire:target="max" class="flex justify-center items-center w-full ">
                <div class="text-gray-400 font-bold text-2xl md:text-4xl text-center">
                    <h1>Loading...</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12 text-gray-100">
        <div class="max-w-6xl mx-auto">
            <div class="">
                {{ $products->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>
