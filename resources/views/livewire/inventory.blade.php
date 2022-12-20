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

        <header class="bg-white pb-2 rounded-t-lg">
            <section aria-labelledby="filter-heading">
                <div class="bg-white pb-4">
                    <div class="mx-auto flex max-w-full items-center justify-center">
                        <div class="flow-root">
                            <div class="-mx-4 flex items-center divide-x divide-gray-200">
                                {{-- search bar --}}
                                <div class="relative inline-block px-4 text-left" >
                                    <div class="min-w-0 flex-1">
                                        <label for="search" class="sr-only">Search</label>
                                        <div class="relative rounded-md shadow-sm">
                                              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <!-- Heroicon name: mini/magnifying-glass -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                      <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                                </svg>
                                              </div >
                                              <div class="inline-block mt-1 w-80 border rounded-md border-gray-300 focus-within:border-indigo-600">
                                                  <input type="search" name="search" id="search" wire:model="searchFilter" class="block rounded-md w-full pl-10 border border-transparent bg-gray-50 focus:border-indigo-600 focus:ring-0 sm:text-sm" placeholder="Rechercher">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Rack Dropdown --}}
                                <div class="relative inline-block px-4 text-left">
                                    <button type="button" wire:click="$toggle('isVisibleRack')" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                    <span>Étagère</span>
                                    <span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($racksFilter) }}</span>
                                    <!-- Heroicon name: mini/chevron-down -->
                                    <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                    </button>
                                    @if ($isVisibleRack)
                                        <div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none max-h-64 overflow-scroll" @click.outside="$wire.isVisibleRack = false">
                                            <form class="space-y-1">
                                            @foreach ($racks as $rack)
                                                <div class="flex items-center">
                                                    <input id="{{ 'rack' . $rack->id }}" name="{{ $rack->name }}"
                                                    value="{{ $rack->id }}" type="checkbox" wire:model='racksFilter' class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="{{ 'rack' . $rack->id }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $rack->name }}</label>
                                                </div>
                                            @endforeach
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                {{-- RackLevel Dropdown --}}
                                <div class="relative inline-block px-4 text-left">
                                    <button type="button" wire:click="$toggle('isVisibleRackLevel')" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                    <span>Numéro d'étage</span>
                                    <span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($rackLevelsFilter) }}</span>
                                    <!-- Heroicon name: mini/chevron-down -->
                                    <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                    </button>
                                    @if ($isVisibleRackLevel)
                                        <div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none max-h-64 overflow-scroll" @click.outside="$wire.isVisibleRackLevel = false">
                                            <form class="space-y-1">
                                            @foreach ($rackLevels as $rackLevel)
                                                <div class="flex items-center">
                                                    <input id="{{ 'rackLevel' . $rackLevel }}" name="{{ 'rackLevel' . $rackLevel }}"
                                                    value="{{ $rackLevel }}" type="checkbox" wire:model='rackLevelsFilter' class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="{{ 'rackLevel' . $rackLevel }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Étage {{ $rackLevel }}</label>
                                                </div>
                                            @endforeach
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                {{-- commonProduct Dropdown --}}
                                <div class="relative inline-block px-4 text-left">
                                    <button type="button" wire:click="$toggle('isVisibleCommonProduct')" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                        <span>Type de produit</span>
                                        <span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($commonProductsFilter) }}</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    @if ($isVisibleCommonProduct)
                                        <div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none max-h-64 overflow-scroll" @click.outside="$wire.isVisibleCommonProduct = false">
                                            <form class="space-y-1">
                                                @foreach ($commonProducts as $commonProduct)
                                                    <div class="flex items-center">
                                                        <input id="{{ 'commonProduct' . $commonProduct->id }}" name="{{ $commonProduct->model }}" value="{{ $commonProduct->id }}" type="checkbox" wire:model='commonProductsFilter' class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                        <label for="{{ $commonProduct->model }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $commonProduct->model }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                {{-- categories Dropdown --}}
                                <div class="relative inline-block px-4 text-left">
                                    <button type="button" wire:click="$toggle('isVisibleCat')" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                        <span>Catégories</span>
                                        <span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($catsFilter) }}</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    @if ($isVisibleCat)
                                        <div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none max-h-64 overflow-scroll" @click.outside="$wire.isVisibleCat = false">
                                            <form class="space-y-1">
                                                @foreach ($categories as $category)
                                                    <div class="flex items-center">
                                                        <input id="{{ 'cat' . $category->id }}" name="{{ $category->name }}" value="{{ $category->id }}" type="checkbox" wire:model='catsFilter' class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                        <label for="{{ $category->name }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $category->name }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                {{-- brands Dropdown --}}
                                <div class="relative inline-block px-4 text-left">
                                    <button wire:click="$toggle('isVisibleBrand')" type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                        <span>Marques</span>
                                        <span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($brandsFilter) }}</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    @if ($isVisibleBrand)
                                        <div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none max-h-64 overflow-scroll" @click.outside="$wire.isVisibleBrand = false">
                                            <form class="space-y-1">
                                                @foreach ($brands as $brand)
                                                    <div class="flex items-center">
                                                        <input id="{{ 'brand' . $brand->id }}" name="{{ 'brand' . $brand->id }}" 
                                                            value="{{ $brand->id }}" type="checkbox" wire:model='brandsFilter' 
                                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                        <label for="{{ 'brand' . $brand->id }}" 
                                                            class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $brand->name }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                {{-- resert filters button --}}
                                <div class="relative inline-block px-4 text-left">
                                    <button wire:click="resetFilters" type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>                                      
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Active filters -->
                    <div class="bg-gray-100 mt-4 -mx-8">
                        <div class="mx-auto max-w-7xl px-4 sm:flex sm:items-center sm:px-6 lg:px-8">
                            <h3 class="text-sm font-medium text-gray-500 whitespace-nowrap">
                                filtres actifs
                                <span class="sr-only">, active</span>
                            </h3>
                  
                            <div class="h-5 w-px bg-gray-800 sm:ml-4 sm:block"></div>
                    
                            <div class="my-2 sm:ml-4 max-w-full overflow-x-auto overflow-y-hidden white-space:nowrap min-w-full max-h-12 min-h-12 mt-2">
                                <div class="flex items-center h-12">
                                    @foreach ($this->getAllFilters() as $filter)
                                        <span class="m-1 inline-flex items-center rounded-full border border-gray-200 bg-white py-1.5 pl-3 pr-2 text-sm font-medium text-gray-900 mb-2">
                                            <span class="whitespace-nowrap">{{ $filter }}</span>
                                            <button type="button" class="ml-1 inline-flex h-4 w-4 flex-shrink-0 rounded-full p-1 text-gray-400 hover:bg-gray-200 hover:text-gray-500">
                                                <span class="sr-only">Remove filter for Objects</span>
                                                <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                                    <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>

        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-100 block">
                                <tr class="table w-full table-fixed">
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Catégorie
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Marque
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Modèle
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Numéro de série
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[8%]">
                                        Position
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[8%]">
                                        Prix Total
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-1/6">
                                        Commentaire
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white block max-h-[54vh] overflow-y-scroll">
                                @forelse ($products as $product)
                                    <div wire:key="Common-product-{{ $product->id }}">
                                        <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $product->getCategory()->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $product->getBrand()->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $product->getModel() }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $product->serial_number }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-[8%]">
                                                {{ $product->rack->name }} <br>
                                                Étage {{ $product->rack_level }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-[8%]">
                                                {{ number_format($product->price, 2, ',', ' ') }}€
                                            </td>
                                            <td class="whitespace-wrap px-3 py-4 text-sm text-gray-500 w-1/6">
                                                {{ $product->comment }}
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6 w-1/6">
                                                <div class="inline-block px-6">
                                                    @livewire('forms.product.product-edit-form', ['product' => $product], key('product-edit-form-'. $product->id))
                                                </div>
                                                <div class="inline-block px-6">
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
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[8%]">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[8%]">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-1/6">
                                                    <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                </td>
                                                <td scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/6">
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
