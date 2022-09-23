<div>
    @if($show === true)
        <!-- This example requires Tailwind CSS v2.0+ -->
<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!--
      Background backdrop, show/hide based on modal state.
  
      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div  wire:click="toggleModal" class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-5xl sm:p-6">
          <div>
                @livewire('detail-modal-content',[
                    'category' => $category,
                    'price' => $price,
                    'brand' => $brand,
                    'model' => $model,
                    'quantity' => $quantity,
                    'currency' => $currency,
                    'unit' => $unit
                  ])
          </div>
        </div>
      </div>
    </div>
  </div>  
    @endif
    <button wire:click="toggleModal" class="text-indigo-500">
        Detail
    </button>
</div>
