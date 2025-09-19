@extends('layouts/layoutMaster')

@section('title', 'Itinerary List')

@section('vendor-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('vendor-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <section class="app-user-list">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title mb-0">Itinerary List</h4>
                <a href="{{ route('itinerary.create') }}" class="btn btn-primary">Add Itinerary</a>
            </div>

            <div class="card-body border-bottom">
                <div class="table-responsive pt-0">
                    <table class="table dt-responsive w-100" id="itinerary-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>Start Time</th>
                                <th>Status</th>
                                <th>Actions</th>
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
        $(document).ready(function() {
            $('#itinerary-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('itinerary.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'time_from',
                        name: 'time_from'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function() {
                    feather.replace();
                    $('[data-bs-toggle="tooltip"]').tooltip();
                },
                language: {
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });
        });
        // SweetAlert confirm delete (uses POST + _method override)
        $(document).on("click", ".confirm-delete", function(e) {
            e.preventDefault();
            var url = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "This record will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST', // POST + _method override is most reliable
                        data: {
                            _method: 'DELETE',
                            _token: $('meta[name="csrf-token"]').attr(
                                'content') // read CSRF from meta
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', response.message ||
                                'Itinerary deleted successfully.', 'success').then(
                            function() {
                                // reload your datatable (use your actual table id)
                                $('#itinerary-table').DataTable().ajax.reload(null,
                                    false);
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            var msg = 'Something went wrong.';
                            if (xhr && xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            } else if (xhr && xhr.responseText) {
                                try {
                                    var j = JSON.parse(xhr.responseText);
                                    if (j.message) msg = j.message;
                                } catch (err) {
                                    // fallback: raw text
                                    msg = xhr.responseText;
                                }
                            }
                            Swal.fire('Error!', msg, 'error');
                        }
                    });
                }
            });
        });
    </script>
@endsection
