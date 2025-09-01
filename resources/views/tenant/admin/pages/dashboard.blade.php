@extends('tenant.admin.layouts.app')

@section('title', $userStore->store_name . ' - Dashboard')

@section('content')
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            @if ($userStore->store_logo)
                                <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="{{ $userStore->store_name }}"
                                    class="rounded-circle" width="50" height="50">
                            @else
                                <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="icofont icofont-shop text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <h4 class="text-white mb-0">{{ $userStore->store_name }}</h4>
                            <p class="text-white-50 mb-0">Store Management Dashboard</p>
                        </div>
                        <div class="col-auto">
                            <a href="http://{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}"
                                target="_blank" class="btn btn-light btn-sm">
                                <i class="fa fa-external-link"></i> View Store
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="text-muted">Store URL</h6>
                            <p class="mb-0">
                                <strong>{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}</strong>
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <small class="text-muted">Setup completed:
                                {{ $userStore->setup_completed_at ? $userStore->setup_completed_at->format('M d, Y') : 'N/A' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>


@endsection
section
