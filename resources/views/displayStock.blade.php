@extends('template')
@section('title', 'Stock')
@section('content')
<script src="{{ asset('js/app.js') }}"></script>
<div class="min-w-0 ml-64">
    @livewire('view-all')
</div>
<livewire:scripts />
@endsection