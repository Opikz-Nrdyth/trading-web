@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div
        class="p-8 rounded-lg shadow-lg w-full max-w-md border-2 border-yellow-500 bg-[#090e34]/60 backdrop-blur-sm relative">
        <div>
            <img src="/images/hero-shape-2.svg" class="absolute top-0 left-0" alt="hero-shape">
        </div>
        <div class="text-center mb-6 relative z-10">
            <img alt="Logo of a wolf head with text 'The Systematic Trader'" class="mx-auto mb-4" height="100"
                src="{{ config('services.storage_public') }}{{ \App\Models\setting::first()->company_logo }}"
                width="100" />
            <p class="text-2xl font-extrabold text-white">
                {{ $comapany_name }}</p>
        </div>
        <livewire:Login />
        <p class="text-white mt-2">Don't have an account? <a href="/register" class="text-yellow-400 font-extrabold">Create
                an
                account now</a></p>
    </div>
@endsection
