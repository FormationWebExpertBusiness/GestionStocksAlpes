<div>
    <div class="relative inline-block text-left">
        <div>
            <button type="button" wire:click="toggleDropdown"
                class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                id="menu-button" aria-expanded="true" aria-haspopup="true">
                Gestion Categories
                @if ($showDropdown)
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z"
                            clip-rule="evenodd" />
                    </svg>
                @else
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                @endif
            </button>
        </div>
        @if ($showDropdown)
            <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" @click.outside="$wire.showDropdown = false" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    @livewire('category-add-form')
                    @livewire('category-edit-form')
                    @livewire('category-delete-form')
                </div>
            </div>
        @endif
    </div>
</div>
