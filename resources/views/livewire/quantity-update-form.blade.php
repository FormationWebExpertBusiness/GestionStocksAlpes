<div class="inline-block w-1/5 text-right">
    {{-- modal qui s'ouvre pour ajouter un produit  --}}
    @if ($isFormOpen)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-5xl sm:p-6">
                        {{-- ajouter au stock --}}
                        <div>
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                                            Ajouter du stock
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600 whitespace-normal">
                                            Ajouter des {{ $itemToUpdate->model }} de {{ $itemToUpdate->brand->name }} au stock existant
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 whitespace-normal">
                                            Quantité en Stock : {{ $itemToUpdate->quantity }} {{ $itemToUpdate->unit ?? '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:col-span-2 md:mt-0">
                                    <form wire:submit.prevent="increaseItem">
                                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                                                <x-input-field type='number' name='quantity'
                                                    label='Quantité à ajouter' model='quantityIncrease' placeholder='Quantité'>
                                                </x-input-field>

                                                <x-input-field type='text' name='price' label='Prix total'
                                                    model='priceIncrease' placeholder='Prix total'></x-input-field>

                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                                <button type="submit"
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
                        {{-- retirer du stock --}}
                        <div class="mt-5">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                                            Retirer du stock
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600 whitespace-normal">
                                            Retirer des {{ $itemToUpdate->model }} de {{ $itemToUpdate->brand->name }} au stock existant
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 whitespace-normal">
                                            Quantité en Stock : {{ $itemToUpdate->quantity }} {{ $itemToUpdate->unit ?? '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:col-span-2 md:mt-0">
                                    <form wire:submit.prevent="decreaseItem">
                                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                                                <x-input-field type='number' name='quantity'
                                                    label='Quantité' model='quantityDecrease' placeholder='Quantité'>
                                                </x-input-field>

                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                                <button type="submit"
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
    <button class="text-indigo-600 hover:text-indigo-900 text-right"
        wire:click.prevent="$toggle('isFormOpen')">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
          </svg>          
    </button>
</div>
