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
</div>
