<div>
    @if(session()->has('message'))
        <div class="absolute min-w-[10%] pb-2 pt-2 top-2 left-2 rounded-lg bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session()->get('message') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button wire:click="closeToast" type="button" id="btn-close-toast"
                            class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('#btn-close-toast').click();
                }, 1500);
            </script>
        </div>
    @endif
    @if (session('status'))
        @if ($showToast)
            <div class="absolute min-w-[10%] pb-2 pt-2 top-2 right-2 rounded-lg bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button wire:click="closeToast" type="button" id="btn-close-toast" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="progress_bg" class="w-full mt-2  bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                    <div id="progress_bar" class="bg-green-400 h-1.5 rounded-full" style="width: 1%">
                    </div>
                </div>
            </div>
            <script>
                function fillProgressBar() {
                    var progressBar = document.getElementById("progress_bar");
                    var progressBg = document.getElementById("progress_bg");
                    var width = 1;
                    var id = setInterval(frame, 30);

                    function frame() {
                        if (width >= 100) {
                            clearInterval(id);
                        } else {
                            width++;
                            progressBar.style.width = width + '%';
                        }
                    }
                }
                fillProgressBar();
                setTimeout(function() {
                    document.querySelector('#btn-close-toast').click();
                }, 3000);
            </script>
        @endif
    @endif
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mt-10 mb-6">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        Stock</h2>
                </div>
                <p class="mt-2 text-sm text-gray-700">Liste de tout les produits du stock</p>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-10 sm:flex-none">
                @livewire('forms.common-item.common-item-form')
            </div>
        </div>
        @livewire('warning-before-delete')
        @livewire('filtres', ['search' => $searchValue, 'catsFilter' => $categoriesF, 'brandsFilter' => $brandsF, 'racksFilter' => $racksF, 'rackLevelsFilter' => $rackLevelsF, 'quantityMin' => $quantityMin, 'quantityMax' => $quantityMax])

        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-100 block">
                                <tr class="table w-full table-fixed">
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[5%]">
                                        Favoris
                                    </th>

                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[5%]">
                                        Photo
                                    </th>
                                    <th wire:click="reOrder('category')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Catégorie
                                        <x-ordering-arrows champ='category' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('brand')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Marque
                                        <x-ordering-arrows champ='brand' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('model')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Modèle
                                        <x-ordering-arrows champ='model' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('quantity')" scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 w-[14%]">
                                        Quantité
                                        <x-ordering-arrows champ='quantity' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('price')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[14%]">
                                        Prix Total
                                        <x-ordering-arrows champ='price' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/5">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white block max-h-[62vh] overflow-y-scroll">
                                @forelse ($commonItems as $commonItem)
                                    <div wire:key="Common-item-{{ $commonItem->id }}">
                                        <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500 w-[5%]">
                                                @livewire('forms.common-item.common-item-toggle-favorite', ['commonItem' => $commonItem], key('common-item-favorite-' . $commonItem->id))
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-[5%]">
                                                @if ($commonItem->photo_item)
                                                    @include('livewire.lightbox')
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-6 w-6 text-red-500 hover:text-red-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $commonItem->category->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $commonItem->brand->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $commonItem->model }}</td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500 w-[14%]">
                                                @php
                                                    $quantity = $commonItem->quantityOnRack($racksF, $rackLevelsF);
                                                @endphp
                                                <div class="w-4/6 inline-block">
                                                    <div class="inline-block align-middle">
                                                        {{ $quantity }}
                                                        @if ($commonItem->quantity_urgent >= $quantity)
                                                            <div class="inline-block rounded-full align-middle bg-red-200 text-red-800">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                                                </svg>

                                                            </div>
                                                        @elseif ($commonItem->quantity_warning >= $quantity)
                                                            <div class="inline-block rounded-full align-middle bg-orange-200 text-orange-800">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="w-2/6 inline-block">
                                                    <div class="inline-block align-middle min-w-[15%]">
                                                        @livewire('forms.item.item-add-form', ['common_id' => $commonItem->id], key('item-add-form-' . $commonItem->id))
                                                    </div>
                                                    <div class="inline-block align-middle min-w-[15%]">
                                                        @livewire('forms.item.item-delete-form', ['commonItem' => $commonItem], key('item-delete-form-' . $commonItem->id))
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 w-[14%]">
                                                {{ number_format($commonItem->totalPriceOnRack($racksF, $rackLevelsF), 2, ',', ' ') }}€
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6 w-1/5">
                                                <div class="inline-block px-6">
                                                    @livewire('details.item.detail-modal', ['commonItem' => $commonItem], key('item-detail-' . $commonItem->id))
                                                </div>
                                                <div class="inline-block px-6">
                                                    @livewire('forms.common-item.common-item-form', ['commonItemToUpdate' => $commonItem], key('common-item-form-' . $commonItem->id))
                                                </div>
                                                <div class="inline-block px-6">
                                                    <button wire:click="openWarningDelete({{ $commonItem->id }})" class="text-indigo-600 hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
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
                                                <p class="mt-1 text-sm text-gray-500">Vous pouvez en ajouter un nouveau
                                                </p>
                                                <div class="mt-3">
                                                    @livewire('forms.common-item.common-item-form')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="relative">
                            <div class="border-t justify-center flex py-4">
                                {{ $commonItems->links() }}
                            </div>
                            <div class="justify-end flex">
                                <button wire:click='export' type="button" class=" absolute top-6 bottom-6 right-4 inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Exporter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
