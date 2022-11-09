<div class="hidden lg:flex lg:min-w-0 lg:flex-1 lg:items-center lg:justify-between">
    <div class="min-w-0 flex-1">
        <div class="relative max-w-8xl text-gray-400 focus-within:text-gray-500">
            <label for="desktop-search" class="sr-only">Search all inboxes</label>
            <input id="desktop-search" type="search" wire:model="search" placeholder="Rechercher"
                class="block w-full border-gray-300 rounded-md pl-12 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 focus:ring-1 sm:text-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center justify-center pl-4">
                <!-- Heroicon name: mini/magnifying-glass -->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
    <div class="ml-10 flex flex-shrink-0 items-center space-x-10 pr-4">
        <nav aria-label="Global" class="flex space-x-10">
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
                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" @click.outside="$wire.isVisibleCat = false">
                        <div name="categories" class="py-1 content-center" role="none">
                            @foreach ($categories as $category)
                                <div class="flex items-center" wire:key='categoriesDropDown-{{ $category->id }}'>
                                    @if (in_array($category->id, $catsFilter))
                                        <input id="{{ 'cat' . $category->id }}" name="{{ 'cat' . $category->id }}"
                                            type="checkbox" wire:model='catsFilter' value="{{ $category->id }}"
                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                            checked>
                                    @else
                                        <input id="{{ 'cat' . $category->id }}" name="{{ 'cat' . $category->id }}"
                                            type="checkbox" wire:model='catsFilter' value="{{ $category->id }}"
                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    @endif
                                    <label for="{{ 'cat' . $category->id }}"
                                        class="ml-3 text-sm text-gray-500">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </nav>
        
    </div>
</div>
