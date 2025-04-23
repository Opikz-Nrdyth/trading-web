@extends('layouts.app')
@section('title', 'Testimonials')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="bg-base-card py-3 px-3 text-base-text mt-5">
        <div class="border-b-2 border-b-base-text p-5">
            Testimonial
        </div>

        @foreach ($data as $d)
            <x-comment updatedAt="{{ $d->updated_at->format('d-M-Y, H:i:s') }}" id="{{ $d['user_id'] }}"
                user="{{ $d->user->name }}" comment="{!! $d['testimonial'] !!}"
                profile="https://ui-avatars.com/api/?name={{ implode('',array_map(function ($word) {return strtoupper($word[0]);}, explode(' ', $d->user->name ?? ''))) }}&color=FFFFFF&background=00a8e8" />
        @endforeach
    </div>
@endsection
