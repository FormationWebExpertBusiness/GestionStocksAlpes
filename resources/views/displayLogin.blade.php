@extends('template')
@section('title', 'Stock')
@section('content')
<div class="min-w-0 ml-64">
    @livewire('login')
</div>
<script src="{{ mix('/js/app.js') }}"></script>
<livewire:scripts />
@endsection