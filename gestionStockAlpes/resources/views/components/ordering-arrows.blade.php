@props(['champF', 'champ', 'modeF'])
<div class="inline-block">
    @if ($champF == $champ)
        @if ($modeF == 'desc')
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-6 h-6 inline-block fill-indigo-700">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        @else
            <svg class="h-6 w-6 inline-block fill-indigo-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z"
                    clip-rule="evenodd" />
            </svg>
        @endif
    @else
        <svg class="h-6 w-6 inline-block fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            class="w-5 h-5">
            <path fill-rule="evenodd"
                d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z"
                clip-rule="evenodd" />
        </svg>
    @endif
</div>