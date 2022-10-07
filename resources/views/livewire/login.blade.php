<div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-5xl sm:p-6">

                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                Connexion
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                La connexion est requise pour accéder à la gestion des stocks.
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form class="w-full">
                            <div class="shadow-md sm:overflow-hidden sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                                    {{-- username text field --}}
                                    <div>
                                        <div class="flex justify-between">
                                            <label for="username" class="block text-sm font-medium text-gray-700">Utilisateur</label>
                                        </div>
                                        <div class="mt-1">
                                            <input type="text" name="username" id="username" wire:model="username" placeholder="Utilisateur" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @error('username') <span class="error text-red-600">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    {{-- password password field --}}
                                    <div>
                                        <div class="flex justify-between">
                                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                                        </div>
                                        <div class="mt-1">
                                            <input type="text" name="password" id="password" wire:model="password" placeholder="Mot de passe" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @error('password') <span class="error text-red-600">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <button wire:click="connectUser" type="button"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Enregistrer
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
