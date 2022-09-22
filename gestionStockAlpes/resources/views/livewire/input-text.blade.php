<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<div class="{{ $class }}">
    <div class="flex justify-between">
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
        @if($isOptional)
            <span class="text-sm text-gray-500">Optionnel</span>
        @endif
    </div>
    <div class="mt-1">
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="{{ $placeholder }}">
    </div>
  </div>