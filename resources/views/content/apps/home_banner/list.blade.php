@extends('layouts/layoutMaster')
@section('title', 'Home Banner')

@section('vendor-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
@endsection

@section('vendor-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
@endsection

@section('content')
<section class="app-user-list">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Home Banner List</h4>
            <a href="{{ route('home.home_banner.add') }}" class="btn btn-primary">Add Banner</a>
        </div>
        <div class="card-body border-bottom">
            <div class="table-responsive pt-0">
                <table class="table dt-responsive w-100" id="home_banner-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Order No</th>
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
    $('#home_banner-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('home.home_banner.getAll') }}",
        columns: [
            {data: 'image', render: function(data){
                return data ? `<img src="/storage/${data}" width="100" height="60" style="object-fit:cover;border-radius:6px;">` : '-';
            }},
            {data: 'title'},
            {data: 'order_by'},
            {data: 'status'},
            {data: 'actions', orderable: false, searchable: false}
        ],
        drawCallback: function() {
            feather.replace();
        }
    });
});

$(document).on("click", ".confirm-delete", function(e){
    e.preventDefault();
    let id = $(this).data("idos");
    if(confirm("Are you sure to delete this banner?")){
        window.location.href = '/home/home_banner/destroy/'+id;
    }
});
</script>
@endsection
