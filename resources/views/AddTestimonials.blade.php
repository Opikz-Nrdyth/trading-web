@extends('layouts.app')
@section('title', 'Testimonials')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    <div class="text-base-text mt-3 flex justify-between gap-2">
        <div class="bg-base-card py-3 w-[40%] px-3">
            <div class="border-b-2 border-b-base-text p-5">
                Add Testimonial
            </div>
            <livewire:FormTestimonial />
        </div>
        <div class="bg-base-card py-3 px-3 w-[60%]">
            <livewire:tabel title='Data Testimonial' searchbar="{{ true }}" :header="$header" :colum="$colum"
                :searchableHeaders="$filtered" />
        </div>
    </div>
@endsection
