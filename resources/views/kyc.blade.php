@extends('layouts.app')
@section('title', 'KYC')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />
    @if ($kycStatus == 'pending')
        <div class="w-full mx-auto my-4 bg-base-card border rounded-lg shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-white">Waiting for KYC Verification</h2>
                <p class="text-base-text mt-2">Your document is being processed. Please wait for the admin to verify.
                </p>
                <div class="flex items-center mt-4">
                    <div class="w-10 h-10 bg-yellow-500 text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-clock"></i> <!-- Gunakan icon sesuai kebutuhan -->
                    </div>
                    <span class="ml-4 text-yellow-500 font-semibold">Status: Pending</span>
                </div>
            </div>
        </div>
    @elseif ($kycStatus == 'success')
        <div class="w-full mx-auto my-4 bg-base-card border rounded-lg shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-white">KYC Accepted</h2>
                <p class="text-base-text mt-2">Your documents have been successfully verified by the admin. Thank you for
                    completing the KYC process.</p>
                <div class="flex items-center mt-4">
                    <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle"></i> <!-- Gunakan icon sesuai kebutuhan -->
                    </div>
                    <span class="ml-4 text-green-500 font-semibold">Status: Approved</span>
                </div>
            </div>
        </div>
    @else
        <div class="bg-base-card py-3 w-full mt-5 px-3 text-base-text">
            <div class="border-b-2 border-b-base-text p-5">
                Send Verification
            </div>
            @if ($kycStatus == 'failed')
                <p class="text-red-500">Your account verification request was rejected! Please resubmit</p>
            @else
                Please complete the verification form below and send it to get full access to your account.
            @endif

            <livewire:KycForm full_name="{{ $kycData->user->name ?? '' }}"
                address="{{ $kycData->user->userData->address ?? '' }}" />
            <p class="text-xs mt-5">Upload only file jpg, png, gif. Max size upload 1 MB.</p>
        </div>
    @endif
@endsection
