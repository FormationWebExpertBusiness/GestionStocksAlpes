<div>
    {{-- modal qui s'ouvre pour ajouter un produit  --}}
    @if ($isFormOpen)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-5xl sm:p-6">
                        <div>
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                                            Ajouter un produit
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            formulaire pour créer un nouveau produit qui n'a jamais été dans le stock
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:col-span-2 md:mt-0">
                                    <form>
                                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                                                <x-select-field name='category' label='Catégorie' model='category_id'
                                                    isOptional='true' :options="$categories"></x-select-field>

                                                <x-select-field name='brand' label='Marque' model='brand_id'
                                                    :options="$brands"></x-select-field>

                                                <x-input-field type='text' name='model' label='Modèle'
                                                    model='model' placeholder='Modèle'></x-input-field>

                                                <x-input-field class='inline-block' type='number' name='quantity'
                                                    label='Quantité' model='quantity' placeholder='Quantité'>
                                                </x-input-field>

                                                <x-input-field class='inline-block' type='text' name='unit'
                                                    label='Unité' model='unit' placeholder='Unité' isOptional="true">
                                                </x-input-field>

                                                <x-input-field type='text' name='price' label='Prix total'
                                                    model='price' placeholder='Prix total'></x-input-field>

                                                <x-textarea-field name='comment' label='Commentaire'
                                                    model='comment' placeholder='Commentaire'></x-textarea-field>

                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                                <button wire:click="saveItem" type="button"
                                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                    Enregistrer
                                                </button>
                                                <button wire:click="closeForm" type="button"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                    Annuler
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- bouton pour afficher le formulaire --}}
    @if(isset($itemToUpdate))
        <button class="text-indigo-600 hover:text-indigo-900"
            wire:click.prevent="$toggle('isFormOpen')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
            </svg>
        </button>
    @else
        <button
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
            wire:click.prevent="$toggle('isFormOpen')">
            Ajouter un produit
        </button>
    @endif
</div>
