@extends('layouts.app')
@section('title', 'History')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <livewire:tabel title='My Trade' action="{{ true }}" searchbar="{{ true }}" :header="$header"
        :colum="$colum" :searchableHeaders="$filtered" />
@endsection
