@extends('layouts/layoutMaster')
@section('title', 'Categories')

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
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Categories List</h4>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>
    <div class="card-body">
        <table class="table" id="category-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('page-script')
<script>
$(function(){
    $('#category-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('categories.getAll') }}",
        columns:[
            { data:'title', name:'title' },
            { data:'is_active', name:'is_active' },
            { data:'actions', name:'actions', orderable:false, searchable:false }
        ],
        drawCallback: function() {
            feather.replace();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });

    $(document).on("click",".confirm-delete",function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        if(confirm('Are you sure you want to delete this category?')){
            window.location.href = url;
        }
    });
});
</script>
@endsection
