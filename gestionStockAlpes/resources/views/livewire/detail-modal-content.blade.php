<div>
    <div>
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Détail produit : </h2>
        </div>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Catégorie</dt>
                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{$category}}</dd>
            </div>
        
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Marque</dt>
                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{$brand}}</dd>
            </div>
        
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Modele</dt>
                <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{$model}}</dd>
            </div>


            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">
                    Prix Total (en {{$currency}})
                </dt>
                <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{$price}}</dd>
            </div>
            @if($quantity > 1)
                <div class="break-all inline rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                    <dt class="truncate text-sm font-medium text-gray-500">Prix Unitaire (en {{$currency}})
                        @if($unit != null)
                        (par {{$unit}})
                        @endif
                    </dt>
                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{round($price / $quantity, 2)}}</dd>
                </div>
            @endif
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Quantité</dt>
                <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{$quantity}} {{$unit}}</dd>
            </div>
        </dl>
    </div>
</div>
    @if($comment != null)
        <br>
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Commentaire</dt>
            <dd class="mt-1 text-xl font-medium tracking-tight text-gray-900">{{$comment}}</dd>
        </div>
    @endif
</div>
