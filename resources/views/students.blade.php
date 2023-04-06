@extends('Layout.layout')

@section('content')
<style>
    .pagination{
        display: none;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.7/js/dataTables.scroller.min.js"></script>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Students</h2>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered data-table">
    <thead>
    <tr>
            <th>No</th>
            <th>Name</th>
            <th>Class</th>
            <th>Section</th>
            <th>Branch</th>
            <th>Join Date</th>
        </tr>
        </thead>
    </table>

    <script>
        $(function () {
    
            var access_token = "{{ session('access_token') }}";

            var table = $('.data-table').DataTable({
                ajax: {
                    "url": "/api/students",
                    contentType: "application/json",
                    headers: {
                        "Cache-Control": "no-cache",
                        "Authorization": "Bearer " + access_token,
                    },
                    "dataSrc": function ( json ) {
                        return appendDataToTable(json);
                    }
                },
                deferRender:    true,
                scrollY:        380,
                scrollCollapse: true,
                scroller:       true,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'class', name: 'class'},
                    {data: 'section', name: 'section'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'join_date', name: 'join_date'},
                ],
            fixedHeader: {
                header: true,
                footer: true,
            }
            });
            
        });

        function appendDataToTable(response)
        {
            var resp_data = [];
            console.log(response);

            $.each(response, function(i, item) {
                resp_data.push({
                    "id": i+1,
                    "name": item.name,
                    "class": item.class,
                    "section": item.section,
                    "branch_name": item.branch_name,
                    "join_date": item.join_date
                });

            });

            return resp_data;
        }
</script>

@endsection