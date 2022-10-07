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

                                                {{-- categories select field --}}
                                                <div>
                                                    <div class="flex justify-between">
                                                        <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                                                        <span class="text-sm text-gray-500">Optionnel</span>
                                                    </div>
                                                    <select id="category" name="category" wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                        @foreach($categories as $option)
                                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id') <span class="error text-red-600">{{ $message }}</span> @enderror
                                                </div>

                                                {{-- brands select field --}}
                                                <div>
                                                    <div class="flex justify-between">
                                                        <label for="brand" class="block text-sm font-medium text-gray-700">Marque</label>
                                                        <span class="text-sm text-gray-500">Optionnel</span>
                                                    </div>
                                                    <select id="brand" name="brand" wire:model="brand_id" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                        @foreach($brands as $option)
                                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id') <span class="error text-red-600">{{ $message }}</span> @enderror
                                                </div>

                                                {{-- model text field --}}
                                                <div>
                                                    <div class="flex justify-between">
                                                        <label for="model" class="block text-sm font-medium text-gray-700">Modèle</label>
                                                    </div>
                                                    <div class="mt-1">
                                                        <input type="text" name="model" id="model" wire:model="model" placeholder="Modèle" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                        @error('model') <span class="error text-red-600">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- quantity number field --}}
                                                <div class="inline-block">
                                                    <div class="flex justify-between">
                                                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantité</label>
                                                    </div>
                                                    <div class="mt-1">
                                                        <input type="number" name="quantity" id="quantity" wire:model="quantity" placeholder="Quantité" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                        @error('quantity') <span class="error text-red-600">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- unit text field --}}
                                                <div class="inline-block">
                                                    <div class="flex justify-between">
                                                        <label for="unit" class="block text-sm font-medium text-gray-700">Unité</label>
                                                        <span class="text-sm text-gray-500">Optionnel</span>
                                                    </div>
                                                    <div class="mt-1">
                                                        <input type="text" name="unit" id="unit" wire:model="unit" placeholder="Unité" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                        @error('unit') <span class="error text-red-600">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- price number field --}}
                                                <div>
                                                    <div class="flex justify-between">
                                                        <label for="price" class="block text-sm font-medium text-gray-700">Prix total</label>
                                                    </div>
                                                    <div class="mt-1">
                                                        <input type="number" name="price" id="price" wire:model="price" placeholder="Prix total" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                        @error('price') <span class="error text-red-600">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- comment textarea field --}}
                                                <div>
                                                    <div class="flex justify-between">
                                                        <label for="comment" class="block text-sm font-medium text-gray-700">Commentaire</label>
                                                        <span class="text-sm text-gray-500">Optionnel</span>
                                                    </div>
                                                    <div class="mt-1 flex rounded-md shadow">
                                                        <textarea name="comment" id="comment" wire:model="comment"
                                                            placeholder="Commentaire" rows="10"
                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                        </textarea>
                                                    </div>
                                                    @error('comment') <span class="error text-red-600">{{ $message }}</span> @enderror
                                                </div>

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
