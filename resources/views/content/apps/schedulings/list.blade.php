@extends('layouts/layoutMaster')

@section('title', 'Schedulings')

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
                <h4 class="card-title">Schedulings List</h4>
            </div>

            <div class="card-body border-bottom">
                <div class="table-responsive pt-0">
                    <table id="schedulings-table" class="table dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Ministry Name</th>
                                <th>Pastor Name</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Mobile</th>
                                <th>Email</th>

                                <th>Created At</th>
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
            $('#schedulings-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('schedulings.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'ministry_name',
                        name: 'ministry_name'
                    },
                    {
                        data: 'pastor_name',
                        name: 'pastor_name'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'state',
                        name: 'state'
                    },
                    {
                        data: 'mobile_phone',
                        name: 'mobile_phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        visible: false
                    }
                ],
                order: [
                    [8, 'desc']
                ], // order by created_at
                drawCallback: function() {
                    feather.replace();
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>
@endsection
