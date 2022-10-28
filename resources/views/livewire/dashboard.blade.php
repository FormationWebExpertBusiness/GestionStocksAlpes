<div>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-3 lg:gap-8">
                <div class="space-y-2 sm:space-y-2">
                    <h2 class="text-3xl font-bold tracking-tight">Tableau de bord</h2>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900 mt-10">Stock de Alpes Networks</h3>

                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">
                    <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                        <dt>
                            <div class="absolute rounded-md bg-indigo-500 p-3">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                </svg>
                            </div>
                            <p class="ml-16 truncate text-sm font-medium text-gray-500">Stock total des produits
                            </p>
                        </dt>
                        <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ App\Models\CommonItem::TotalCommonItem() }} produits
                            </p>
                            <p class="ml-2 flex items-baseline text-sm font-semibold text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="h-5 w-5 flex-shrink-0 self-center text-red-500">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>

                                <span class="px-1">
                                    {{ App\Models\CommonItem::TotalOutStockItem() }} en rupture de stock


                                </span>
                            </p>
                            <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                                <div class="text-sm">
                                    <a href="/stock" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Voir
                                        tout<span class="sr-only"> Total du stock</span></a>
                                </div>
                            </div>
                        </dd>

                    </div>

                    <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                        <dt>
                            <div class="absolute rounded-md bg-indigo-500 p-3">
                                <!-- Heroicon name: outline/envelope-open -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 7.756a4.5 4.5 0 100 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                            </div>
                            <p class="ml-16 truncate text-sm font-medium text-gray-500">Le prix le plus élevé
                            </p>
                        </dt>
                        <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ App\Models\Item::MostExpensiveItem()->price }} €
                            </p>
                            <p class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <!-- Heroicon name: mini/arrow-up -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="h-5 w-5 flex-shrink-0 self-center text-green-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                                <span class="px-1">
                                    {{ App\Models\Item::MostExpensiveItem()->getModel() }}
                                </span>
                            </p>
                            <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                                <div class="text-sm">
                                    <p class="text-gray-50">View all</p>
                                    <span class="sr-only"> Avg. Open Rate stats</span>
                                </div>
                            </div>
                        </dd>
                    </div>

                    <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                        <dt>
                            <div class="absolute rounded-md bg-indigo-500 p-3">
                                <!-- Heroicon name: outline/cursor-arrow-rays -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                </svg>

                            </div>
                            <p class="ml-16 truncate text-sm font-medium text-gray-500">Valeur du stock</p>
                        </dt>
                        <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ App\Models\Item::all()->sum('price') }} €
                            </p>
                            <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                                <div class="text-sm">
                                    <p class="text-gray-50">View
                                        all</p><span class="sr-only"> Avg. Open Rate stats</span>
                                </div>
                            </div>
                        </dd>
                    </div>
                    <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                        <dt>
                            <div class="absolute rounded-md bg-indigo-500 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 text-yellow-400 min-w-full">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                        clip-rule="evenodd" />
                                </svg>

                            </div>
                        </dt>
                        <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                            <p class="my-2 text-2xl font-semibold text-gray-900">
                                {{ App\Models\CommonItem::TotalFavoriteItem() }} produits en favoris
                            </p>
                            <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                                <div class="text-sm">
                                    <p class="text-gray-50">View
                                        all</p><span class="sr-only"> Avg. Open Rate stats</span>
                                </div>
                            </div>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- Liste des produits en stock --}}
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mb-5">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Stocks</h1>
                <p class="mt-2 text-sm text-gray-700">La liste totale des derniers produits ajoutées de Alpes Network.
                </p>
            </div>
        </div>
        @include('dashboard-filters')
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr class="divide-x divide-gray-200">
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-6">
                                        Favoris
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Catégorie
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-6">
                                        Modéle</th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Prix
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Quantité
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-6">
                                        Status</th>

                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-6">
                                        Détails</th>

                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($commonItems as $commonItem)
                                    <tr class="divide-x divide-gray-200" wire:key='commonItem-{{ $commonItem->id }}'>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-[5%] text-center">
                                            @livewire('forms.common-item.common-item-toggle-favorite', ['commonItem' => $commonItem], key('common-item-favorite-' . $commonItem->id))
                                        </td>
                                        <td class="whitespace-nowrap text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $commonItem->category->name }}

                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                            {{ $commonItem->model }}
                                        </td>
                                        <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                            {{ $commonItem->totalPrice }}
                                        </td>
                                        <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                            {{ $commonItem->quantity }}
                                        </td>
                                        <td class="whitespace-nowrap pl-4">
                                            @if ($commonItem->quantity < 5)
                                                <span
                                                    class="items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">En
                                                    rupture de stock</span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">En
                                                    stock</span>
                                            @endif
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-center text-gray-500 sm:pr-6">
                                            @livewire('details.item.detail-modal', ['commonItem' => $commonItem], key('item-detail-' . $commonItem->id))
                                        </td>
                                    </tr>
                                @empty
                                    <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <!-- Heroicon name: mini/exclamation-triangle -->
                                                <svg class="h-5 w-5 text-yellow-400"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M8.485 3.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 3.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    Aucune donnée disponible,
                                                    <a href="#"
                                                        class="font-medium text-yellow-700 underline hover:text-yellow-600">Essayer
                                                        une autre recherche.</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
