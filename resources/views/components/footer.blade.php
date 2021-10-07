<footer class="footer bg-gray-50 relative pt-1 border-t-2 border-red-300">
    <div class="container mx-auto px-6">
        <div class="sm:flex sm:mt-2 w-full">
            <div class="mt-8 flex text-center flex-col md:flex-row flex-1">
                <div class="w-full mb-6 md:mb-0 md:w-1/2">
                    <a href="" class="inline-block font-semibold text-muted text-2xl">
                        {{-- <img :src="$static('/images/logo/white_46.png')" alt="Animid" class="inline-block"> --}}
                        {{ config('app.name') }}
                    </a>
                </div>
                <div class="flex-1 flex flex-col md:flex-row justify-between">
                    <div class="flex flex-col text-left">
                        <span><a href="#" class="text-muted text-lg">Contact Us</a></span>
                        <span class="my-2"><a href="#" class="text-muted text-sm hover:text-black">WhatsApp</a></span>
                    </div>
                    <div class="flex flex-col text-left">
                        <span><a href="#" class="text-muted text-lg">Marketplace</a></span>
                        <span class="my-2"><a href="#" class="text-muted text-sm hover:text-black">Tokopedia</a></span>
                    </div>
                    <div class="flex flex-col text-left">
                        <span><a href="#" class="text-muted text-lg">Payment</a></span>
                        <span class="my-2"><a href="#" class="text-muted text-sm hover:text-black">BRI</a></span>
                        <span class="my-2"><a href="#" class="text-muted text-sm hover:text-black">DANA</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-16 border-t border-red-700 bg-red-600 flex flex-col items-center">
        <div class="container mx-auto px-6">
            <div class="text-center py-3">
                <p class="text-xs text-white">
                    © 2020 {{ config('app.name') }}
                </p>
            </div>
        </div>
    </div>
</footer>
