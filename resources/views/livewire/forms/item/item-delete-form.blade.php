<div>
    <button wire:click="toggleDeleteForm" class="text-indigo-600 group flex items-center py-2 text-sm" role="menuitem"
        tabindex="-1" id="menu-item-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>                           
    </button>
    @if ($show)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto w-full">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative ml-[50%] -translate-x-1/4 max-w-7xl lg:grid lg:grid-cols-7">
                        <div class="bg-gray-50 rounded-l-lg py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                                <button wire:click="toggleDeleteForm" type="button"
                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Retirer des produits
                            </h2>
                            <p class="mt-3 text-md leading-6 text-gray-500">
                                Retirer des produits du stock
                            </p>
                        </div>
                        <div class="bg-white rounded-r-lg py-16 px-4 sm:px-6 lg:col-span-5 lg:py-24 lg:px-8 xl:pl-12">
                            <form wire:submit.prevent='deleteItem'>
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-100 block">
                                            <tr class="table w-full table-fixed">
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Supprimer
                                                </th>
                                                <th wire:click="reOrder('category')" scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Entrée en stock
                                                </th>
                                                <th wire:click="reOrder('model')" scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Prix
                                                </th>
                                                <th wire:click="reOrder('quantity')" scope="col"
                                                    class="py-3.5 pl-4 text-left text-sm font-semibold text-gray-900">
                                                    Emplacement
                                                </th>
                                                <th wire:click="reOrder('price')" scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-1/3">
                                                    Commentaire
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white block max-h-[40vh] overflow-y-scroll">

                                            @forelse ($items as $item)
                                                <div wire:key="Item-{{ $commonItem->id }}-{{ $item->id }}">
                                                    <tr
                                                        class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                                        <td class="whitespace-nowrap py-4 pl-4 text-sm text-gray-500 text-left">
                                                            <input wire:model="itemsToDelete" type="checkbox" id="item-{{$item->id}}" name="item-{{$item->id}}" value="{{ $item->id }}">
                                                            <label for="item-{{$item->id}}">{{ $item->serial_number }}</label>
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ $item->created_at->format('d/m/y') }}</td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ number_format($item->price, 2, ',', ' ') }} €</td>
                                                        <td class="whitespace-nowrap py-4 pl-4 text-sm text-gray-500">
                                                            <p>{{ $item->rack->name }}</p>
                                                            <p>étage {{ $item->rack_level }}</p>
                                                        </td>
                                                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500 w-1/3">
                                                            {{ $item->comment }}</td>
                                                    </tr>
                                                </div>
                                            @empty
                                                <tr class="bg-white divide-x divide-gray-200 table w-full table-fixed">
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <div class="text-center">
                                                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit</h3>
                                                            <p class="mt-1 text-sm text-gray-500"> Il n'y a aucun item en stock </p> 
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @error('itemsToDelete')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror

                                <div class="absolute bottom-5 right-2 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex mr-3 w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                        Supprimer
                                    </button>
                                    <button wire:click="toggleDeleteForm" type="button"
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
