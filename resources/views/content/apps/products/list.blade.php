@extends('layouts/layoutMaster')

@section('title', 'Products List')

@section('vendor-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
@endsection

@section('vendor-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
@endsection

@section('content')
    <section class="app-user-list">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Products</h5>
                <a href="{{ route('store.products.add') }}" class="btn btn-primary">Add Product</a>
            </div>
            <div class="card-body border-bottom">
                <div class="table-responsive pt-0">
                    <table class="table dt-responsive w-100" id="productsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Product Type</th>
                                <th>Price</th>
                                {{-- <th>Discount</th> --}}
                                <th>Status</th>
                                <th>Created At</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    <script>
        $(function() {
            $('#productsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('store.products.getAll') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'product_type',
                        name: 'product_type',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'product_price',
                        name: 'product_price'
                    },

                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        visible: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
