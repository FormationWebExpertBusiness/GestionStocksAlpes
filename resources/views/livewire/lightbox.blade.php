<body class="h-full">
    <div class="w-full h-full flex items-center justify-center" x-data="{ open: false }" @keydown.escape="open = false">
        <button @click="open = true">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-6 w-6 text-indigo-600 hover:text-indigo-900">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            
        </button>
        <div class="fixed top-0 left-0 w-full h-full flex items-center bg-gray-500 bg-opacity-50 justify-center z-50"
            x-show.transition="open">
            <div class="h-full w-full flex items-center justify-center overflow-hidden" x-data="{ activeSlide: 0, slides: ['https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/40/70/b7f0a6fe156a4cb178c045360b48ad23eaa4.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/41/3e/b579add17b370dbf55964d52dd54a4595643.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/b8/8a/e7942d72cb11ed444b1dccd5edda46c8c84b.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/e3/1e/e3c34dc2a02c202dbcca2ef0117eee5fc29c.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/4e/1a/ba4810652d072eee7dfb8eb818a9b36e0b55.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/e5/33/4546373d4889bc623e33c95ceae0137dd7bd.jpg'] }">

                <template x-for="(slide, index) in slides" :key="index">
                    <div class="h-full w-full flex items-center justify-center absolute" @click.outside="open = false">
                        <div class="absolute top-0 bottom-0 py-2 md:py-24 px-2 flex flex-col items-center justify-center"
                            x-show="activeSlide === index" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90">
                            <img src="{{ Storage::url($commonItem->photo_item) }}"
                                class="object-contain max-w-full max-h-full rounded shadow-lg " />
                        </div>

                    </div>
                </template>
            </div>
        </div>
    </div>
</body>
