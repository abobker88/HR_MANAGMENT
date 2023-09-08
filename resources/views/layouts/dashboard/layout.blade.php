  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard</title>
    <!-- insert stylesheets here -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/css/dashboard.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/fontawesome/css/all.min.css') !!}" rel="stylesheet">
    @yield('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" ></script>
    <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src= {!! url('assets/fontawesome/js/all.min.js') !!}></script>
    @yield('scripts')
  
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
    @include('layouts.dashboard.partials.sidebar')
    <div class="p-1">
        @yield('content')
    </div>
        </div>
    </div>
 
    <!-- insert scripts here -->
</body>
</html>