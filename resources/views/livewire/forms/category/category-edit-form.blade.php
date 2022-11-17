<div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Modifier</h3>
                    <p class="mt-1 text-sm text-gray-600">Modifier une catégorie existante.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form wire:submit.prevent='updateCategory'>
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">

                            {{-- category dropdown --}}
                            <div>
                                <div class="text-left">
                                    <label for="location" class="block text-sm font-medium text-gray-700">Catégorie à modifier : </label>
                                </div>
                                @if ($errors->has('selectedCategory'))
                                    <div class="relative">
                                        <select wire:model="selectedCategory" id="selectedCategory" name="selectedCategory" class="mt-1 block text-red-900 placeholder-red-300 w-full rounded-md border-red-300 py-3 pl-3 pr-10 text-base focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm">
                                            @foreach ($categories as $option)
                                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>

                                    @error('selectedCategory')
                                        <p class="mt-2 h-4 text-sm text-red-600" id="selectedCategory">{{ $message }}
                                        </p>
                                    @enderror
                                @else
                                    <select wire:model="selectedCategory" id="selectedCategory" name="selectedCategory" class="mt-1 block w-full rounded-md border-gray-300 py-3 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        @foreach ($categories as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-2 h-4"></p>
                                @endif
                            </div>

                            {{-- name text field --}}
                            <div>
                                <div class="text-left">
                                    <label for="full-name" class="text-sm font-medium text-gray-700">Nouveau nom de la
                                        catégorie :
                                    </label>
                                </div>
                                <div class="mt-1">
                                    @if ($errors->has('newName'))
                                        <div class="relative">
                                            <input wire:model="newName" type="text" name="full-name" id="full-name" autocomplete="newName" placeholder="Ex: Firewall" class="block w-full py-3 px-4 rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500" aria-invalid="true" aria-describedby="email-error">
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>

                                        @error('newName')
                                            <p class="mt-2 h-4 text-sm text-red-600" id="newName">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input wire:model="newName" type="text" name="full-name" id="full-name" autocomplete="newName" class="block w-full rounded-md border-gray-300 py-3 px-4 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ex: Firewall">
                                        <p class="mt-2 text-sm h-4 text-red-600" id="email-error" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Modifier
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
