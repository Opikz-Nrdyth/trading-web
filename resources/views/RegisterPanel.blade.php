@extends('layouts.auth')
@section('title', 'Register')

@section('content')
    <div
        class="mt-48 p-8 rounded-lg shadow-lg w-full max-w-md border-2 border-yellow-500 bg-[#090e34]/60 backdrop-blur-sm relative">
        <div>
            <img src="/images/hero-shape-2.svg" class="absolute top-0 left-0" alt="hero-shape">
        </div>
        <div class="text-center mb-6">
            <img alt="Logo of a wolf head with text 'The Systematic Trader'" class="mx-auto mb-4" height="100"
                src="{{ config('services.storage_public') }}{{ \App\Models\setting::first()->company_logo }}"
                width="100" />
            <p class="text-2xl font-extrabold bg-gradient-to-r from-blue-900 to-red-500 bg-clip-text text-transparent">
                {{ \App\Models\setting::first()->comapany_name }}</p>
        </div>
        <livewire:Register />
        <p class="text-white mt-2">Already have an account? <a href="/login" class="text-yellow-400 font-extrabold">Login
                now</a></p>
    </div>
@endsection
