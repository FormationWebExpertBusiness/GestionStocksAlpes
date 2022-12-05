<div>
    {{-- modal qui s'ouvre pour ajouter un type de produit  --}}
    @if ($isFormOpen)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div class="relative mx-auto content-center ml-[24%] max-w-6xl lg:grid lg:grid-cols-5">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-10 lg:py-24 xl:px-12">
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
                            @if (isset($commonProductToUpdate))
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl text-center">
                                    Modifier un type de produit
                                </h2>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Formulaire pour modifier un type de produit qui existant
                                </p>
                            @else
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl text-center">
                                    Ajouter un type de produit
                                </h2>
                                <p class="mt-3 text-md leading-6 text-gray-500">
                                    Formulaire pour créer un nouveau type de produit
                                </p>
                            @endif
                            <div class="mt-4">
                                @if ($photo_product)
                                    {{-- TODO add remove button --}}
                                    <div class="max-h-40 max-w-full">
                                        @if (!is_string($photo_product))
                                            <img class="m-auto inline-block max-h-40 max-w-full rounded-md"
                                                src="{{ $photo_product->temporaryUrl() }}" alt="cover image">
                                        @else
                                            <img class="m-auto inline-block max-h-40 max-w-full rounded-md"
                                                src="{{ Storage::url($photo_product) }}" alt="cover image">
                                        @endif
                                    </div>
                                @endif
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div
                                        class="mt-4 flex max-w-lg justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload"
                                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Ajouter une photo</span>
                                                    <input wire:model="photo_product" id="file-upload" accept="image/*"
                                                        name="file" type="file" class="sr-only">
                                                </label>
                                                <p class="pl-1">ou le glisser / déposer</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                </div>
                                @error('photo_product')
                                    <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                        <div class="bg-white flex-col justify-between rounded-r-lg sm:px-6 col-span-3 py-4 px-8">
                            <form wire:submit.prevent='saveCommonProduct'>
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
                                                        <option value="{{ $option->id }}">{{ $option->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                        <div class="relative">
                                            <input wire:model="model" type="text" name="model"
                                                id="model" autocomplete="model" placeholder="Ex: AX6000"
                                                @if ($errors->has('model'))
                                                    class="block w-full py-3 px-4 rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500"
                                                @else
                                                    class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                @endif
                                                aria-invalid="true" aria-describedby="email-error">
                                            @error('model')
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                    <svg class="h-5 w-5 text-red-500"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @enderror
                                        </div>

                                        <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                            @error('model')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>

                                {{-- quantities field --}}
                                <div class="flex justify-between mt-6">
                                    {{-- quantity low number field --}}
                                    <div class="w-[48%] inline-block">
                                        <div class="flex justify-between">
                                            <label for="quantity_low"
                                                class="block text-sm font-medium text-gray-700">Quantité faible</label>
                                            <span class="text-sm text-gray-500">Optionnel</span>
                                        </div>
                                        <div class="mt-1">
                                            <div class="relative">
                                                <input wire:model="quantity_low" type="number" name="quantity_low" id="quantity_low"
                                                    autocomplete="quantity_low"
                                                    @if ($errors->has('quantity_low'))
                                                    class="block w-full py-3 px-4 rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500"
                                                    @else
                                                        class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                    @endif
                                                    placeholder="Ex: 5">
                                                
                                                @error('quantity_low')
                                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                        <svg class="h-5 w-5 text-red-500"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @enderror
                                            </div>
                                            <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                                @error('quantity_low')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
    
                                    {{-- quantity critical number field --}}
                                    <div class="w-[50%] inline-block">
                                        <div class="flex justify-between">
                                            <label for="quantity_critical"
                                                class="block text-sm font-medium text-gray-700">Quantité critique</label>
                                            <span class="text-sm text-gray-500">Optionnel</span>
                                        </div>
                                        <div class="mt-1">
                                            <div class="relative">
                                                <input wire:model="quantity_critical" type="number" name="quantity_critical" id="quantity_critical"
                                                    autocomplete="quantity_critical"
                                                    @if ($errors->has('quantity_critical'))
                                                    class="block w-full py-3 px-4 rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500"
                                                    @else
                                                        class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                    @endif
                                                    placeholder="Ex: 5">
                                                
                                                @error('quantity_critical')
                                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                        <svg class="h-5 w-5 text-red-500"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @enderror
                                            </div>
                                            <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                                @error('quantity_critical')
                                                    {{ $message }}
                                                @enderror
                                            </p>
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
                                    <a href="{{ route('stock') }}"
                                        class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                                        Annuler
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- bouton pour afficher le formulaire --}}
    @if (isset($commonProductToUpdate))
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
