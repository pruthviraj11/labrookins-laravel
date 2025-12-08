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
                <h5 class="card-title mb-0">Products List</h5>
                <a href="{{ route('store.products.add') }}" class="btn btn-primary">Add Product</a>
            </div>
            <div class="card-body border-bottom">

                    <!-- Search Filter Section -->
                    <div class="d-flex justify-content-center align-items-center flex-wrap gap-2 mb-3">

                        <select class="form-control" id="filter_category" style="width:200px;">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>

                        <select class="form-control" id="filter_product_type" style="width:200px;">
                            <option value="">Select Product Type</option>
                            <option value="yes">Digital</option>
                            <option value="no">Physical</option>
                        </select>


                        <input type="text" class="form-control" id="filter_price" placeholder="Search Price" style="width:200px;">

                        <select class="form-control" id="filter_status" style="width:200px;">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <!-- Search Button -->
                        <button type="button" class="btn btn-primary" id="search_button">
                            Search
                        </button>
                    </div>
                       

                <div class="table-responsive pt-0">
                    <label class="ml-5" style="cursor: pointer;">
                        <button type="button"
                            class="btn btn-danger mb-3 mt-2"
                            id="delete-product">
                            Delete 
                        </button>
                        <br>
                    </label>
                     
                     
                    <table class="table dt-responsive w-100" id="productsTable">
                        <thead>
                            <tr>
                                <th>All<input type="checkbox" id="masterCheckbox_product"></th>
                                
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
            var table = $('#productsTable').DataTable({
                processing: true,
                serverSide: true,
                 ajax: {
                            url: '{{ route("store.products.getAll") }}',
                            data: function (d) {
                                d.category = $('#filter_category').val();
                                d.product_type = $('#filter_product_type').val();
                                d.price = $('#filter_price').val();
                                d.status = $('#filter_status').val();
                            }
                        },
                order: [[1, 'ASC']],
                columns: [
                    { 
                        data: 'checkbox', 
                        name: 'checkbox',
                        orderable: false, 
                        searchable: false
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

            // 🔍 Search Button Click
            $('#search_button').on('click', function(){
                table.ajax.reload();
            });
            
        });

        $(document).on('change', '#masterCheckbox_product', function () 
        {
        
        $('.product_row_checkbox').prop('checked', $(this).prop('checked'));
        });

        $(document).on('change', '.product_row_checkbox', function () 
        {
            if ($('.product_row_checkbox:checked').length == $('.product_row_checkbox').length) {
                $('#masterCheckbox_product').prop('checked', true);
            } else {
                $('#masterCheckbox_product').prop('checked', false);
            }
        });

        $(document).on('click', '#delete-product', function () 
        {

            let ids = [];

                $('.product_row_checkbox:checked').each(function () 
                {
                    ids.push($(this).val());
                });

                if (ids.length === 0) 
                {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Selection',
                        text: 'Please select at least one record.',
                    });
                    return;
                }

                Swal.fire({
                    title: "Are you sure?",
                    text: "Selected Products will be deleted!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "Cancel",
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({
                            url: "{{ route('delete_multi_products') }}",
                            type: "POST",
                            data: {
                                ids: ids,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Selected records have been deleted.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                $('#productsTable').DataTable().ajax.reload();

                                // setTimeout(function () {
                                //     location.reload();
                                // }, 1500);
                            }
                        });

                    }
                });
        });

    </script>
@endsection
