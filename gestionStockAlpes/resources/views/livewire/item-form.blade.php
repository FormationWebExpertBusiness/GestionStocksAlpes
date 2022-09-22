<form action="/" method="post">
    <tr class="bg-gray-50">
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

            @livewire('select-menu', ['name' => 'category', 'listOption' => $categories, 'isOptional' => true])

        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            {{-- <select name="brand" id="brand">
                <option value="">-</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select> --}}

            @livewire('select-menu', ['name' => 'brand', 'listOption' => $brands ])

        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

            @livewire('input-text', ['name' => 'model', 'placeholder'=>'Modèle'])

        </td>
        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">

            @livewire('input-text', ['type' => 'number', 'name' => 'quantite', 'placeholder' => 'Quantité en stock', 'class' => 'inline-block'])
            @livewire('input-text', ['name' => 'unit', 'placeholder'=>'Modèle', 'placeholder' => 'Unité', 'isOptional' => true, 'class' => 'inline-block'])

        </td>
        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
            <input type="submit" class="text-indigo-600 hover:text-indigo-900" value="Enregistrer">

        </td>
    </tr>
    @livewireScripts
</form>