        <div>
            <div class="bg-white">
                <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
                    <div class="grid grid-cols-1 gap-12 lg:grid-cols-3 lg:gap-8">
                        <div class="space-y-2 sm:space-y-2">
                            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Tableau de bord</h2>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mt-10">Stock de Alpes Networks</h3>

                        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">
                            <div
                                class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
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
                                    <p class="text-2xl font-semibold text-gray-900">{{ App\Models\CommonItem::TotalCommonItem() }}</p>
                                    <p class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="h-5 w-5 flex-shrink-0 self-center text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                        </svg>
                                        <span class="px-2"> Quantité total : {{ App\Models\CommonItem::TotalQuantity() }}
                                        </span>

                                    </p>
                                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="/stock"
                                                class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Voir
                                                 tout<span class="sr-only"> Total du stock</span></a>
                                        </div>
                                    </div>
                                </dd>

                            </div>

                            <div
                                class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
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
                                        <a href="/stock?mod=asc&sea={{ App\Models\Item::MostExpensiveItem()->getModel()}}" class="text-green-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                            <span class=""> {{ App\Models\Item::MostExpensiveItem()->getModel() }} </span>
                                        </a>
                                    </p>
                                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a class="font-medium text-indigo-600 hover:text-indigo-500">
                                                <p class="text-gray-50">View
                                                    all</p><span class="sr-only"> Avg. Open Rate stats</span>
                                            </a>
                                        </div>
                                    </div>
                                </dd>
                            </div>

                            <div
                                class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
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
                                            <a href="/stock"
                                            class="text-gray-50">
                                                View
                                                all<span class="sr-only"> Total du stock</span></a>
                                        </div>
                                    </div>
                                </dd>
                            </div>


                            <div
                            class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                            <dt>
                                <div class="absolute rounded-md bg-gray-100 p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-500 min-w-full">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                    </svg>

                                </div>
                                <p class="ml-16 truncate text-sm font-medium text-gray-500">Produits en favoris</p>
                            </dt>
                            <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                                <p class="text-2xl font-semibold text-gray-900">
                                    {{ App\Models\CommonItem::TotalFavoriteItem()}} 
                                </p>
                                <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                                    <div class="text-sm">
                                        <a href="/stock"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Voir
                                                 tout<span class="sr-only"> Total du stock</span></a>
                                    </div>
                                </div>
                            </dd>
                        </div>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">Stocks</h1>
                        <p class="mt-2 text-sm text-gray-700">La liste detaillé des derniers produits ajoutées.</p>
                    </div>
                </div>
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr class="divide-x divide-gray-200">
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                Modéle</th>
                                            <th scope="col"
                                                class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Catégorie
                                            </th>
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
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($items as $item)
                                            <tr class="divide-x divide-gray-200">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">
                                                    {{ $item->model }}</td>
                                                <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                                    {{ $item->category->name }}
                                                </td>
                                                <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                                    {{ $item->totalPrice }}
                                                </td>
                                                <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                                    @if ($item->quantity < 30)
                                                        <p class="text-red-500">Pas de stock
                                                        </p>
                                                    @else
                                                        <p class="text-green-500">En stock
                                                        </p>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- More people... -->
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

