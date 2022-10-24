<div>
    <button wire:click="toggleAddForm" class="text-indigo-600 group flex items-center py-2 text-sm" role="menuitem"
        tabindex="-1" id="menu-item-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>                 
    </button>
    @if ($show)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative mx-auto content-center ml-[30%] max-w-5xl lg:grid lg:grid-cols-5">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                                <button wire:click="toggleAddForm" type="button"
                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Ajoutez un produit
                            </h2>
                            <p class="mt-3 text-md leading-6 text-gray-500">
                                Ajouter un item manuellement dans le stock
                            </p>
                        </div>
                        <div class="bg-white rounded-r-lg py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12">
                            <form wire:submit.prevent="saveItem" wire:key='add-item-{{ $common_id }}'>
                            
                                {{-- serial_number text field --}}
                                <div>
                                    <div class="text-left">
                                        <label for="full-name" class="text-sm font-medium text-gray-700">Numéro de série du produit :
                                        </label>
                                    </div>
                                    <div class="mt-1">
                                        @if ($errors->has('serial_number'))
                                        <div class="relative">
                                            <input wire:model="serial_number" type="text" name="serial_number" id="serial_number" autocomplete="serial_number" placeholder="Ex: U4uBbhCHz5h"
                                                class="block w-full py-3 px-4 rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500"
                                                aria-invalid="true" aria-describedby="email-error">
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                            @error('serial_number')
                                                <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input wire:model="serial_number" type="text" name="serial_number" id="serial_number"
                                                autocomplete="serial_number"
                                                class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Ex: U4uBbhCHz5h">
                                            <p class="mt-2 text-sm h-4 text-red-600" id="email-error" />
                                        @endif
                                    </div>

                                </div>

                                {{-- price number field --}}
                                <div class="">
                                    <div class="flex justify-between">
                                        <label for="price" class="block text-sm font-medium text-gray-700">Prix
                                            total</label>
                                    </div>
                                    <div class="mt-1">
                                        @if ($errors->has('price'))
                                            <div class="relative">
                                                <input wire:model="price" type="number" name="price" id="price"
                                                    autocomplete="price" placeholder="Ex: 250"
                                                    class="block w-full py-3 px-4 rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500"
                                                    aria-invalid="true" aria-describedby="email-error">
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

                                            @error('price')
                                                <p class="mt-2 h-4 text-sm text-red-600" id="email-error">{{ $message }}
                                                </p>
                                            @enderror
                                        @else
                                            <input wire:model="price" type="number" name="price" id="price"
                                                autocomplete="price"
                                                class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Ex: 250">
                                            <p class="mt-2 h-4" />
                                        @endif
                                    </div>
                                </div>

                                <div class="w-full inline-flex justify-between py-4 ">
                                    {{-- rack select field --}}
                                    <div class="w-[48%]">
                                        <div class="flex justify-between">
                                            <label for="rack"
                                                class="block text-sm font-medium text-gray-700">Etagère</label>
                                        </div>
                                        <div class="mt-1">
                                            @if ($errors->has('rack_id'))
                                                <div class="relative">
                                                    <select wire:model="rack_id" id="rack_id" name="rack_id"
                                                        class="mt-1 block text-red-900 placeholder-red-300 w-full rounded-md border-red-300 py-3 pl-3 pr-10 text-base focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm">
                                                        <option value="null" selected>---</option>
                                                        @foreach ($racks as $rack)
                                                            <option value="{{ $rack->id }}">Étagère
                                                                {{ $rack->id }}</option>
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

                                                @error('rack_id')
                                                    <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                                        {{ $message }}</p>
                                                @enderror
                                            @else
                                                <select wire:model="rack_id" id="rack_id" name="rack_id"
                                                    class="mt-1 block w-full rounded-md border-gray-300 py-3 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                    <option selected>---</option>
                                                    @foreach ($racks as $rack)
                                                        <option value="{{ $rack->id }}">Étagère {{ $rack->id }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="mt-2 h-4" />
                                            @endif
                                        </div>
                                    </div>

                                    {{-- rack_level select field --}}
                                    <div class="w-[48%]">
                                        <div class="flex justify-between">
                                            <label for="rack_level"
                                                class="block text-sm font-medium text-gray-700">Niveau</label>
                                        </div>
                                        <div class="mt-1">
                                            @if ($errors->has('rack_level'))
                                                <div class="relative">
                                                    @if ($this->rack_id)
                                                        <select wire:model="rack_level" id="rack_level" name="rack_level"
                                                            class="mt-1 block text-red-900 placeholder-red-300 w-full rounded-md border-red-300 py-3 pl-3 pr-10 text-base focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm">
                                                            <option value="">---</option>
                                                            @for ($i = 1; $i <= $this->getSelectedRack()?->nb_level; $i++)
                                                                <option value="{{ $i }}">Niveau
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    @else
                                                        <select wire:model="rack_level" id="rack_level" name="rack_level"
                                                            class="mt-1 block text-red-900 placeholder-red-300 w-full rounded-md border-red-300 py-3 pl-3 pr-10 text-base focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm"
                                                            disabled>
                                                            <option value="">---</option>
                                                        </select>
                                                    @endif
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

                                                @error('rack_level')
                                                    <p class="mt-2 h-4 text-sm text-red-600" id="email-error">
                                                        {{ $message }}</p>
                                                @enderror
                                            @else
                                                @if ($this->rack_id)
                                                    <select wire:model="rack_level" id="rack_level" name="rack_level"
                                                        class="mt-1 block w-full rounded-md border-gray-300 py-3 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                        <option value="">---</option>
                                                        @for ($i = 1; $i <= $this->getSelectedRack()?->nb_level; $i++)
                                                            <option value="{{ $i }}">Niveau
                                                                {{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <select wire:model="rack_level" id="rack_level" name="rack_level"
                                                        class="mt-1 block w-full rounded-md border-gray-300 py-3 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                                        disabled>
                                                        <option value="">---</option>
                                                    </select>
                                                @endif
                                                <p class="mt-2 h-4" />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- comment textarea field --}}
                                <div>
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

                                <div class="absolute bottom-5 right-2 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Enregistrer
                                    </button>
                                    <button wire:click="toggleAddForm" type="button"
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
</div>
