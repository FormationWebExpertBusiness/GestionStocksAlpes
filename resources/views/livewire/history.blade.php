<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mt-10">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        Historique</h2>
                </div>
                <p class="mt-2 text-sm text-gray-700">Liste des déplacements du stock</p>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-100 block">
                                <tr class="table w-full table-fixed">
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-20">
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-36">
                                        Action
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Catégorie
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Marque
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Modèle
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Numéro de série
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-32">
                                        Prix
                                    </th>
                                    <th scope="col" 
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-1/4">
                                        Commentaire
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white block max-h-[77vh] overflow-y-scroll">
                                @forelse ($historyItems as $historyItem)
                                    <div wire:key="History-item-{{ $historyItem->id }}">
                                        <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-20">
                                                {{ $historyItem->created_at->format('d/m/y') }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-36">
                                                @if ($historyItem->code_action === 'C')
                                                    <span class="bg-green-300 text-green-600 p-1 rounded-md">
                                                        Entrée en stock
                                                    </span> 
                                                @elseif ($historyItem->code_action === 'D')
                                                    <span class="bg-red-300 text-red-600 p-1 rounded-md">
                                                        Sortie du stock
                                                    </span>
                                                @else
                                                    <span class="bg-gray-300 text-gray-600 p-1 rounded-md">
                                                        Inconnue
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $historyItem->category }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $historyItem->brand }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $historyItem->model }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $historyItem->serial_number }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-32">
                                                {{ number_format($historyItem->price, 2, ',', ' '); }} €</td>
                                            <td class="whitespace-wrap px-3 py-4 text-sm text-gray-500 w-1/4">
                                                {{ $historyItem->comment }}
                                            </td>
                                        </tr>
                                    </div>
                                @empty
                                    <tr class="bg-white divide-x divide-gray-200 table w-full table-fixed">
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                          
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit</h3>
                                        <p class="mt-1 text-sm text-gray-500">Vous pouvez en ajouter un nouveau</p>
                                        <div class="mt-3">
                                            @livewire('forms.common-item.common-item-form')
                                        </div>
                                      </div>
                                    </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
