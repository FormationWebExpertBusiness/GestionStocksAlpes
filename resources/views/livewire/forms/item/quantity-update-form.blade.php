<div class="inline-block w-1/5 text-right">
    {{-- modal qui s'ouvre pour ajouter un produit  --}}
    @if ($isFormOpen)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto mt-[10%]">
                    <div class="flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative min-h-fit mx-auto content-center ml-[30%] min-w-fit lg:grid lg:grid-cols-5">
                            <div
                                class="bg-gray-50 rounded-tl-lg py-16 px-4 col-span-2">
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"> Ajouter du
                                    stock
                                </h2>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Ajouter des {{ $itemToUpdate->model }} de {{ $itemToUpdate->brand->name }} au stock
                                    existant
                                </p>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Quantité en Stock : {{ $itemToUpdate->quantity }} {{ $itemToUpdate->unit ?? '' }}
                                </p>
                            </div>
                            <div class="border-b-1 border-gray-200">
                                <form wire:submit.prevent="increaseItem">
                                    <div class="shadow">
                                        <div class="space-y-6 pb-2 rounded-tr-md bg-white px-4 py-5 sm:p-6">

                                            {{-- quantityIncrease number field --}}
                                            <div>
                                                <div class="flex justify-between">
                                                    <label for="quantity"
                                                        class="block text-lg font-medium text-gray-700">Quantité</label>
                                                </div>
                                                <div class="mt-1">
                                                    <input type="number" name="quantity" id="quantity"
                                                        wire:model="quantityIncrease" placeholder="Ex: 2"
                                                        class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    @error('quantityIncrease')
                                                        <span class="error text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- priceIncrease text field --}}
                                            <div>
                                                <div class="flex justify-between">
                                                    <label for="price"
                                                        class="block text-lg font-medium text-gray-700">Prix
                                                        total</label>
                                                </div>
                                                <div class="mt-1">
                                                    <input type="number" name="price" id="price"
                                                        wire:model="priceIncrease" placeholder="Ex: 195"
                                                        class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    @error('priceIncrease')
                                                        <span class="error text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="bg-gray-100 px-4 py-3 text-right sm:px-6">
                                            <button type="submit"
                                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Enregistrer
                                            </button>
                                            <button wire:click="closeForm" type="button"
                                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                                                Annuler
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- retirer du stock --}}
                    <div class="flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative min-h-fit mx-auto content-center ml-[30%] min-w-fit lg:grid lg:grid-cols-5">
                            <div
                                class="bg-gray-50 border-t-2 border-gray-200  rounded-bl-lg py-16 px-4 col-span-2">
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"> Retirer du stock
                                </h2>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Retirer des {{ $itemToUpdate->model }} de {{ $itemToUpdate->brand->name }} au
                                        stock existant
                                </p>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Quantité en Stock : {{ $itemToUpdate->quantity }}
                                    {{ $itemToUpdate->unit ?? '' }}
                                </p>
                            </div>
                            <div>
                                <form wire:submit.prevent="decreaseItem">
                                    <div class="shadow">
                                        <div class="space-y-6 border-t-2 border-gray-200 bg-white px-4 py-5 sm:p-6">

                                            {{-- quantityDecrease number field --}}
                                            <div>
                                                <div class="flex justify-between">
                                                    <label for="quantity"
                                                        class="block text-lg font-medium text-gray-700">Quantité</label>
                                                </div>
                                                <div class="mt-1">
                                                    <input type="number" name="quantity" id="quantity"
                                                        wire:model="quantityDecrease" placeholder="Ex: 5"
                                                        class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    @error('quantityDecrease')
                                                        <span class="error text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="bg-gray-100 px-4 py-3 rounded-br-md text-right sm:px-6">
                                            <button type="submit"
                                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Enregistrer
                                            </button>
                                            <button wire:click="closeForm" type="button"
                                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
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
</div>
</div>
@endif
{{-- bouton pour afficher le formulaire --}}
<button class="text-indigo-600 hover:text-indigo-900 text-right" wire:click.prevent="$toggle('isFormOpen')">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
    </svg>
</button>
</div>
