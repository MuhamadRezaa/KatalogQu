@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Edit Price Range</h5>
                            <a href="{{ route('tenant.admin.price-ranges.index') }}" class="btn btn-secondary">
                                <i class="icofont icofont-arrow-left"></i> Back to Price Ranges
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tenant.admin.price-ranges.update', $priceRange) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $priceRange->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="min" class="form-label">Minimum Price (Rp)</label>
                                        <input type="number" 
                                               class="form-control @error('min') is-invalid @enderror" 
                                               id="min" 
                                               name="min" 
                                               value="{{ old('min', $priceRange->min) }}" 
                                               min="0" 
                                               step="1000">
                                        @error('min')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="max" class="form-label">Maximum Price (Rp)</label>
                                        <input type="number" 
                                               class="form-control @error('max') is-invalid @enderror" 
                                               id="max" 
                                               name="max" 
                                               value="{{ old('max', $priceRange->max) }}" 
                                               min="0" 
                                               step="1000">
                                        @error('max')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $priceRange->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('tenant.admin.price-ranges.index') }}" class="btn btn-secondary">
                                    <i class="icofont icofont-arrow-left"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="icofont icofont-save"></i> Update Price Range
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection