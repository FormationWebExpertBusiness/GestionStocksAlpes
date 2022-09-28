<div>
    @if ($isCreatingNewItem)
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!--
            Background backdrop, show/hide based on modal state.
        
            Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
            Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-5xl sm:p-6">
                        <form method="POST" action="/addItem">


                            <div>
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                  <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                      <h3 class="text-lg font-medium leading-6 text-gray-900">Ajouter un produit</h3>
                                      <p class="mt-1 text-sm text-gray-600">formulaire pour créer un nouveau produit qui n'a jamais été dans le stock</p>
                                    </div>
                                  </div>
                                  <div class="mt-5 md:col-span-2 md:mt-0">
                                    <form action="#" method="POST">
                                      <div class="shadow sm:overflow-hidden sm:rounded-md">
                                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                                            {{-- voir pour simmplifier les composant en .blade (pas livewire) --}}

                                            <div class="flex justify-between">
                                                <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                                                <span class="text-sm text-gray-500">Optionnel</span>
                                            </div>
                                            <select id="category" name="category" wire:model="category" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="">-</option>
                                                @foreach($categories as $option)
                                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                @endforeach
                                            </select>

                                            <div class="flex justify-between">
                                                <label for="brand" class="block text-sm font-medium text-gray-700">Marque</label>
                                                {{-- <span class="text-sm text-gray-500">Optionnel</span> --}}
                                            </div>
                                            <select id="brand" name="brand" wire:model="brand" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="">-</option>
                                                @foreach($brands as $option)
                                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                @endforeach
                                            </select>
                                          
                                            {{-- <div class="flex justify-between">
                                                <label for="model" class="block text-sm font-medium text-gray-700">Modèle</label>
                                                <span class="text-sm text-gray-500">Optionnel</span>
                                            </div>
                                            <div class="mt-1">
                                                <input type="text" name="model" id="model" wire:model="model" placeholder="Modèle" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div> --}}

                                            {{-- @include('test-input', ['name' => 'model', 'label' => 'Modèle', 'type' => 'text', 'model' => 'model', 'placeholder' => 'Modèle']) --}}

                                            <test-input type='text' name='model' model='model' placeholder='Modèle'></test-input>

                                            <div class="flex justify-between">
                                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantité</label>
                                                {{-- <span class="text-sm text-gray-500">Optionnel</span> --}}
                                            </div>
                                            <div class="mt-1">
                                                <input type="text" name="quantity" id="quantity" wire:model="quantity" placeholder="Quantité" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="flex justify-between">
                                                <label for="unit" class="block text-sm font-medium text-gray-700">Unité</label>
                                                <span class="text-sm text-gray-500">Optionnel</span>
                                            </div>
                                            <div class="mt-1">
                                                <input type="text" name="unit" id="unit" wire:model="unit" placeholder="Unité" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>

                                            <div class="flex justify-between">
                                                <label for="price" class="block text-sm font-medium text-gray-700">Prix total</label>
                                                {{-- <span class="text-sm text-gray-500">Optionnel</span> --}}
                                            </div>
                                            <div class="mt-1">
                                                <input type="text" name="price" id="price" wire:model="price" placeholder="Prix total" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>

                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                          <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Enregistrer</button>
                                          <button wire:click="$toggle('isCreatingNewItem')" type="button" class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Annuler</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                            </div>


                            
                            {{-- ancienne version qui marche po --}}

                            {{-- @livewire('select-menu', ['name' => 'category', 'listOption' => $categories, 'isOptional' => true]) --}}

                            {{-- @livewire('select-menu', ['name' => 'brand', 'listOption' => $brands]) --}}

                            {{-- @livewire('input-text', ['name' => 'model', 'placeholder' => 'Modèle']) --}}

                            {{-- @livewire('input-text', ['type' => 'number', 'name' => 'quantite', 'placeholder' => 'Quantité en stock', 'class' => 'inline-block']) --}}
                            {{-- @livewire('input-text', ['name' => 'unit', 'placeholder' => 'Modèle', 'placeholder' => 'Unité', 'isOptional' => true, 'class' => 'inline-block']) --}}

                            {{-- @livewire('input-text', ['name' => 'price', 'placeholder' => 'prix total']) --}}

                            {{-- <button wire:click="saveItem" type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Enregistrer
                            </button> --}}

                            {{-- <button wire:click="$toggle('isCreatingNewItem')" type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                Annuler
                            </button> --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <button
        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
        wire:click.prevent="$toggle('isCreatingNewItem')">
        Ajouter un produit
    </button>
</div>
