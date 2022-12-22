<div>
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
                                    <span>Modèle</span>
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
                                                    <label for="{{ 'commonProduct' . $commonProduct->id }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $commonProduct->model }}</label>
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
                                                    <label for="{{ 'cat' . $category->id }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $category->name }}</label>
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
                                @foreach ($this->getAllActiveFilters() as $key => $filters)
                                    @foreach ($filters as $filter)
                                        <span class="m-1 inline-flex items-center rounded-full border border-gray-200 bg-white py-1.5 pl-3 pr-2 text-sm font-medium text-gray-900 mb-2">
                                            <span class="whitespace-nowrap">{{ $filter['badge'] ?? dd($filters) }}</span>
                                            <button type="button" class="ml-1 inline-flex h-4 w-4 flex-shrink-0 rounded-full p-1 text-gray-400 hover:bg-gray-200 hover:text-gray-500"
                                                wire:click="removeFilter({{ $filter }}, '{{ $key }}')">
                                                <span class="sr-only">Remove filter for Objects</span>
                                                <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                                    <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
</div>
