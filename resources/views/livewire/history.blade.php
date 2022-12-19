<div>
    <div class="px-4 sm:px-6 lg:px-8" wire:init='loadData'>
        <div class="sm:flex sm:items-center mt-10 mb-6">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        Historique</h2>
                </div>
                <p class="mt-2 text-sm text-gray-700">Liste des déplacements du stock</p>
            </div>
        </div>
        {{-- filters --}}
        <header class="bg-white pb-2 rounded-t-lg">
            <section aria-labelledby="filter-heading">
                <div class="bg-white pb-4">
                    <div class="mx-auto flex max-w-7xl items-center justify-between ">
                        <div class="flow-root ml-auto">
                            <div class="-mx-4 flex items-center divide-x divide-gray-200">
                                {{-- search bar --}}
                                <div class="relative inline-flex items-center px-4 h-10 text-left" >
                                    <div class="min-w-0 flex-1">
                                        <label for="search" class="sr-only">Search</label>
                                        <div class="relative rounded-md shadow-sm">
                                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <!-- Heroicon name: mini/magnifying-glass -->
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                                    </svg>
                                                </div >
                                                <div class="inline-block mt-1 w-80 border rounded-md border-gray-300 focus-within:border-indigo-600">
                                                    <input type="search" name="search" id="search" wire:model="searchFilter" class="block rounded-md w-full pl-10 border border-transparent bg-gray-50 focus:border-indigo-600 focus:ring-0 sm:text-sm" placeholder="Rechercher">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- datepicker --}}
                                <div class="relative inline-flex items-center px-4 h-10 text-left">
                                    <div class="min-w-max inline-block flex-1">
                                        <label for="dateFrom" class="inline-block mr-2 text-sm font-medium text-gray-700">Entre le </label>
                                        <div class="relative inline-block rounded-md shadow-sm">
                                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <!-- Heroicon name: mini/magnifying-glass -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                    </svg>
                                                </div>
                                                <div class="inline-block mt-1 w-40 border rounded-md border-gray-300 focus-within:border-indigo-600">
                                                    <input type="date" name="dateFrom" id="dateFrom" wire:model="dateFrom" min="{{ App\Models\HistoryProduct::oldestDate() }}" max="{{ App\Models\HistoryProduct::newestDate() }}" class="block rounded-md w-full pl-10 border border-transparent bg-gray-50 focus:border-indigo-600 focus:ring-0 sm:text-sm"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="min-w-0 inline-block flex-1">
                                        <label for="dateFrom" class="inline-block mx-2 text-sm font-medium text-gray-700">et le </label>
                                        <div class="relative inline-block rounded-md shadow-sm">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <!-- Heroicon name: mini/magnifying-glass -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                </svg>  
                                            </div>
                                            <div class="inline-block mt-1 w-40 border rounded-md border-gray-300 focus-within:border-indigo-600">
                                                <input type="date" name="dateTo" id="dateTo" wire:model="dateTo" min="{{ App\Models\HistoryProduct::oldestDate() }}" max="{{ App\Models\HistoryProduct::newestDate() }}" class="block rounded-md w-full pl-10 border border-transparent bg-gray-50 focus:border-indigo-600 focus:ring-0 sm:text-sm"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- categories Dropdown --}}
                                <div class="relative inline-flex items-center px-4 h-10 text-left">
                                    <button type="button" wire:click="$toggle('isVisibleCat')" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                        <span>Catégories</span>
                                        <span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($catsFilter) }}</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    @if ($isVisibleCat)
                                        <div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" @click.outside="$wire.isVisibleCat = false">
                                            <form class="space-y-1">
                                                @foreach ($categories as $category)
                                                    <div class="flex items-center">
                                                        <input id="{{ 'cat-' . $category }}" name="{{ $category }}" value="{{ $category }}" type="checkbox" wire:model='catsFilter' class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                        <label for="{{ 'cat-' . $category }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $category }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                {{-- brands Dropdown --}}
                                <div class="relative inline-flex items-center px-4 h-10 text-left">
                                    <button wire:click="$toggle('isVisibleBrand')" type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                        <span>Marques</span>
                                        <span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($brandsFilter) }}</span>
                                        <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    @if ($isVisibleBrand)
                                        <div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" @click.outside="$wire.isVisibleBrand = false">
                                            <form class="space-y-1">
                                                @foreach ($brands as $brand)
                                                    <div class="flex items-center">
                                                        <input id="{{ 'brand-' . $brand }}" name="{{ $brand }}" 
                                                            value="{{ $brand }}" type="checkbox" wire:model='brandsFilter' 
                                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                        <label for="{{ 'brand-' . $brand }}" 
                                                            class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $brand }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                {{-- resert filters button --}}
                                <div class="relative inline-flex items-center px-4 h-10 text-left">
                                    <button wire:click="resetFilters" type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>                                      
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header> 

        {{-- history table --}}
        <div class="flex flex-col">
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
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-52">
                                        Action
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-38">
                                        Utilisateur
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Catégorie
                                    </th>
                                    {{-- <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Marque
                                    </th> --}}
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Modèle
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Numéro de série
                                    </th>
                                    {{-- <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-24">
                                        Prix
                                    </th> --}}
                                    <th scope="col" 
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-1/4">
                                        Commentaire
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white block max-h-[62vh] overflow-y-scroll">
                                @forelse ($historyProducts as $historyProduct)
                                    <div wire:key="History-product-{{ $historyProduct->id }}">
                                        <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-20">
                                                {{ $historyProduct->created_at->format('d/m/y') }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-52 justify-center">
                                                @if ($historyProduct->code_action === 'C')
                                                    <span class="inline-flex items-center rounded-md bg-green-200 px-2.5 py-0.5 text-sm font-medium text-green-800">
                                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                          <circle cx="4" cy="4" r="3" />
                                                        </svg>
                                                        Entrée en stock
                                                    </span>
                                                @elseif ($historyProduct->code_action === 'D')
                                                    <span class="inline-flex items-center rounded-md bg-red-200 px-2.5 py-0.5 text-sm font-medium text-red-800">
                                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                          <circle cx="4" cy="4" r="3" />
                                                        </svg>
                                                        Sortie du stock
                                                    </span>
                                                @elseif ($historyProduct->code_action === 'U')
                                                    <span class="inline-flex items-center rounded-md bg-blue-200 px-2.5 py-0.5 text-sm font-medium text-blue-800">
                                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-blue-400" fill="currentColor" viewBox="0 0 8 8">
                                                          <circle cx="4" cy="4" r="3" />
                                                        </svg>
                                                        Modification du produit
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center rounded-md bg-gray-200 px-2.5 py-0.5 text-sm font-medium text-gray-800">
                                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                          <circle cx="4" cy="4" r="3" />
                                                        </svg>
                                                        Inconnue
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 truncate w-38">
                                                {{ $historyProduct->user->username }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 truncate">
                                                {{ $historyProduct->category }}</td>
                                            {{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 truncate">
                                                {{ $historyProduct->brand }}</td> --}}
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 truncate">
                                                {{ $historyProduct->model }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 truncate">
                                                    {{ $historyProduct->serial_number }}
                                            </td>
                                            {{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-24">
                                                {{ number_format($historyProduct->price, 2, ',', ' '); }} €</td> --}}
                                            <td class="whitespace-wrap px-3 py-4 text-sm text-gray-500 w-1/4">
                                                {{ $historyProduct->comment }}
                                            </td>
                                        </tr>
                                    </div>
                                @empty
                                    @if ($readyToLoad)
                                        <tr class="bg-white divide-x divide-gray-200 table w-full table-fixed">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun mouvement dans le stock</h3>
                                            
                                        </div>
                                        </td>
                                        </tr>
                                    @else
                                        @for ($i = 0; $i < 12; $i++)
                                            <div>
                                                <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-20">
                                                        <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-52 justify-center">
                                                        <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-38">
                                                        <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                    </td>
                                                    {{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                    </td> --}}
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                    </td>
                                                    {{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-24">
                                                        <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                    </td> --}}
                                                    <td class="whitespace-wrap px-3 py-4 text-sm text-gray-500 w-1/4">
                                                        <p class="leading-relaxed rounded-md w-2/3 animate-pulse bg-gray-400 h-6"><br></p>
                                                    </td>
                                                </tr>
                                            </div>
                                        @endfor
                                    @endif
                                @endforelse
                            </tbody>
                        </table>
                        <div class="relative">
                            <div class="border-t justify-center flex py-4">
                                {{ $historyProducts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
