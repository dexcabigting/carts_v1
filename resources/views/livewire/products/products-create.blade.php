<div id="create-modal" class="flex flex-wrap flex-row justify-items-center align-items-center fixed top-0 left-0 w-full h-full">
    <div class="py-12 fixed top-0 left-0 w-full h-full bg-gray-500 opacity-75 z-10">

    </div>

    <div class="m-auto z-20">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg border-2 border-transparent">
                <div class="p-8 bg-white border-b border-gray-200">
                    @include('products.create')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('createModalDisplayNone', event => {
        document.getElementById("create-modal").style.display = "none";
    });
</script>