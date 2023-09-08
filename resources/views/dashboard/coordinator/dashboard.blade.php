@extends('layouts.dashboard.layout')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6" style="margin-top:20px">
        <div class="card border-primary">
          <div class="card-body bg-primary text-white">
            <div class="row">
              <div class="col-3">
                <i class="fa-brands fa-wpforms fa-2xl"></i>
              </div>
              <div class="col-9 text-right">
                <h1>{{$applicationCount}}</h1>
                <h4>All Applications</h4>
              </div>
            </div>
          </div>
          <a href="{{route('application.report')}}" target="_blank">
            <div class="card-footer bg-light text-primary">
              <span class="float-left">More details</span>
              <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" style="margin-top: 20px">
        <div class="card border-danger">
          <div class="card-body bg-danger text-white">
            <div class="row">
              <div class="col-3">
                <i class="fa-brands fa-wpforms fa-2xl"></i>
              </div>
              <div class="col-9 text-right">
                <h1>{{$applicationRejectedCount}}</h1>
                <h4>Rejected Applications</h4>
              </div>
            </div>
          </div>
          <a href="{{route('application.report')}}" target="_blank">
            <div class="card-footer bg-light text-danger">
              <span class="float-left">More details</span>
              <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" style="margin-top: 20px">
        <div class="card border-success">
          <div class="card-body bg-success text-white">
            <div class="row">
              <div class="col-3">
                <i class="fa-brands fa-wpforms fa-2xl"></i>
              </div>
              <div class="col-9 text-right">
                <h1>{{$applicationAcceptedCount}}</h1>
                <h4>Accepted Applications</h4>
              </div>
            </div>
          </div>
          <a href="{{route('application.report')}}" target="_blank">
            <div class="card-footer bg-light text-success">
              <span class="float-left">More details</span>
              <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  </div>
  @endsection