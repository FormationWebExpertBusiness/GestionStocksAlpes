{{-- @extends('html')
@section('body')
<div>
    @include('menu')
    <div class="md:pl-64 flex flex-col flex-1">
        @include('search')
        <main class="p-5">
            <i class="fa-solid fa-1"></i>
            @yield('main')
            @if (isset($slot))
                {{ $slot }}
            @endif
        </main>
    </div>
</div>
@endsection --}}




@extends('template')
@section('title', 'Stock')
@section('content')
<div class="min-w-0 ml-64">
    {{ $slot }}
    <livewire:scripts />
    <script defer>
        window.addEventListener('alert', event => { 
            toastr[event.detail.type](event.detail.message, 
            event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>
    <script defer src="{{ asset('js/app.js') }}"></script>
</div>
@endsection