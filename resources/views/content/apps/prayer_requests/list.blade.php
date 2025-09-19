@extends('layouts/layoutMaster')

@section('title', 'Prayer Requests')

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
                <h4 class="card-title">List of Prayer Requests</h4>
            </div>

            <div class="card-body border-bottom">
                <div class="table-responsive pt-0">
                    <table class="table dt-responsive w-100" id="prayer-requests-table">
                        <thead>
                            <tr>
                                <th>Need Prayer Person</th>
                                <th>Category</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Prayer Church Member</th>
                                <th>Requested Name</th>
                                <th>Mobile No</th>
                                <th>Email</th>
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
            $('#prayer-requests-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('prayer_requests.index') }}",
                columns: [
                    { data: 'need_prayer_name', name: 'need_prayer_name' },
                    { data: 'category', name: 'category' },
                    { data: 'subject', name: 'subject' },
                    { data: 'message', name: 'message' },
                    { data: 'prayer_church_member', name: 'prayer_church_member' },
                    { data: 'requested_name', name: 'requested_name' },
                    { data: 'mobile_one', name: 'mobile_one' },
                    { data: 'email', name: 'email' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                drawCallback: function() {
                    feather.replace();
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        });

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
                    window.location.href = url;
                }
            });
        });
    </script>
@endsection
