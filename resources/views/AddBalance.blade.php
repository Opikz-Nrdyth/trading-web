@extends('layouts.app')
@section('title', 'Add Balance')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="text-base-text mt-3 flex flex-col md:flex-row justify-between gap-2">
        <div class="bg-base-card py-3 w-full lg:w-[40%] px-3">
            <div class="border-b-2 border-b-base-text p-5">
                Buy Balance
            </div>
            <livewire:FormTopup />
        </div>
        <div class="bg-base-card py-3 px-3 w-full lg:w-[60%]">
            <livewire:tabel title='Buy Cash Balance History' searchbar="{{ true }}" :header="$header"
                :colum="$colum" :searchableHeaders="$filtered" />
        </div>
    </div>
@endsection
