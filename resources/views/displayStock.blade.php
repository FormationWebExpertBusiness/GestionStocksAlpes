@extends('template')
@section('title', 'Stock')
@section('content')
<div class="min-w-0 ml-64">
    @livewire('filtres')
    @livewire('view-all')
    <livewire:scripts />
</div>
@endsection