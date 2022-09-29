@props(['class' => '', 'name', 'label', 'isOptional' => false, 'model', 'placeholder'])

<div class="{{ $class }}">
    <div class="flex justify-between">
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
        @if ($isOptional)
            <span class="text-sm text-gray-500">Optionnel</span>
        @endif
    </div>
    <div class="mt-1 flex rounded-md shadow">
        <textarea name="{{ $name }}" id="{{ $name }}" wire:model="{{ $model }}"
            placeholder="{{ $placeholder }}" rows="10"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </textarea>
    </div>
</div>