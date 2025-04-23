@extends('layouts.app')
@section('title', 'Bonus')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <livewire:tabel title='Bonus [Total Bonus : {{ $totalBonus }}]' action="{{ true }}"
        searchbar="{{ true }}" :header="$header" :colum="$colum" :searchableHeaders="$filtered" />
@endsection
