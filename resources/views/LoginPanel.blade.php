@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div
        class="p-8 rounded-lg shadow-lg w-full max-w-md border-2 border-yellow-500 bg-[linear-gradient(to_bottom_right,rgba(8,145,178,0.35),rgba(110,231,183,0.35))]">
        <div class="text-center mb-6">
            <img alt="Logo of a wolf head with text 'The Systematic Trader'" class="mx-auto mb-4" height="100"
                src="/storage/{{ \App\Models\setting::first()->company_logo }}" width="100" />
            <p class="text-2xl font-extrabold bg-gradient-to-r from-blue-900 to-red-500 bg-clip-text text-transparent">
                {{ $comapany_name }}</p>
            <!--<div class="flex justify-center">-->
            <!--    <a href="/login">-->
            <!--        <button class="bg-blue-600 text-white py-2 px-4 rounded-l-full hover:bg-blue-700">-->
            <!--            Login-->
            <!--        </button>-->
            <!--    </a>-->
            <!--    <a href="/register">-->
            <!--        <button class="bg-blue-600 text-white py-2 px-4 rounded-r-full hover:bg-blue-700">-->
            <!--            Register-->
            <!--        </button>-->
            <!--    </a>-->
            <!--    <button class="bg-blue-600 text-white py-2 px-4 rounded-r-full hover:bg-blue-700">-->
            <!--        Forgot Password-->
            <!--    </button>-->
            <!--</div>-->
        </div>
        <livewire:Login />
        <p class="text-white mt-2">Don't have an account? <a href="/register" class="text-yellow-400 font-extrabold">Create
                an
                account now</a></p>
    </div>
@endsection
