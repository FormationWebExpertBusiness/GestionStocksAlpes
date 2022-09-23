@extends('template')
@section('title', 'Stock')
@section('content')
    <livewire:view-all :items="$items"/>
    <livewire:scripts />
@endsection