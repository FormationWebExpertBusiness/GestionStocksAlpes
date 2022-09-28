<div>
  <button wire:click="toggleModal" class="text-indigo-500">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
    </svg>
  </button>
  @if($show === true)
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                'comment' => $comment,
                'unit' => $unit
              ])
            </div>
          </div>
        </div>
      </div>
    </div>  
  @endif
</div>
