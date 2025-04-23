@extends('layouts.app')
@section('title', 'Setting - Profile')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="bg-base-card text-base-text py-3 px-3 mt-5">
        <div class="border-b-2 border-b-base-text p-5">
            Profile Images
        </div>
        <div>
            <p>This page allows you to upload your personal photo to your profile.</p>

            <p>Terms of photos</p>

            <ul class="list-disc ml-10">
                <li>Image file formats are allowed only: jpg, jpeg, png and gif.</li>
                <li>Image dimensions will automatically be resize max width 1024 pixel.</li>
                <li>Image file size should not be more than 1 MB</li>
            </ul>
            <img class="w-[70px] h-[70px] mt-3 rounded-full"
                src="@if (auth()->user()->userData->profile_image != '') {{ asset('public/storage/' . auth()->user()->userData->profile_image) }}
            @else
                https://ui-avatars.com/api/?name={{ implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', auth()->user()->name ?? ''))) }}&color=FFFFFF&background=00a8e8 @endif"
                alt="{{ implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', auth()->user()->name ?? ''))) }}">
            <livewire:UploadProfile />
        </div>
    </div>
@endsection
