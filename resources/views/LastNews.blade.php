@extends('layouts.app')
@section('title', 'Last News')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="bg-base-card py-3 px-3 text-base-text mt-5">
        <div class="border-b-2 border-b-base-text p-5">
            Recent posts
        </div>
        @foreach ($data as $d)
            <x-news id="{{ $d['id'] }}" title="{{ $d['title'] }}" thubmnail="/public/storage/{{ $d['thumbnail'] }}"
                description="{!! $d['content'] !!}" />
        @endforeach
    </div>
@endsection
