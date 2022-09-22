@extends('template')
@section('title', 'Voir Stock')
@section('content')
    <livewire:view-all :items="$items"/>
    <livewire:detail-modal />
@endsection