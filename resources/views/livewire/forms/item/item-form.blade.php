<div>
    {{-- modal qui s'ouvre pour ajouter un produit  --}}
    @if ($isFormOpen)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div class="relative mx-auto content-center ml-[30%] max-w-5xl lg:grid lg:grid-cols-5">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                            @if (isset($itemToUpdate))
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                    Modifier un produit
                                </h2>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Formulaire pour modifier un produit qui existant
                                </p>
                            @else
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                    Ajouter un produit
                                </h2>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Formulaire pour créer un nouveau produit
                                </p>
                            @endif
                        </div>
                        <div class="bg-white flex-col justify-between rounded-r-lg sm:px-6 col-span-3 py-4 px-8">

                            <div class="mb-8 mt-10">
                                <div class="flex justify-between">
                                    <label for="category"
                                        class="block text-sm font-medium text-gray-700">Catégorie</label>
                                    <span class="text-sm text-gray-500">Optionnel</span>
                                </div>
                                <select id="category" name="category" wire:model="category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    @foreach ($categories as $option)
                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- brands select field --}}
                            <div class="mb-8">
                                <div class="flex justify-between">
                                    <label for="brand" class="block text-sm font-medium text-gray-700">Marque</label>
                                    <span class="text-sm text-gray-500">Optionnel</span>
                                </div>
                                <select id="brand" name="brand" wire:model="brand_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    @foreach ($brands as $option)
                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- model text field --}}
                            <div class="mb-8">
                                <div class="flex justify-between">
                                    <label for="model" class="block text-sm font-medium text-gray-700">Modèle</label>
                                </div>
                                <div class="mt-1">
                                    <input type="text" name="model" id="model" wire:model="model"
                                        placeholder="Modèle"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('model')
                                        <span class="error text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-full inline-flex justify-between py-4 mb-8">
                            {{-- quantity number field --}}
                            <div class="w-[48%]">
                                <div class="flex justify-between">
                                    <label for="quantity"
                                        class="block text-sm font-medium text-gray-700">Quantité</label>
                                </div>
                                <div class="mt-1">
                                    <input type="number" name="quantity" id="quantity" wire:model="quantity"
                                        placeholder="Quantité"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('quantity')
                                        <span class="error text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- unit text field --}}
                            <div class="w-[48%]">
                                <div class="flex justify-between">
                                    <label for="unit" class="block text-sm font-medium text-gray-700">Unité</label>
                                    <span class="text-sm text-gray-500">Optionnel</span>
                                </div>
                                <div class="mt-1">
                                    <input type="text" name="unit" id="unit" wire:model="unit"
                                        placeholder="Unité"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('unit')
                                        <span class="error text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            </div>

                            {{-- price number field --}}
                            <div class="mb-8">
                                <div class="flex justify-between">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Prix
                                        total</label>
                                </div>
                                <div class="mt-1">
                                    <input type="number" name="price" id="price" wire:model="price"
                                        placeholder="Prix total"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('price')
                                        <span class="error text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-full inline-flex justify-between py-4 mb-8">
                            {{-- rack select field --}}
                            <div class="w-[48%]">
                                <div class="flex justify-between">
                                    <label for="rack"
                                        class="block text-sm font-medium text-gray-700">Etagère</label>
                                </div>
                                <select id="rack" name="rack" wire:model="rack_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option value="">---</option>
                                    @foreach ($racks as $option)
                                        <option value="{{ $option->id }}">Etagère {{ $option->id }} -
                                            {{ $option->nb_level }} niveau(x)</option>
                                    @endforeach
                                </select>
                                @error('rack_id')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- rack_level select field --}}
                            <div class="w-[48%]">
                                <div class="flex justify-between">
                                    <label for="rack_level"
                                        class="block text-sm font-medium text-gray-700">Niveau</label>
                                </div>
                                @if ($this->rack_id)
                                    <select id="rack_level" name="rack_level" wire:model="rack_level"
                                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option value="">---</option>
                                        @for ($i = 1; $i <= $this->getSelectedRack()->nb_level; $i++)
                                            <option value="{{ $i }}">Niveau {{ $i }}</option>
                                        @endfor
                                    </select>
                                @else
                                    <select id="rack_level" name="rack_level" wire:model="rack_level"
                                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                        disabled>
                                        <option value="" selected>---</option>
                                    </select>
                                @endif
                                @error('rack_level')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                            {{-- comment textarea field --}}
                            <div class="mb-20">
                                <div class="flex justify-between">
                                    <label for="comment"
                                        class="block text-sm font-medium text-gray-700">Commentaire</label>
                                    <span class="text-sm text-gray-500">Optionnel</span>
                                </div>
                                <div class="mt-1 flex rounded-md shadow">
                                    <textarea name="comment" id="comment" wire:model="comment" placeholder="Commentaire" rows="8"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                        </textarea>
                                </div>
                                @error('comment')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="bg-gray-100 absolute rounded-br-md max-w-[60%] left-[40%] bottom-0 pr-4 py-4 w-full text-right">
                                <button wire:click="saveItem" type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Enregistrer
                                </button>
                                <button wire:click="closeForm" type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
@endif
{{-- bouton pour afficher le formulaire --}}
@if (isset($itemToUpdate))
    <button class="text-indigo-600 hover:text-indigo-900" wire:click.prevent="$toggle('isFormOpen')">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
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
