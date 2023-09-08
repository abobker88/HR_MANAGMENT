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
        <span class="breadcrumb-item active" aria-current="page">Applications</span>
    </nav>
      <div class="container-fluid">
        <div class="row">
        <h1>Pending Applications</h1>
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
                        <th width="100px">Action</th>
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
              processing: true,
              serverSide: true,
              ajax: "{{ route('application.getApplicationsForCoordinator') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'DOB', name: 'DOB'},
                  {data: 'gender', name: 'gender'},
                  {data: 'cv', name: 'cv'},
                  {data: 'application_date', name: 'application_date'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
            
        });
        $(document).ready(function() {
    $(document).on("click", ".accept", function(e) {
       // on click of approve button function will be called 

            
           var id = $(this).attr('data-application_id');
           var status = $(this).attr('data-status');
           //sweet alert will be called to confirm the action 
              swal({
                title: "Are you sure?",
                text: "You want to approve this application",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
                .then((willApprove) => {
                    if (willApprove) {
                        // if user click on ok button then approveApplication function will be called 
                        approveApplication(id, status);
                    } else {
                    swal("Your application is not approved");
                    }
                });
       });

    });

        function approveApplication(id, status){
            $.ajax({
                url: "{{ route('application.changeStatus.coordinator') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "application_id": id,
                    "status":status
                },
                success: function(response){
                    console.log(response);
                    // swall will be called to show the success message
                    swal("Application has been approved!", {
                        icon: "success",
                    });
                    // datatable will be reloaded to show the updated data
                    $('.data-table').DataTable().ajax.reload();
                },
                error: function(response){
                    console.log(response);
                }
            });
        }

        $(document).ready(function() {
    $(document).on("click", ".reject", function(e) {
         // on click of reject button function will be called 
              var id = $(this).attr('data-application_id');
              var status = $(this).attr('data-status');
              //sweet alert will be called to confirm the action 
                  swal({
                 title: "Are you sure?",
                 text: "You want to reject this application",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
                  })
                 .then((willReject) => {
                      if (willReject) {
                            // if user click on ok button then rejectApplication function will be called 
                            rejectApplication(id, status);
                      } else {
                      swal("Your application is not rejected");
                      }
                 });
         });
    
     });
    
          function rejectApplication(id, status){
                $.ajax({
                 url: "{{ route('application.changeStatus.coordinator') }}",
                 type: "POST",
                 data: {
                      "_token": "{{ csrf_token() }}",
                      "application_id": id,
                      "status":status
                 },
                 success: function(response){
                      console.log(response);
                      // swall will be called to show the success message
                      swal("Application has been rejected!", {
                            icon: "success",
                      });
                      // datatable will be reloaded to show the updated data
                      $('.data-table').DataTable().ajax.reload();
                 },
                 error: function(response){
                      console.log(response);
                 }
                });
          }
    </script>
@endsection
@endsection