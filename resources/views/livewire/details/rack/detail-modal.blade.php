<div>
    <button wire:click="toggleModal" class="text-gray-700 group flex items-center px-4 py-2 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-3 h-5 w-5 text-indigo-600 group-hover:text-indigo-900">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
        </svg>
    </button>
    @if ($show)
    <div class="z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-5xl sm:p-6">

                    {{--  CommonProduct values --}}
                    <div>
                        <div class="min-w-0 flex-1 w-full relative">
                            <h2
                                class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                                Détail de l'étagère : </h2>
                            <!-- close button -->
                            <div class="hidden sm:block absolute top-0 right-0 pr-2">
                                <button wire:click="toggleModal" type="button"
                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="truncate text-sm font-medium text-gray-500">Nom</dt>
                                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                    {{ $rack->name }}</dd>
                            </div>

                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="truncate text-sm font-medium text-gray-500">Nombre d'étage</dt>
                                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                    {{ $rack->nb_level }}</dd>
                            </div>

                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="truncate text-sm font-medium text-gray-500">Nombre de produit sur l'étagère</dt>
                                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">
                                    {{ $rack->productsOn()->count() }}</dd>
                            </div>

                        </dl>
                    </div>
                    {{-- Products details --}}
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-100 block">
                                            <tr class="table w-full table-fixed">
                                                <th wire:click="reOrder('category')" scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Étage
                                                </th>
                                                <th wire:click="reOrder('quantity')" scope="col"
                                                    class="py-3.5 pl-4 text-left text-sm font-semibold text-gray-900">
                                                    Nombre de produit sur l'étage
                                                </th>
                                                <th wire:click="reOrder('model')" scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    QR code
                                                </th>
                                                <th scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/6">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white block max-h-[40vh] overflow-y-scroll">
                                            @for ($level = 1; $level <= $rack->nb_level; $level++)
                                                <div wire:key="Rack-{{ $rack->id }}-{{ $level }}">
                                                    <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ $level }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ $rack->productsOnLevel($level)->count() }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {!! $rack->getQrcode($level) !!}
                                                        </td>
                                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6 w-1/6">
                                                            <div class="inline-block px-6">
                                                                <button
                                                                    wire:click="downloadQrcode({{ $level }})"
                                                                    class="text-indigo-600 hover:text-indigo-900">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </div>
                                            @endfor
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
