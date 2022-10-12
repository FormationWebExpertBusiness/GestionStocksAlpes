<div>
    <a wire:click="toggleEditForm" class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem"
        tabindex="-1" id="menu-item-0">
        <svg class="mr-3 h-5 w-5 text-indigo-600 group-hover:text-indigo-900" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path
                d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
            <path
                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
        </svg>
        Modifier
    </a>
    @if ($show)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative mx-auto content-center ml-[30%] max-w-5xl lg:grid lg:grid-cols-5">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Modifiez une
                                catégorie
                            </h2>
                            <p class="mt-3 text-md leading-6 text-gray-500">
                                Sélectionnez une catégorie pour la modifier
                            </p>
                        </div>
                        <div class="bg-white rounded-r-lg py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12">
                            <div>
                                <div class="text-left">
                                    <label for="full-name" class="text-sm font-medium text-gray-700">Nom de la
                                        catégorie :
                                    </label>
                                </div>
                                <div class="mt-1">
                                    <input type="text" name="full-name" id="full-name" autocomplete="name"
                                        class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Ex: Firewall">
                                </div>
                                @error('name')
                                    <p class="mt-2 whitespace-nowrap text-sm text-red-600" id="email-error">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="absolute bottom-5 right-2 text-right sm:px-6">
                                <button type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Enregistrer
                                </button>
                                <button wire:click="toggleEditForm" type="button"
                                    class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
