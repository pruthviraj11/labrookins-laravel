@extends('layouts/layoutMaster')

@section('title', 'Orders')

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
                <h4 class="card-title">Order Details List</h4>
                <a href="{{ route('orders.export') }}" class="btn btn-success">Export Orders</a>
            </div>

            <div class="card-body border-bottom">
                <div class="table-responsive pt-0">
                    <table class="table dt-responsive w-100" id="ordersTable">
                        <thead>
                            <tr>
                                <th>Ordered Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Mobile</th>
                                <th>Total Amount</th>
                                <th>Order Type</th>
                                <th>Email Send</th>
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
            $('#ordersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orders.index') }}",
                columns: [{
                        data: 'date_and_time',
                        name: 'date_and_time'
                    },
                    {
                        data: 'fname',
                        name: 'fname'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'street_address1',
                        name: 'street_address1'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'order_type',
                        name: 'order_type'
                    },
                    {
                        data: 'email_send',
                        name: 'email_send',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                drawCallback: function() {
                    feather.replace();
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.send-mail-btn', function() {
            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("Something went wrong while sending email.");
                }
            });
        });
    </script>

@endsection
