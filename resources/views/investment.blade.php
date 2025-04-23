@extends('layouts.app')
@section('title', 'Invesment')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="grid sm:grid-cols-1 lg:grid-cols-3 gap-2 mt-5">
        @foreach ($data as $d)
            {{-- <x-plan-card plan="{{ $d['plan'] }}" min="{{ $d['min_amount'] }}" max="{{ $d['max_amount'] }}"
                min_contract="{{ $d['min_contract'] }}" max_contract="{{ $d['max_contract'] }}" /> --}}
            <livewire:PlanChart :plan="$d['plan']" :min="$d['min_amount']" :max="$d['max_amount']" :minContract="$d['min_contract']" :maxContract="$d['max_contract']" />
        @endforeach
    </div>

    <livewire:tabel title='History' action="{{ true }}" searchbar="{{ true }}" :header="$header"
        :colum="$colum" :searchableHeaders="$filtered" />

@endsection
