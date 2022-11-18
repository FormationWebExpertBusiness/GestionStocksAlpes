<div>
    <!-- message de confirmation -->
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
    <!-- pop-up before delete -->
    @livewire('warning-before-delete')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mt-10 mb-6">
            <div class="sm:flex-auto">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        Configuration</h2>
                </div>
                <p class="mt-2 text-sm text-gray-700">modification des étagères, catégories et marques</p>
            </div>
        </div>

        {{-- sub tabs --}}
        <div>
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                    @foreach ($tabs as $t)
                        @if ($tab === $t)
                            <button wire:click='changeTab({{ array_search($t, $tabs) }})' class="border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                                {{ $t }}
                            </button>
                        @else
                            <button wire:click='changeTab({{ array_search($t, $tabs) }})' class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                {{ $t }}
                            </button>
                        @endif
                    @endforeach
                </nav>
            </div>
        </div>

        @if ($tab === $tabs[0])
            {{-- categories forms --}}
            <div class="max-h-[80vh] py-8 overflow-scroll" wire:key='categories-forms'>
                {{-- add --}}
                @livewire('forms.category.category-add-form')

                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>

                {{-- modify --}}
                @livewire('forms.category.category-edit-form')

                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>

                {{-- delete --}}
                @livewire('forms.category.category-delete-form')

            </div>
        @elseif($tab === $tabs[1])
            {{-- brands forms --}}
            <div class="py-8" wire:key='brands-forms'>
                @livewire('forms.brand.brand-form')
            </div>
        @else
            {{-- racks forms --}}
            <div class="max-h-[80vh] py-8 overflow-scroll" wire:key='racks-forms'>

            </div>
        @endif

    </div>
</div>
