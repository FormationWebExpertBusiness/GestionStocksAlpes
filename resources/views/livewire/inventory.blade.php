<div>
    <div class="px-4 sm:px-6 lg:px-8" wire:init='loadData'>
        <div class="sm:flex sm:items-center mt-10 mb-6">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        Inventaire</h2>
                </div>
                <p class="mt-2 text-sm text-gray-700">Liste de tout les produits du stock</p>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-10 sm:flex-none">
                @livewire('forms.product.product-add-form', key('product-add-form'))
            </div>
        </div>
        @livewire('warning-before-delete')
        @livewire('forms.product.product-edit-form', key('product-edit-form'))
        {{-- filters --}}
        @livewire('filters.product-filters', ['catsFilter' => $catsFilter, 'brandsFilter' => $brandsFilter, 'commonProductsFilter' => $commonProductsFilter, 'racksFilter' => $racksFilter, 'rackLevelsFilter' => $rackLevelsFilter, 'searchFilter' => $searchFilter], key('product-filters'))

        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-100 block">
                                <tr class="table w-full table-fixed">
                                    <th wire:click="reOrder('created_at')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[10.5%]">
                                        Entrée en stock
                                        <x-ordering-arrows champ='created_at' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('category')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Catégorie
                                        <x-ordering-arrows champ='category' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('brand')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Marque
                                        <x-ordering-arrows champ='brand' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('model')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Modèle
                                        <x-ordering-arrows champ='model' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('serial_number')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Numéro de série
                                        <x-ordering-arrows champ='serial_number' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('rack')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[9%]">
                                        Position
                                        <x-ordering-arrows champ='rack' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('price')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[7%]">
                                        Prix
                                        <x-ordering-arrows champ='price' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-1/6">
                                        Commentaire
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        <span class="sr-only">Actions</span>
                                        <div class="inline-block px-5"></div>
                                        <div class="inline-block px-5"></div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white block max-h-[54vh] overflow-y-scroll">
                                @forelse ($products as $product)
                                    <div wire:key="Common-product-{{ $product->id }}">
                                        <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-[10.5%]">
                                                {{ $product->created_at->format('d/m/y') }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $product->getCategory()->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $product->getBrand()->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $product->getModel() }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $product->serial_number }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-[9%]">
                                                {{ $product->rack->name }} <br>
                                                Étage {{ $product->rack_level }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-[7%]">
                                                {{ number_format($product->price, 2, ',', ' ') }}€
                                            </td>
                                            <td class="whitespace-wrap px-3 py-4 text-sm text-gray-500 w-1/6">
                                                {{ $product->comment }}
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                                                <div class="inline-block px-5">
                                                    <button class="text-indigo-600 hover:text-indigo-900" wire:click.prevent="$emit('refreshEditComponent', {{ $product->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="inline-block px-5">
                                                    <button wire:click="openWarningDelete({{ $product->id }})" class="text-indigo-600 hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </div>
                                @empty
                                    @if ($readyToLoad)
                                        <tr class="bg-white divide-x divide-gray-200 table w-full table-fixed">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>

                                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit</h3>
                                                    <p class="mt-1 text-sm text-gray-500">Vous pouvez en ajouter un nouveau
                                                    </p>
                                                    <div class="mt-3">
                                                        @livewire('forms.product.product-add-form', key('product-add-form-empty'))
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @for ($i = 0; $i < 12; $i++)
                                            <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[10.5%]">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[9%]">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[7%]">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-1/6">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                            </tr>
                                        @endfor
                                    @endif
                                @endforelse
                            </tbody>
                        </table>
                        <div class="relative">
                            <div class="border-t justify-center flex py-4">
                                {{ $products->links() }}
                            </div>
                            {{-- <div class="justify-end flex">
                                <button wire:click='export' type="button" class=" absolute top-6 bottom-6 right-4 inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Exporter en CSV</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
