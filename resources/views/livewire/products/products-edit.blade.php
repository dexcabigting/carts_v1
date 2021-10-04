<div id="edit-modal" class="z-20 flex flex-wrap flex-row justify-items-center align-items-center fixed top-0 left-0 w-full h-full">
    <div class="py-12 fixed top-0 left-0 w-full h-full bg-gray-500 opacity-75">

    </div>

    <div class="m-auto z-30">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg border-2 border-transparent">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('products.edit')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('editModalDisplayNone', event => {
        document.getElementById("edit-modal").style.display = "none";
    });
</script>