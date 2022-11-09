<div>
    {{-- modal qui s'ouvre pour ajouter un type de produit  --}}
    @if ($isFormOpen)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div class="relative mx-auto content-center ml-[30%] max-w-5xl lg:grid lg:grid-cols-5">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                                <button wire:click="$toggle('isFormOpen')" type="button"
                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            @if (isset($commonItemToUpdate))
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                    Modifier un type de produit
                                </h2>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Formulaire pour modifier un type de produit qui existant
                                </p>
                            @else
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                    Ajouter un type de produit
                                </h2>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Formulaire pour créer un nouveau type de produit
                                </p>
                            @endif
                        </div>
                        <div class="bg-white flex-col justify-between rounded-r-lg sm:px-6 col-span-3 py-4 px-8">
                            <form wire:submit.prevent='saveCommonItem'>
                                
                                {{-- categories select field --}}
                                <div class=" mt-10">
                                    <div class="flex justify-between">
                                        <label for="category"
                                            class="block text-sm font-medium text-gray-700">Catégorie</label>
                                        <span class="text-sm text-gray-500">Optionnel</span>
                                    </div>
                                    <div class="mt-1">
                                        @if ($errors->has('category_id'))
                                            <div class="relative">
                                                <select wire:model="category_id" id="category_id" name="category_id"
                                                    class="mt-1 block text-red-900 placeholder-red-300 w-full rounded-md border-red-300 py-3 pl-3 pr-10 text-base focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm">
                                                    @foreach ($categories as $option)
                                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>

                                            @error('category_id')
                                                <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        @else
                                            <select wire:model="category_id" id="category_id" name="category_id"
                                                class="mt-1 block w-full rounded-md border-gray-300 py-3 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                @foreach ($categories as $option)
                                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="mt-2 h-4" />
                                        @endif
                                    </div>
                                </div>

                                {{-- brands select field --}}
                                <div class="">
                                    <div class="flex justify-between">
                                        <label for="brand" class="block text-sm font-medium text-gray-700">
                                            Marque
                                        </label>
                                        <span class="text-sm text-gray-500">Optionnel</span>
                                    </div>
                                    <div class="mt-1">
                                        @if ($errors->has('brand_id'))
                                            <div class="relative">
                                                <select wire:model="brand_id" id="brand_id" name="brand_id"
                                                    class="mt-1 block text-red-900 placeholder-red-300 w-full rounded-md border-red-300 py-3 pl-3 pr-10 text-base focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm">
                                                    @foreach ($brands as $option)
                                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>

                                            @error('brand_id')
                                                <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        @else
                                            <select wire:model="brand_id" id="brand_id" name="brand_id"
                                                class="mt-1 block w-full rounded-md border-gray-300 py-3 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                @foreach ($brands as $option)
                                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="mt-2 h-4" />
                                        @endif
                                    </div>
                                </div>

                                {{-- model text field --}}
                                <div class="">
                                    <div class="flex justify-between">
                                        <label for="model"
                                            class="block text-sm font-medium text-gray-700">Modèle</label>
                                    </div>
                                    <div class="mt-1">
                                        @if ($errors->has('model'))
                                            <div class="relative">
                                                <input wire:model="model" type="text" name="model" id="model"
                                                    autocomplete="model"
                                                    placeholder="Ex: AX6000"
                                                    class="block w-full py-3 px-4 rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500"
                                                    aria-invalid="true" aria-describedby="email-error">
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                    <svg class="h-5 w-5 text-red-500"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>

                                            @error('model')
                                                <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        @else
                                            <input wire:model="model" type="text" name="model" id="model"
                                                autocomplete="model"
                                                class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Ex: AX6000">
                                            <p class="mt-2 h-4" />
                                        @endif
                                    </div>
                                </div>

                                {{-- unit text field --}}
                                <div class="w-[48%]">
                                    <div class="flex justify-between">
                                        <label for="unit"
                                            class="block text-sm font-medium text-gray-700">Unité</label>
                                        <span class="text-sm text-gray-500">Optionnel</span>
                                    </div>
                                    <div class="mt-1">
                                        <input wire:model="unit" type="text" name="unit" id="unit"
                                            autocomplete="unit"
                                            class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="Ex: kg">
                                    </div>
                                </div>

                                {{-- quantities field --}}
                                <div class="flex justify-between mt-6">
                                    {{-- quantity warning number field --}}
                                    <div class="w-[48%] inline-block">
                                        <div class="flex justify-between">
                                            <label for="quantity_warning"
                                                class="block text-sm font-medium text-gray-700">Quantité nécéssaire</label>
                                            <span class="text-sm text-gray-500">Optionnel</span>
                                        </div>
                                        <div class="mt-1">
                                            <input wire:model="quantity_warning" type="number" name="quantity_warning" id="quantity_warning"
                                                autocomplete="quantity_warning"
                                                class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Ex: 5">
                                        </div>
                                    </div>
    
                                    {{-- quantity urgent number field --}}
                                    <div class="w-[50%] inline-block">
                                        <div class="flex justify-between">
                                            <label for="quantity_urgent"
                                                class="block text-sm font-medium text-gray-700">Quantité alert urgent</label>
                                            <span class="text-sm text-gray-500">Optionnel</span>
                                        </div>
                                        <div class="mt-1">
                                            <input wire:model="quantity_urgent" type="number" name="quantity_urgent" id="quantity_urgent"
                                                autocomplete="quantity_urgent"
                                                class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Ex: 2">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-20"></div>
                                {{-- buttons --}}
                                <div
                                    class="bg-gray-100 absolute rounded-br-md max-w-[60%] left-[40%] bottom-0 pr-4 py-4 w-full text-right">
                                    <button type="submit"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Enregistrer
                                    </button>
                                    <button wire:click="closeForm" type="button"
                                        class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- bouton pour afficher le formulaire --}}
    @if (isset($commonItemToUpdate))
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
            Ajouter un type de produit
        </button>
    @endif
</div>
