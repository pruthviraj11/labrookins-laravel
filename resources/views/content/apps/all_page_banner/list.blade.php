@extends('layouts/layoutMaster')
@section('title', 'All Page Banner')

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
    <!-- users list start -->
    @if (session('status'))
        <h6 class="alert alert-warning">{{ session('status') }}</h6>
    @endif
    <section class="app-user-list">
        <!-- list and filter start -->
        <div class="card">
            <div class="card-header d-flex  justify-content-between">
                <h4 class="card-title">All Page Banner List</h4>
                <a href="{{ route('app-all_page_banner-add') }}" class="col-md-2 btn btn-primary">Add Banner</a>
            </div>
            <div class="card-body border-bottom ">
                <div class="card-datatable table-responsive pt-0">
                    <table class="user-list-table table dt-responsive w-100" id="all_page_banner-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Page</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        </div>
        <!-- list and filter end -->
    </section>
    <!-- users list ends -->
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}


@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            $('#all_page_banner-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('app-all_page_banner-get-all') }}",
                columns: [{
                        data: 'image',
                        name: 'image',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            if (data) {
                                return `<img src="/storage/${data}" alt="banner" width="100" height="60" style="object-fit:cover;border-radius:6px;">`;
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'page',
                        name: 'page',
                        visible: true,
                    }, {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                drawCallback: function() {
                    feather.replace();
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });

        });
        $(document).on("click", ".confirm-delete", function(e) {
            e.preventDefault();
            var id = $(this).data("idos");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    window.location.href = '/app/all_page_banner/destroy/' + id;
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your imaginary file is safe :)',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                }
            });
        });
    </script>
    {{-- Page js files --}}
@endsection
