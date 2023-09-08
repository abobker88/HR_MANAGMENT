@extends('layouts.dashboard.layout')
@section('content')
<head>
    <title>Applications</title>
@section('styles')
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
</head>

<body>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="#"><i class="fa fa-dashboard" aria-hidden="true">Dashboard</i></a>
        <a class="breadcrumb-item" href="#">Dashboard</a>
        <span class="breadcrumb-item active" aria-current="page">Report</span>
    </nav>
      <div class="container-fluid">
        <div class="row">
        <h1>Report Applications</h1>
        </div>
        <div class="row">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Form Number</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Attachment</th>
                        <th>Form Date</th>
                        <th width="100px">HR Coordinator Status</th>
                        <th width="100px">HR Manager Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(function () {
            
          var table = $('.data-table').DataTable({
            // export pdf file table 
            dom: 'Bfrtip',
            buttons: [
                'pdf'
            ],
              processing: true,
              serverSide: true,
              ajax: "{{ route('application.report') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'DOB', name: 'DOB'},
                  {data: 'gender', name: 'gender'},
                  {data: 'cv', name: 'cv'},
                  {data: 'application_date', name: 'application_date'},
                  {data: 'hr_coordinator_status', name: 'hr_coordinator_status'},
                  {data: 'hr_manager_status', name: 'hr_manager_status'},
              ]
          });
            
        });
    
    </script>
@endsection
@endsection