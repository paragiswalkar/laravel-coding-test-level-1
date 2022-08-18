@extends('layouts.app')
@section('content')
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="//cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <div class="container-fluid">
        <h1 class="text-black-50">You are logged in!</h1>
        <div class="col-md-12">
            <div class="col-md-12">
            <div class="pull-right">
                <a href="{{ route('create-event') }}" class="btn btn-primary btn-sm">Add New Event</a>
            </div>
            </div>
            <div class="col-md-12">
                <table id="example" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#example').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/v1/events',
            type: 'GET',
            data: {'token': '{{$token}}'}
        },
        columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'name', name: 'name'},
            {data: 'slug', name: 'slug'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>    
@endsection