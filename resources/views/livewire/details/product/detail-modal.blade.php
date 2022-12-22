<div>
    <button wire:click="toggleModal" class="inline-flex items-center rounded-md border border-transparent bg-white p-3 text-stone-600 shadow hover:bg-stone-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-stone-500 focus:ring-offset-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path d="M11.625 16.5a1.875 1.875 0 100-3.75 1.875 1.875 0 000 3.75z" />
            <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm6 16.5c.66 0 1.277-.19 1.797-.518l1.048 1.048a.75.75 0 001.06-1.06l-1.047-1.048A3.375 3.375 0 1011.625 18z" clip-rule="evenodd" />
            <path d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
        </svg>          
    </button>
    @if ($show)
        <div class="z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-5xl sm:p-6">

                        {{--  CommonProduct values --}}
                        <div>
                            <div class="min-w-0 flex-1 w-full relative">
                                <h2
                                    class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                                    Détail produit : </h2>
                                {{-- close button --}}
                                <div class="hidden sm:block absolute top-0 right-0 pr-2">
                                    <button wire:click="toggleModal" type="button"
                                        class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <span class="sr-only">Close</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                                @if ($commonProduct->photo_product)
                                    <div class="overflow-hidden rounded-lg bg-white shadow">
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
                                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
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

                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">Catégorie</dt>
                                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                        {{ $commonProduct->category->name }}</dd>
                                </div>

                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">Marque</dt>
                                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                        {{ $commonProduct->brand->name }}</dd>
                                </div>

                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">Modèle</dt>
                                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                        {{ $commonProduct->model }}</dd>
                                </div>


                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">
                                        Prix Total
                                    </dt>
                                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">
                                        {{ number_format($commonProduct->totalPriceOnRack($rack, $rack_level), 2, ',', ' ') }}
                                        €
                                        @if ($commonProduct->quantityOnRack($rack, $rack_level) > 1)
                                            <p class="flex items-baseline text-sm font-semibold text-green-600">
                                                <span class="px-24">
                                                    ({{ number_format($commonProduct->totalPriceOnRack($rack, $rack_level) / $commonProduct->quantityOnRack($rack, $rack_level), 2, ',', ' ') }}
                                                    € /u) </span>

                                            </p>
                                        @endif
                                    </dd>
                                </div>
                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">Quantité</dt>
                                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">
                                        {{ $commonProduct->quantityOnRack($rack, $rack_level) }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        {{-- Products details --}}
                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-300 border-b-2">
                                            <thead class="bg-gray-100 block">
                                                <tr class="table w-full table-fixed">
                                                    <th wire:click="reOrder('category')" scope="col"
                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                        Entrée en stock
                                                    </th>
                                                    <th wire:click="reOrder('brand')" scope="col"
                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                        Numéro de série
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
                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                        Commentaire
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white block max-h-[40vh] overflow-y-scroll">
                                                @forelse ($commonProduct->productsOnRack($rack, $rack_level) as $product)
                                                    <div wire:key="Product-{{ $commonProduct->id }}-{{ $product->id }}">
                                                        <tr
                                                            class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                                            <td
                                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{ $product->created_at->format('d/m/y') }}</td>
                                                            <td
                                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{ $product->serial_number }}</td>
                                                            <td
                                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{ number_format($product->price, 2, ',', ' ') }} €</td>
                                                            <td
                                                                class="whitespace-nowrap py-4 pl-4 text-sm text-gray-500">
                                                                <p>{{ $product->rack->name }}</p>
                                                                <p>étage {{ $product->rack_level }}</p>
                                                            </td>
                                                            <td
                                                                class="whitespace-normal px-3 py-4 text-sm text-gray-500">
                                                                {{ $product->comment }}
                                                            </td>
                                                        </tr>
                                                    </div>
                                                @empty
                                                    <tr
                                                        class="bg-white divide-x divide-gray-200 table w-full table-fixed">
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            <div class="text-center">
                                                                <svg class="mx-auto h-12 w-12 text-gray-400"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                                    Aucun produit</h3>
                                                                <p class="mt-1 text-sm text-gray-500">Vous pouvez en
                                                                    ajouter un nouveau</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            
                                        </table>
                                        <div class="relative">
                                            <div class="justify-end flex">
                                                <button
                                                    wire:click="openWarningDelete({{ $commonProduct }})"
                                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto m-2">
                                                    Gérer les produits
                                                </button>
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
    @endif
</div>
