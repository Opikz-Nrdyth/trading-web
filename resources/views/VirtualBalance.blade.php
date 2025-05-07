@extends('layouts.app')
@section('title', 'Virtual Balance')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <livewire:tabel title='Virtual Balance [ {{ $totalBalance }}]' action="{{ true }}" searchbar="{{ true }}"
        :header="$header" :colum="$colum" :searchableHeaders="$filtered" />
@endsection
