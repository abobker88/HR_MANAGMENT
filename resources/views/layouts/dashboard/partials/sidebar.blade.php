@section('styles')
    <style>
        .nav-pills a:hover {
            color: blue;
        }
    </style>
   
            <div class="bg-dark col-auto col-md-4 col-lg-3 min-vh-100 d-flex flex-column justify-content-between">
                <div class="flex-wrap">
                    <div class="bg-dark p-2">
                        <a class="d-flex text-decoration-none mt-1 align-items-center text-white"></a>
                        <span class="fs-4 d-none d-sm-inline text-white">Side Menu</span>
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills flex-column mt-4" id="myTab" role="tablist">
                      
                            @role('hr_coordinator')
                            <li class="nav-item py-2 py-sm-0" role="presentation">
                                <a href="{{route('dashboard.coordinator')}}" class="nav-link {{ Request::segment(1) === 'dashboard-coordinator' ? 'active' : '' }}  text-white"   id="home-tab"
                                 role="tab" aria-controls="home"
                                    aria-selected="true">
                                    <i class="fs-5 fa fa-dashboard"> </i> <span
                                        class="fs-4 ms-3 d-none d-sm-inline">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item  py-2 py-sm-0" role="presentation">
                                <a href="{{ route('application.getApplicationsForCoordinator') }}" class="nav-link {{ Request::segment(1) === 'get-applications-for-coordinator' ? 'active' : '' }}  text-white" id="profile-tab"
                                    role="tab" aria-controls="profile"
                                    aria-selected="false">
                                    <i class="fa-5 fa fa-book"></i> <span
                                        class="fs-4 ms-3 d-none d-sm-inline">Applications</span>
                                </a>
                            </li>
                            <li class="nav-item  py-2 py-sm-0" role="presentation">
                                <a href="{{ route('application.report') }}" class="nav-link {{ Request::segment(1) === 'application-report' ? 'active' : '' }}  text-white" id="profile-tab"
                                    role="tab" aria-controls="profile"
                                    aria-selected="false">
                                    <i class="fa-brands fa-wpforms fa-xl"></i>
                                    <span
                                        class="fs-4 ms-3 d-none d-sm-inline">Report</span>
                                </a>
                            </li>
                            @endrole

                            @role('hr_manager')
                            <li class="nav-item  py-2 py-sm-0" role="presentation">
                                <a href="{{ route('application.getApplicationsForManager') }}" class="nav-link {{ Request::segment(1) === 'get-applications-for-manager' ? 'active' : '' }} text-white" id="profile-tab"
                                    role="tab" aria-controls="profile"
                                    aria-selected="false">
                                    <i class="fa-5 fa fa-book"></i> <span
                                        class="fs-4 ms-3 d-none d-sm-inline">Applications</span>
                                </a>
                            </li>
                            @endrole

                        </ul>
                    </div>
                    <div class="dropdown open p-3">
                        <button class="btn border-none text-white dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                     <i class="fa fa-user"></i><span class="ms-2"> {{auth()->user()->name}}</span>
                            </button>
                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <button class="dropdown-item" href="#">Settings</button>
                            <a class="dropdown-item " href="{{route('logout.perform')}}">logout</a>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab"> home </div>
                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab"> profile </div>
                        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab"> messages </div>
                    </div>
                </div>
            </div>
   
