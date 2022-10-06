<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        Stock</h2>
                </div>
                <p class="mt-2 text-sm text-gray-700">Liste de tout les produits du stock</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                @livewire('item-form')
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-100 block">
                                <tr class="table w-full table-fixed">
                                    <th wire:click="reOrder('category')" scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 {{ $this->getDataColumnWidth() }}">
                                        Categorie
                                        <x-ordering-arrows champ='category' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('brand')" scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 {{ $this->getDataColumnWidth() }}">
                                        Marque
                                        <x-ordering-arrows champ='brand' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('model')" scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 {{ $this->getDataColumnWidth() }}">
                                        Modele
                                        <x-ordering-arrows champ='model' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('quantity')" scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6  {{ $this->getDataColumnWidth() }}">
                                        Quantité
                                        <x-ordering-arrows champ='quantity' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th wire:click="reOrder('price')" scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900  {{ $this->getDataColumnWidth() }}">
                                        Prix Total
                                        <x-ordering-arrows champ='price' champF={{$champ}} modeF={{$mode}}></x-ordering-arrows>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Detail</span>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Editer</span>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Supprimer</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white block max-h-[65vh] overflow-y-scroll">
                                @foreach ($items as $item)
                                    <div wire:key="item-{{ $item->id }}">
                                        <tr
                                            class="{{ $loop->index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} divide-x divide-gray-200 table w-full">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 {{ $this->getDataColumnWidth() }}">
                                                {{$item->category->name}}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 {{ $this->getDataColumnWidth() }}">
                                                {{ $item->brand->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 {{ $this->getDataColumnWidth() }}">
                                                {{ $item->model }}</td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500 {{ $this->getDataColumnWidth() }}">
                                                {{ $item->quantity }} {{ $item->unit }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 {{ $this->getDataColumnWidth() }}">
                                                {{ $item->price }} {{ $item->currency }}</td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                                                @livewire('detail-modal', ['item' => $item], key('item-detail-' . $item->id))
                                            </td>
                                            <td class="relative justify-around min-w-fit py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                                                @livewire('item-form', ['itemToUpdate' => $item], key('item-form-'.$item->id))
                                            </td>
                                            <td class="relative justify-around min-w-fit py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                                                <button wire:click="deleteItem({{ $item->id }})"
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
                                            </td>
                                        </tr>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    @if ($displayChoregraphie)
    <button wire:click="redirectChoregraphie()"
        class="text-indigo-600 hover:text-indigo-900">
        <img alt="Fichier:Synchronized swimming pictogram.svg" src="//upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Synchronized_swimming_pictogram.svg/300px-Synchronized_swimming_pictogram.svg.png" decoding="async" width="300" height="300" srcset="//upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Synchronized_swimming_pictogram.svg/450px-Synchronized_swimming_pictogram.svg.png 1.5x, //upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Synchronized_swimming_pictogram.svg/600px-Synchronized_swimming_pictogram.svg.png 2x" data-file-width="300" data-file-height="300" />
    </button>
    @endif
</div>
