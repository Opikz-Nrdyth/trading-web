@extends('layouts.app')
@section('title', 'Dashboard')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <x-chart bonus="{{ $bonus }}" profits="{{ $profits }}" members="{{ $members }}"
        wallet="{{ $wallet }}" />

    <div class="bg-base-card text-base-text mt-3">
        <div class="px-3 py-3 border-b-2 border-b-base-text text-2xl font-bold">
            Welcome
        </div>
        <div class="p-3">
            <p class="text-sm">Welcome to {{ \App\Models\setting::first()->company_name }} Member Panel.</p>
            <p class="text-sm mt-3">Your Refferal Link:</p>
            <p class="text-2xl mt-3 text-gray-100">{{ env('APP_URL') }}?reff={{ auth()->user()->userData->username ?? '' }}
            </p>
        </div>
    </div>

    <div class="grid sm:grid-cols-1 lg:grid-cols-2 gap-2">
        <div class="bg-base-card text-base-text mt-3">
            <div class="px-3 py-3 border-b-2 border-b-base-text text-2xl font-bold">
                Latest News
            </div>
            <div class="py-3">

                @foreach ($news as $news)
                    <a href="/news/{{ $news->id }}">
                        <div class="py-2 px-3 hover:bg-white flex justify-start gap-3 items-center">
                            <div
                                class="text-white bg-secondary w-[70px] aspect-square rounded-md flex justify-center items-center">
                                @if (empty($news->thumbnail))
                                    <i class="fa-solid fa-newspaper"></i>
                                @else
                                    <img class="w-full h-full object-cover object-center rounded-md"
                                        src="{{ asset(config('services.storage_public') . $news->thumbnail) }}"
                                        alt="">
                                @endif
                            </div>
                            <div class="w-[calc(100% - 70px)]">
                                <p class="text-primary">{{ $news['title'] }}</p>
                                <p>{{ \Carbon\Carbon::parse($news['created_at'])->format('d M Y, H:i:s') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="bg-base-card text-base-text mt-3">
            <div class="px-3 py-3 border-b-2 border-b-base-text text-2xl font-bold">
                Latest Notification
            </div>
            <div class="py-3">
                @foreach ($notification as $notif)
                    <div class="py-2 px-3 hover:bg-white flex justify-start gap-3 items-center">
                        <div
                            class="text-white @if ($notif['type'] == 'info') bg-blue-300 @elseif($notif['type'] == 'warning') bg-yellow-300 @elseif($notif['type'] == 'error') bg-red-300 @else bg-gray-300 @endif w-[30px] h-[30px] rounded-md flex justify-center items-center">
                            <i
                                class="fa-solid @if ($notif['type'] == 'info') fa-circle-info @elseif($notif['type'] == 'warning') fa-triangle-exclamation @elseif($notif['type'] == 'error') fa-circle-exclamation @else fa-bell @endif">
                            </i>
                        </div>

                        <div>
                            <p class="text-primary">{{ $notif['title'] ?? '' }}</p>
                            <p>{{ \Carbon\Carbon::parse($notif['created_at'])->format('d-M-Y, H:i:s') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
