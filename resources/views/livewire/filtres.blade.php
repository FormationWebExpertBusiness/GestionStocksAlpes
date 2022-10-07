<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:divide-y lg:divide-gray-200 lg:px-8">
            <div class="relative flex h-16 justify-between">
                <div class="relative z-0 flex flex-1 items-center justify-center px-2 sm:absolute sm:inset-0">
                    <div class="w-full sm:max-w-xs inline-flex">
                        <label for="search" class="sr-only">Recherche</label>
                        <div class="relative inline-flex">
                            <input id="search" name="search"
                                class="w-full rounded-md border border-gray-300 bg-white py-2 pl-2.5 pr-3 text-sm placeholder-gray-500 focus:border-indigo-500 focus:text-gray-900 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Recherche" type="search" wire:model="search">
                            <div wire:click="resetSearchBar"
                                class="absolute right-1 top-1.5 hover:bg-red-200 p-0.5 rounded-full  text-red-600 inline-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                        <button wire:click="getSearchInput" type="button"
                            class="ml-5 inline-flex items-center rounded-full border w-10 border-transparent bg-indigo-600 px-2.5 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="hidden min-w-[100%] h-20 content-center justify-items-center justify-center lg:flex lg:py-2"
                aria-label="Global">
                <div class="mx-8 inline-block text-left max-w-[20%]">
                    <div class="rounded-md bg-white">
                        <div class="flex">
                            <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">
                                Prix: 
                            </span>
                            <div class="w-1/2 min-w-0 flex-1">
                                <label for="card-expiration-date" class="sr-only">Prix minimal</label>
                                <input wire:model="priceMin" type="text" name="card-expiration-date" id="card-expiration-date"
                                class="relative block w-full rounded-none border-gray-300 bg-transparent focus:z-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Min">
                            </div>
                            <div class="min-w-0 flex-1">
                                <label for="card-cvc" class="sr-only">Prix maximal</label>
                                <input wire:model="priceMax" type="text" name="card-cvc" id="card-cvc"
                                class="relative block w-full rounded-r-md border-gray-300 bg-transparent focus:z-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Max">
                            </div>
                        </div>
                        <div class="h-6">
                            @error('priceMin')
                                <p class="mt-2 whitespace-nowrap text-sm text-red-600" id="email-error">{{ $message }}</p>
                            @enderror
                            @error('priceMax')
                                <p class="mt-2 whitespace-nowrap text-sm text-red-600" id="email-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mx-8 inline-block text-left max-w-[20%]">
                    <div class="rounded-md bg-white">
                        <div class="flex">
                            <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">
                                Quantité: 
                            </span>
                            <div class="w-1/2 min-w-0 flex-1">
                                <label for="card-expiration-date" class="sr-only">Quantité minimal</label>
                                <input wire:model="quantityMin" type="text" name="card-expiration-date" id="card-expiration-date"
                                class="relative block w-full  rounded-none border-gray-300 bg-transparent focus:z-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Min">
                            </div>
                            <div class="min-w-0 flex-1">
                                <label for="card-cvc" class="sr-only">Quantité maximal</label>
                                <input wire:model="quantityMax" type="text" name="card-cvc" id="card-cvc"
                                class="relative block w-full rounded-r-md border-gray-300 bg-transparent focus:z-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Max">
                            </div>
                        </div>
                        <div class="h-6">
                            @error('quantityMin')
                                <p class="mt-2 text-sm whitespace-nowrap text-red-600" id="email-error">{{ $message }}</p>
                            @enderror
                            @error('quantityMax')
                                <p class="mt-2 text-sm whitespace-nowrap text-red-600" id="email-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="relative mx-8 inline-block text-left">
                    <div>
                        <button wire:click="toggleCatDropdown" type="button"
                            class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                            Catégories
                            @if (!$isVisibleCat)
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </button>
                    </div>
                    @if ($isVisibleCat)
                        <div class="absolute transform -translate-x-[25%] p-4 z-10 mt-2 w-56 origin-top divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div name="categories" class="py-1 content-center" role="none">
                                @foreach ($categories as $category)
                                    <div class="flex items-center" wire:click='appendCat({{ $category->id }})'>
                                        {{-- value="{{"cat".$category->id}}" --}}
                                        @if (in_array($category->id, $catsFilter))
                                            <input id="{{ 'cat' . $category->id }}" name="{{ 'cat' . $category->id }}"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                checked>
                                        @else
                                            <input id="{{ 'cat' . $category->id }}" name="{{ 'cat' . $category->id }}"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        @endif
                                        <label wire:click='appendCat({{ $category->id }})'
                                            for="{{ 'cat' . $category->id }}"
                                            class="ml-3 text-sm text-gray-500">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="relative mx-8 inline-block text-left">
                    <div>
                        <button wire:click="toggleBrandDropdown" type="button"
                            class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                            Marques
                            @if (!$isVisibleBrand)
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </button>
                    </div>
                    @if ($isVisibleBrand)
                        <div class="absolute transform -translate-x-[25%] p-4 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div name="brands" class="py-1" role="none">
                                {{-- <select id="categories" name="categories" onchange="this.form.submit()"></select> --}}
                                @foreach ($brands as $brand)
                                    <div class="flex items-center" wire:click='appendBrand({{ $brand->id }})'>
                                        @if (in_array($brand->id, $brandsFilter))
                                            <input id="{{ 'brand' . $brand->id }}" name="{{ 'brand' . $brand->id }}"
                                                value="{{ 'brand' . $brand->id }}" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                checked>
                                        @else
                                            <input id="{{ 'brand' . $brand->id }}" name="{{ 'brand' . $brand->id }}"
                                                value="{{ 'brand' . $brand->id }}" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        @endif
                                        <label wire:click='appendBrand({{ $brand->id }})'
                                            for="{{ 'brand' . $brand->id }}"
                                            class="ml-3 text-sm text-gray-500">{{ $brand->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="relative mx-8 inline-block text-left">
                    <button wire:click="resetFilters" type="button"
                        class="inline-flex w-full whitespace-nowrap justify-center rounded-md border bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        id="menu-button" aria-expanded="true" aria-haspopup="true">
                        Supprimer les filtres
                    </button>
                </div>
            </nav>
        </div>
    </header>
    <br>
    <br>
</div>
