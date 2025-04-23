@extends('layouts.app')
@section('title', 'Notification')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="bg-base-card py-3 px-3 text-base-text mt-5">
        <div class="border-b-2 border-b-base-text p-5">
            Notification
        </div>

        @foreach ($data as $notif)
            <div class="py-2 px-3 hover:bg-white flex justify-start gap-3 items-center group">
                <div
                    class="w-[30px] text-white @if ($notif['type'] == 'info') bg-blue-300 @elseif($notif['type'] == 'warning') bg-yellow-300 @elseif($notif['type'] == 'error') bg-red-300 @else bg-gray-300 @endif w-[30px] h-[30px] rounded-md flex justify-center items-center">
                    <i
                        class="fa-solid @if ($notif['type'] == 'info') fa-circle-info @elseif($notif['type'] == 'warning') fa-triangle-exclamation @elseif($notif['type'] == 'error') fa-circle-exclamation @else fa-bell @endif">
                    </i>
                </div>

                <div class="w-[80%] text-justify">
                    <p class="text-primary font-bold">{{ $notif['title'] ?? '' }}</p>
                    <p class="text-white group-hover:text-black">{{ $notif['message'] ?? '' }}</p>
                    <p class="text-xs">{{ \Carbon\Carbon::parse($notif['created_at'])->format('d-M-Y, H:i:s') }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
