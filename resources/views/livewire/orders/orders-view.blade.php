<div id="view-modal" class="z-10 flex flex-wrap flex-row justify-items-center align-items-center fixed top-0 left-0 w-full h-full">
    <div class="fixed top-0 left-0 w-full h-full bg-gray-500 opacity-75">

    </div>

    <div class="m-auto z-20">
            <div class="text-white mx-auto">
                <div class="bg-white shadow-sm rounded-lg border-4 border-gray-500">
                    <div class="bg-custom-black border-b border-gray-200">
                        @if(auth()->user()->role_id == 1)
                            @include('orders.view-admin')
                        @else
                            @include('orders.view-user')
                        @endif
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    window.addEventListener('viewModalDisplayNone', event => {
        document.getElementById("view-modal").style.display = "none";
    });
</script>
