<div>
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
                            <button wire:click="$toggle('showToast')" type="button" id="btn-close-toast" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
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
    @livewire('warning-before-delete')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mt-10 mb-6">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        Configuration des marques</h2>
                </div>
                <p class="mt-2 text-sm text-gray-700">Ajouter, modifier ou supprimer des marques</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-10 sm:flex-none">
                @livewire('forms.brand.brand-add-form')
            </div>
        </div>
        <div class="relative inline-block text-left min-w-full py-12">
            <div class="flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden max-w-5xl mx-auto shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-100 block">
                                    <tr class="table w-full table-fixed">
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Marques
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/5">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white block max-h-[70vh] overflow-y-scroll overflow-x-hidden">
                                    @forelse ($brands as $brand)
                                        <div wire:key="brand-{{ $brand->id }}">
                                            <tr class="odd:bg-white even:bg-gray-50 divide-x divide-gray-200 table w-full table-fixed">
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ $brand->name }}
                                                </td>
                                                
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6 w-1/5">
                                                    <div class="inline-block px-3">
                                                        @livewire('forms.brand.brand-edit-form', ['brand' => $brand], key('brand-delete-'.$brand->id))
                                                    </div>
                                                    <div class="inline-block px-3">
                                                        <button wire:click="openWarningDelete({{ $brand->id }})" class="inline-flex items-center rounded-md border border-transparent bg-white p-3 text-red-600 shadow hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
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
</div>
