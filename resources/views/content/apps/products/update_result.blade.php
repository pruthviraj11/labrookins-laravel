@extends('layouts/layoutMaster')

@section('title', 'Product Sync Comparison')

@section('content')
    <section class="app-user-list">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Product Sync Comparison (Dry Run)</h5>
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary me-2">{{ count($updatedInfo) }} Changes Detected</span>
                    @if(count($updatedInfo) > 0)
                        <form action="{{ route('store.update_products.sync') }}" method="POST" class="me-2" onsubmit="return confirm('Are you sure you want to apply these changes to the target database?')">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="ti ti-refresh me-1"></i> Sync Changes Now
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('store.products.list') }}" class="btn btn-secondary">Back to Products</a>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted">Comparing products between <strong>labrooking_01_04_2026</strong> (Source) and <strong>labrooking_laravel_01_04_2026</strong> (Target).</p>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <span class="alert-icon text-warning me-2">
                        <i class="ti ti-info-circle ti-xs"></i>
                    </span>
                    <div>
                        <strong>Note:</strong> This is a comparison only. No data has been updated in the target database.
                    </div>
                </div>
                
                <div class="table-responsive pt-0">
                    <table class="table table-hover border-top">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Details</th>
                                <th class="text-center">Category ID</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Product Digital</th>
                                <th>Download Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($updatedInfo as $info)
                                <tr>
                                    <td>#{{ $info['id'] }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-heading">{{ $info['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-label-info">ID: {{ $info['category_id'] }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($info['price']['before'] != $info['price']['after'])
                                            <div class="d-flex flex-column">
                                                <small class="text-danger"><s>${{ number_format((float)$info['price']['before'], 2) }}</s></small>
                                                <span class="badge bg-label-success">${{ number_format((float)$info['price']['after'], 2) }}</span>
                                            </div>
                                        @else
                                            <span class="text-muted">${{ number_format((float)$info['price']['after'], 2) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($info['discount']['before'] != $info['discount']['after'])
                                            <div class="d-flex flex-column">
                                                <small class="text-danger"><s>${{ number_format((float)$info['discount']['before'], 2) }}</s></small>
                                                <span class="badge bg-label-success">${{ number_format((float)$info['discount']['after'], 2) }}</span>
                                            </div>
                                        @else
                                            <span class="text-muted">${{ number_format((float)$info['discount']['after'], 2) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($info['digital']['before'] != $info['digital']['after'])
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="badge bg-label-secondary me-1">{{ $info['digital']['before'] }}</span>
                                                <i class="ti ti-arrow-right ti-xs text-muted mx-1"></i>
                                                <span class="badge bg-label-primary">{{ $info['digital']['after'] }}</span>
                                            </div>
                                        @else
                                            <span class="badge bg-label-secondary">{{ $info['digital']['after'] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($info['document']['before'] != $info['document']['after'])
                                            <div class="d-flex flex-column">
                                                <small class="text-danger"><s>{{ $info['document']['before'] ?: 'Empty' }}</s></small>
                                                <small class="text-success">{{ $info['document']['after'] ?: 'Empty' }}</small>
                                            </div>
                                        @else
                                            <small class="text-muted">{{ $info['document']['after'] ?: 'No Change' }}</small>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ti ti-layout-grid-add ti-lg text-success mb-2"></i>
                                            <h5>All caught up!</h5>
                                            <p class="text-muted">Everything in the Target DB matches the Source DB.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
