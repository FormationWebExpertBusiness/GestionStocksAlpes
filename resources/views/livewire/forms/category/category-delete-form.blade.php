<div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Supprimer</h3>
                    <p class="mt-1 text-sm text-gray-600">Supprimer une catégorie existante.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form wire:submit.prevent='openWarningDelete'>
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                            {{-- category dropdown --}}
                            <div>
                                <div class="text-left">
                                    <label for="location" class="block text-sm font-medium text-gray-700">Catégorie à supprimer : </label>
                                </div>
                                <div class="mt-1">
                                    @if ($errors->has('selectedCategory'))
                                        <div class="relative">
                                            <select wire:model="selectedCategory" id="location" name="location" class="mt-1 block text-red-900 placeholder-red-300 w-full rounded-md border-red-300 py-3 pl-3 pr-10 text-base focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm">
                                                @foreach ($categories as $categorie)
                                                    <option value="{{ $categorie->name }}">{{ $categorie->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>

                                        @error('selectedCategory')
                                            <p class="mt-2 h-4 text-sm text-red-600" id="email-error">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <select wire:model="selectedCategory" id="location" name="location" class="mt-1 block w-full rounded-md border-gray-300 py-3 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->name }}">{{ $categorie->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="mt-2 h-4" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="inline-flex mr-3 w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
