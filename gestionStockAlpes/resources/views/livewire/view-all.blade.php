<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Stock</h2>
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
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Categorie</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Marque</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Modele</th>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Quantité</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Prix Total</th>
                                    <th scope="col"  class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Detail</span>
                                    </th>
                                    <th scope="col"  class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <!-- Even row -->
                                @foreach ($items as $item)
                                    @if (($loop->index) % 2 === 0)
                                        <tr class="bg-white divide-x divide-gray-200">
                                    @else
                                        <tr class="bg-gray-50 divide-x divide-gray-200">
                                    @endif
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->category->name}}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->brand->name}}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->model}}</td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500">{{$item->quantity}} {{$item->unit}}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->price}} {{$item->currency}}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                                        @livewire('detail-modal',[
                                            'category' => $item->category->name,
                                            'price' => $item->price,
                                            'brand' => $item->brand->name,
                                            'model' => $item->model,
                                            'quantity' => $item->quantity,
                                            'currency' => $item->currency,
                                            'unit' => $item->unit
                                        ])
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>