@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div class="bg-gray-800 bg-opacity-75 p-8 rounded-lg shadow-lg w-full max-w-md border-2 border-primary">
        <div class="text-center mb-6">
            <img alt="Logo of a wolf head with text 'The Systematic Trader'" class="mx-auto mb-4" height="100"
                src="{{ asset('images/logo.png') }}" width="100" />
            <div class="flex justify-center">
                <a href="/login">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-l-full hover:bg-blue-700">
                        Login
                    </button>
                </a>
                <a href="/register">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-r-full hover:bg-blue-700">
                        Register
                    </button>
                </a>
                {{-- <button class="bg-blue-600 text-white py-2 px-4 rounded-r-full hover:bg-blue-700">
                    Forgot Password
                </button> --}}
            </div>
        </div>
        <livewire:Register />
    </div>
@endsection
