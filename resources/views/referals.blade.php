@extends('layouts.app')
@section('title', 'Referals')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="flex my-4">
        <input readonly type="text" class="px-2 py-2 w-[400px] rounded-l-md" value="{{ env('APP_URL') }}?reff={{auth()->user()->userData->username}}">
        <button class="bg-primary hover:bg-blue-500 px-3 py-2 rounded-r-md">Copy URL</button>
    </div>
    <livewire:tabel title='Refferals [{{ $totalReferals }}]' action={{ true }} searchbar="{{ true }}"
        :header="$header" :colum="$colum" :searchableHeaders="$filtered" />
@endsection
