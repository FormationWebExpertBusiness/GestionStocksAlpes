<div>
    <div>
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Détail produit : </h2>
        </div>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Catégorie</dt>
                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{$commonItem->category->name}}</dd>
            </div>

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Marque</dt>
                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{$commonItem->brand->name}}</dd>
            </div>

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Modèle</dt>
                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{$commonItem->model}}</dd>
            </div>


            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">
                    Prix Total
                </dt>
                <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ number_format($commonItem->totalPrice, 2, ',', ' '); }} €</dd>
            </div>
            @if($commonItem->quantity > 1)
                <div class="break-all inline rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                    <dt class="truncate text-sm font-medium text-gray-500">Prix Moyen Unitaire
                        @if($commonItem->unit != null)
                        (par {{ $commonItem->unit }})
                        @endif
                    </dt>
                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ number_format($commonItem->totalPrice / $commonItem->quantity, 2, ',', ' '); }} €</dd>
                </div>
            @endif
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Quantité</dt>
                <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ $commonItem->quantity }} {{ $commonItem->unit }}</dd>
            </div>

            {{-- <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Étagère</dt>
                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{$item->rack_id}}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Niveau sur l'étagère</dt>
                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{$item->rack_level}}</dd>
            </div> --}}
        </dl>
    </div>
    {{-- @if ($item->comment != null)
        <br>
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6 ">
            <dt class="truncate text-sm font-medium text-gray-500">Commentaire</dt>
            <dd class="mt-1 text-xl font-medium tracking-tight text-gray-900">{{$item->comment}}</dd>
        </div>
    @endif --}}

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-100 block">
                            <tr class="table w-full table-fixed">
                                <th wire:click="reOrder('category')" scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Entrée en stock
                                </th>
                                <th wire:click="reOrder('brand')" scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Numéro de série
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
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Commentaire
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white block max-h-[40vh] overflow-y-scroll">
                            @forelse ($commonItem->items as $item)
                                <div wire:key="Item-{{ $commonItem->id }}-{{ $item->id }}">
                                    <tr
                                        class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $item->created_at->format('d/m/y') }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $item->serial_number }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ number_format($item->price, 2, ',', ' ') }} €</td>
                                        <td class="whitespace-nowrap py-4 pl-4 text-sm text-gray-500">
                                            <p>{{ $item->rack->name }}</p>
                                            <p>étage {{ $item->rack_level }}</p>
                                        </td>
                                        <td class="whitespace-normal px-3 py-4 text-sm text-gray-500">
                                            {{ $item->comment }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6 w-1/6">
                                            {{-- <div class="inline-block px-6">
                                                @livewire('forms.item.quantity-update-form', ['CommonItemToUpdate' => $commonItem], key('quantity-update-form-' . $commonItem->id))
                                            </div> --}}
                                            <div class="inline-block px-6">
                                                <button wire:click="openWarningDelete({{ $item->id }})"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </div>
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
