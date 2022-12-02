<div>
    <button wire:click="toggleDeleteForm" class="text-indigo-600 group flex items-center py-2 text-sm" role="menuitem"
        tabindex="-1" id="menu-item-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>                           
    </button>
    @if ($show)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto w-full">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative ml-[50%] -translate-x-1/4 max-w-7xl lg:grid lg:grid-cols-7">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                                <button wire:click="toggleDeleteForm" type="button"
                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Retirer des produits
                            </h2>
                            <p class="mt-3 text-md leading-6 text-gray-500">
                                Retirer du stock des produits du type suivant : 
                            </p>

                            {{-- details about commonProduct --}}
                            <div>
                                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-1">
    
                                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                        <dt class="truncate text-sm font-medium text-gray-500">Catégorie</dt>
                                        <dd class="mt-1 mb-2 text-xl font-semibold tracking-tight text-gray-900">
                                            {{ $commonProduct->category->name }}
                                        </dd>
                                        <dt class="truncate text-sm font-medium text-gray-500">Marque</dt>
                                        <dd class="mt-1 mb-2 text-xl font-semibold tracking-tight text-gray-900">
                                            {{ $commonProduct->brand->name }}
                                        </dd>
                                        <dt class="truncate text-sm font-medium text-gray-500">Model</dt>
                                        <dd class="mt-1 mb-2 text-xl font-semibold tracking-tight text-gray-900">
                                            {{ $commonProduct->model }}
                                        </dd>

                                        @if ($commonProduct->photo_product)
                                            <div class="overflow-hidden rounded-lg bg-white shadow w-4/6 mx-auto">
                                                <div class="w-full h-full flex items-center justify-center over" x-data="{ open: false }"
                                                    @keydown.escape="open = false">
                                                    <button @click="open = true">
                                                        <img class="inline-block max-h-24 max-w-80 rounded-md"
                                                            src="{{ Storage::url($commonProduct->photo_product) }}" alt="cover image">
                                                    </button>
                                                    <div class="fixed top-0 left-0 w-full h-full flex items-center bg-gray-500 bg-opacity-50 justify-center z-50"
                                                        x-show.transition="open">
                                                        <div class="h-full w-full flex items-center justify-center overflow-hidden"
                                                            x-data="{ activeSlide: 0, slides: ['https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/40/70/b7f0a6fe156a4cb178c045360b48ad23eaa4.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/41/3e/b579add17b370dbf55964d52dd54a4595643.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/b8/8a/e7942d72cb11ed444b1dccd5edda46c8c84b.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/e3/1e/e3c34dc2a02c202dbcca2ef0117eee5fc29c.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/4e/1a/ba4810652d072eee7dfb8eb818a9b36e0b55.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/e5/33/4546373d4889bc623e33c95ceae0137dd7bd.jpg'] }">
                                                            <template x-for="(slide, index) in slides" :key="index">
                                                                <div class="h-full w-full flex items-center justify-center absolute"
                                                                    @click.outside="open = false">
                                                                    <div class="absolute top-0 bottom-0 py-2 md:py-24 px-2 flex flex-col items-center justify-center"
                                                                        x-show="activeSlide === index"
                                                                        x-transition:enter="transition ease-out duration-150"
                                                                        x-transition:enter-start="opacity-0 transform scale-90"
                                                                        x-transition:enter-end="opacity-100 transform scale-100"
                                                                        x-transition:leave="transition ease-in duration-150"
                                                                        x-transition:leave-start="opacity-100 transform scale-100"
                                                                        x-transition:leave-end="opacity-0 transform scale-90">
                                                                        <img src="{{ Storage::url($commonProduct->photo_product) }}"
                                                                            class="object-contain max-w-full max-h-full rounded shadow-lg " />
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6 w-4/6 mx-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="mx-auto w-10 h-10 text-gray-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                                </svg>

                                            </div>
                                        @endif
                                    </div>
                                    
                                </dl>
                            </div>
                        </div>
                        <div class="bg-white rounded-r-lg py-16 px-4 sm:px-6 lg:col-span-5 lg:py-24 lg:px-8 xl:pl-12">
                            <form wire:submit.prevent='deleteProduct'>
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-100 block">
                                            <tr class="table w-full table-fixed">
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Supprimer
                                                </th>
                                                <th wire:click="reOrder('category')" scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Entrée en stock
                                                </th>
                                                <th wire:click="reOrder('model')" scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Prix
                                                </th>
                                                <th wire:click="reOrder('quantity')" scope="col"
                                                    class="py-3.5 pl-4 text-left text-sm font-semibold text-gray-900">
                                                    Emplacement
                                                </th>
                                                <th wire:click="reOrder('price')" scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-1/3">
                                                    Commentaire
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white block max-h-[40vh] overflow-y-scroll">

                                            @forelse ($products as $product)
                                                <div wire:key="Product-{{ $commonProduct->id }}-{{ $product->id }}">
                                                    <tr
                                                        class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                                        <td class="whitespace-nowrap py-4 pl-4 text-sm text-gray-500 text-left">
                                                            <input wire:model="productsToDelete" type="checkbox" id="product-{{$product->id}}" name="product-{{$product->id}}" value="{{ $product->id }}">
                                                            <label for="product-{{$product->id}}">{{ $product->serial_number }}</label>
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ $product->created_at->format('d/m/y') }}</td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ number_format($product->price, 2, ',', ' ') }} €</td>
                                                        <td class="whitespace-nowrap py-4 pl-4 text-sm text-gray-500">
                                                            <p>{{ $product->rack->name }}</p>
                                                            <p>étage {{ $product->rack_level }}</p>
                                                        </td>
                                                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500 w-1/3">
                                                            {{ $product->comment }}</td>
                                                    </tr>
                                                </div>
                                            @empty
                                                <tr class="bg-white divide-x divide-gray-200 table w-full table-fixed">
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <div class="text-center">
                                                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit</h3>
                                                            <p class="mt-1 text-sm text-gray-500"> Il n'y a aucun produit en stock </p> 
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @error('productsToDelete')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror

                                <div class="absolute bottom-5 right-2 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex mr-3 w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                        Supprimer
                                    </button>
                                    <button wire:click="toggleDeleteForm" type="button"
                                        class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
