@extends('layouts/layoutMaster')

@section('title', 'Contacts')

@section('vendor-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
@endsection

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
                <h4 class="card-title">List of Contacts</h4>
            </div>

            <div class="card-body border-bottom">
                <div class="table-responsive pt-0">
                    <table id="contacts-table" class="table dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Comment</th>
                                <th>Action</th>
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
            $('#contacts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contacts.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'subject',
                        name: 'subject'
                    },
                    {
                        data: 'comment',
                        name: 'comment'
                    },
                    {
                        data: 'action',
                        name: 'action',
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

        // SweetAlert2 delete confirmation
        $(document).on("click", ".confirm-delete", function(e) {
            e.preventDefault();
            var url = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "This record will be deleted (soft delete)!",
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
                    window.location.href = url;
                }
            });
        });
    </script>
@endsection
