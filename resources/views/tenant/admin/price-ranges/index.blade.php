@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Price Ranges</h5>
                            <a href="{{ route('tenant.admin.price-ranges.create') }}" class="btn btn-primary">
                                <i class="icofont icofont-plus"></i> Add New Price Range
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Min Price</th>
                                        <th>Max Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($priceRanges as $priceRange)
                                        <tr>
                                            <td>{{ $priceRange->name }}</td>
                                            <td>{{ $priceRange->min !== null ? 'Rp ' . number_format($priceRange->min, 0, ',', '.') : 'No minimum' }}</td>
                                            <td>{{ $priceRange->max !== null ? 'Rp ' . number_format($priceRange->max, 0, ',', '.') : 'No maximum' }}</td>
                                            <td>
                                                @if($priceRange->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('tenant.admin.price-ranges.edit', $priceRange) }}" 
                                                       class="btn btn-sm btn-warning">
                                                        <i class="icofont icofont-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('tenant.admin.price-ranges.destroy', $priceRange) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Are you sure you want to delete this price range?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="icofont icofont-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No price ranges found. <a href="{{ route('tenant.admin.price-ranges.create') }}">Create your first price range</a>.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection