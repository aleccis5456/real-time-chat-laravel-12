<div>
    @if (session('error'))
        <div id="error" class="absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-black/50">
            <div class="relative bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-8" role="alert">
                <button id="close-error"
                    class="absolute cursor-pointer top-0 -right-1 p-2 text-orange-700 hover:text-orange-900 ">
                    <x-close />
                </button>
                <p class="font-bold text-xl">Be Warned</p>
                <p class="text-lg">Something not ideal might be happening.</p>
            </div>
        </div>

        <script>
            document.getElementById('close-error').addEventListener('click', function() {
                const errorDiv = document.getElementById('error');
                errorDiv.classList.add('hidden');
                this.parentElement.style.display = 'none';
            });
        </script>
    @endif

    @if (session('success'))
        <div id="success" class="absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-black/50">
            <div class="relative bg-green-100 border-l-4 border-green-500 text-green-700 p-8" role="alert">
                <button id="close-success"
                    class="absolute cursor-pointer top-0 -right-1 p-2 text-green-700 hover:text-green-900 ">
                    <x-close />
                </button>
                <p class="font-bold text-xl">Be Warned</p>
                <p class="text-lg">Something not ideal might be happening.</p>
            </div>
        </div>

        <script>
            document.getElementById('close-success').addEventListener('click', function() {
                const successDiv = document.getElementById('success');
                successDiv.classList.add('hidden');
                this.parentElement.style.display = 'none';
            });
        </script>
    @endif
</div>
