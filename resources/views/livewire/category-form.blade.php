<div>
    @if ($show)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative mx-auto content-center ml-[30%] max-w-5xl lg:grid lg:grid-cols-5">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Ajoutez une catégorie
                            </h2>
                            <p class="mt-3 text-md leading-6 text-gray-500">
                                Les catégories permettent de regrouper les items pour les trier et les filtrer
                            </p>
                        </div>
                        <div class="bg-white rounded-r-lg py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12">
                            <div>
                                <label for="full-name" class="text-sm font-medium text-gray-700">Nom de la
                                    catégorie
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="full-name" id="full-name" autocomplete="name"
                                        class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Ex: Firewall">
                                </div>
                            </div>
                            <div class="absolute bottom-5 right-2 text-right sm:px-6">
                                <button wire:click="saveItem" type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Enregistrer
                                </button>
                                <button wire:click="toggleForm" type="button"
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
    <button
        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
        wire:click="toggleForm">
        Ajouter une catégorie
    </button>
</div>
