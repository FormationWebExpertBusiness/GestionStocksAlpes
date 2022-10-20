<div>
    <a wire:click="toggleAddForm" class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem"
        tabindex="-1" id="menu-item-1">
        <svg class="mr-3 h-5 w-5 text-indigo-600 group-hover:text-indigo-900" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd"
                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z"
                clip-rule="evenodd" />
        </svg>
        Ajouter
    </a>
    @if ($show)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative mx-auto content-center ml-[30%] max-w-5xl lg:grid lg:grid-cols-5" @click.outside="$wire.show = false">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Ajoutez une
                                Étagère
                            </h2>
                            <p class="mt-3 text-md leading-6 text-gray-500">
                                Les étagères permettent de savoir où sont rangé les objets dans le stock.
                            </p>
                        </div>
                        <div class="bg-white rounded-r-lg py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12">
                            <div>
                                <div class="text-left">
                                    <label for="nb_level" class="text-sm font-medium text-gray-700">
                                        Nombre d'étage sur l'étagère:
                                    </label>
                                </div>
                                <div class="mt-1">
                                    <input wire:model="nb_level" type="number" name="nb_level" id="nb_level"
                                        autocomplete="nb_level"
                                        class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Ex: 4">
                                </div>
                                @error('nb_level')
                                    <p class="mt-2 whitespace-nowrap text-sm text-red-600" id="email-error">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="absolute bottom-5 right-2 text-right sm:px-6">
                                <button wire:click="saveRack" type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Enregistrer
                                </button>
                                <button wire:click="toggleAddForm" type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
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
