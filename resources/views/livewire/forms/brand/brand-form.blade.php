<div>
    <div class="relative inline-block text-left min-w-full">
        <div class="sm:flex sm:items-center mb-6">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-md font-bold leading-6 text-gray-900 sm:truncate sm:text-xl sm:tracking-tight">
                        Configuration des marques</h2>
                </div>
                <p class="mt-2 text-sm text-gray-700">Ajouter, modifier ou supprimer des marques</p>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-10 sm:flex-none">
                @livewire('forms.brand.brand-add-form')
            </div>
        </div>

        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden max-w-5xl mx-auto shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-100 block">
                                <tr class="table w-full table-fixed">
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Marque
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/5">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white block max-h-[60vh] overflow-y-scroll overflow-x-hidden">
                                @forelse ($brands as $brand)
                                    <div wire:key="brand-{{ $brand->id }}">
                                        <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $brand->name }}
                                            </td>
                                            
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6 w-1/5">
                                                <div class="inline-block px-4">
                                                    @livewire('forms.brand.brand-edit-form', key('brand-delete-'.$brand->id))
                                                </div>
                                                <div class="inline-block px-4">
                                                    <button wire:click="openWarningDelete({{ $brand->id }})" class="text-gray-700 group flex items-center px-4 py-2 text-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-3 h-5 w-5 text-indigo-600 group-hover:text-indigo-900">
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
                                                <svg class="mx-auto h-12 w-12 text-gray-400 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>

                                                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit</h3>
                                                <p class="mt-1 text-sm text-gray-500">Vous pouvez en ajouter un nouveau
                                                </p>
                                                <div class="mt-3">
                                                    @livewire('forms.brand.brand-add-form')
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
