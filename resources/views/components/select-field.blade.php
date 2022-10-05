@props(['class' => '','name', 'label', 'isOptional' => false, 'model', 'options'])

<div class="{{ $class }}">
    <div class="flex justify-between">
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
        @if($isOptional)
            <span class="text-sm text-gray-500">Optionnel</span>
        @endif
    </div>
    <select id="{{ $name }}" name="{{ $name }}" wire:model="{{ $model }}" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
        @foreach($options as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </select>
    @error($model) <span class="error">{{ $message }}</span> @enderror
</div>