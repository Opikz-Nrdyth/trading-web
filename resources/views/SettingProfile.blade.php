@extends('layouts.app')
@section('title', 'Setting - Profile')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="text-base-text mt-3 flex flex-col lg:flex-row justify-between gap-2">
        <div class="bg-base-card py-3 sm:w-full lg:w-[70%] px-3">
            <div class="border-b-2 border-b-base-text p-5">
                Profile
            </div>
            <livewire:SettingForm />
        </div>
        <div class="bg-base-card py-3 px-3 sm:w-full lg:w-[30%]">
            <div class="border-b-2 border-b-base-text p-5">
                Change Password
            </div>
            <livewire:ResetPassword />
        </div>
    </div>
@endsection
