@extends('layouts.app')
@section('title', 'Register')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />

@endsection
