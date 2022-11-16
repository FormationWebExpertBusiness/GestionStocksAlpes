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
</div>
@endsection