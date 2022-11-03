<div>
    <button wire:click="toggleModal" class="text-indigo-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
        </svg>
    </button>
    @if ($show)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-5xl sm:p-6">
                        {{-- close button --}}
                        <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                            <button wire:click="toggleModal" type="button"
                                class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Close</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        {{--  CommonItem values --}}
                        <div>
                            <div class="min-w-0 flex-1">
                                <h2
                                    class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                                    Détail produit : </h2>
                            </div>
                            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                                @if ($commonItem->photo_item)
                                    <a href="{{ Storage::url($commonItem->photo_item) }}" target="_blank">
                                        <img class="inline-block h-24 w-80 rounded-md"
                                            src="{{ Storage::url($commonItem->photo_item) }}" alt="cover image">

                                    </a>
                                @else
                                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="mx-auto w-10 h-10 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                        </svg>

                                    </div>
                                @endif

                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">Catégorie</dt>
                                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                        {{ $commonItem->category->name }}</dd>
                                </div>

                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">Marque</dt>
                                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                        {{ $commonItem->brand->name }}</dd>
                                </div>

                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">Modèle</dt>
                                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                        {{ $commonItem->model }}</dd>
                                </div>


                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">
                                        Prix Total
                                    </dt>
                                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">
                                        {{ number_format($commonItem->TotalPriceOnRack($rack, $rack_level), 2, ',', ' ') }}
                                        €
                                        @if ($commonItem->QuantityOnRack($rack, $rack_level) > 1)
                                            <p class="flex items-baseline text-sm font-semibold text-green-600">
                                                <span class="px-24">
                                                    ({{ number_format($commonItem->TotalPriceOnRack($rack, $rack_level) / $commonItem->quantityOnRack($rack, $rack_level), 2, ',', ' ') }}
                                                    € /u) </span>

                                            </p>
                                        @endif
                                    </dd>
                                </div>
                                <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                    <dt class="truncate text-sm font-medium text-gray-500">Quantité</dt>
                                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">
                                        {{ $commonItem->QuantityOnRack($rack, $rack_level) }}
                                        {{ $commonItem->unit }}</dd>
                                </div>
                            </dl>
                        </div>
                        {{-- Items details --}}
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
                                                    <th scope="col"
                                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/6">
                                                        <span class="sr-only">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white block max-h-[40vh] overflow-y-scroll">
                                                @forelse ($commonItem->ItemsOnRack($rack, $rack_level) as $item)
                                                    <div wire:key="Item-{{ $commonItem->id }}-{{ $item->id }}">
                                                        <tr
                                                            class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                                            <td
                                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{ $item->created_at->format('d/m/y') }}</td>
                                                            <td
                                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{ $item->serial_number }}</td>
                                                            <td
                                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{ number_format($item->price, 2, ',', ' ') }} €</td>
                                                            <td
                                                                class="whitespace-nowrap py-4 pl-4 text-sm text-gray-500">
                                                                <p>{{ $item->rack->name }}</p>
                                                                <p>étage {{ $item->rack_level }}</p>
                                                            </td>
                                                            <td
                                                                class="whitespace-normal px-3 py-4 text-sm text-gray-500">
                                                                {{ $item->comment }}</td>
                                                            <td
                                                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6 w-1/6">
                                                                <div class="inline-block px-6">
                                                                    <button
                                                                        wire:click="openWarningDelete({{ $item->id }})"
                                                                        class="text-indigo-600 hover:text-indigo-900">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="w-6 h-6">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                @empty
                                                    <tr
                                                        class="bg-white divide-x divide-gray-200 table w-full table-fixed">
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            <div class="text-center">
                                                                <svg class="mx-auto h-12 w-12 text-gray-400"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                                    Aucun produit</h3>
                                                                <p class="mt-1 text-sm text-gray-500">Vous pouvez en
                                                                    ajouter un nouveau</p>
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
            </div>
        </div>
    @endif
</div>
