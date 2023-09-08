@extends('layouts.app-master')

@section('content')
<main>

  
    <div class="container col-xl-12 col-lg-12  ">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 mb-3">HR Management Module</h1>
          <p class="col-lg-10 fs-4">You can Submit your Application Here and We Will Contact You Soon</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <div class="bg-light p-5 rounded">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
             @endif
                <form id="application_form" action="{{ route('application.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name"
                            placeholder="Enter name">
              
                    </div>
                    <div class="form-group">
                        <label for="nationality">Nationality</label>
                        <input type="nationality" class="form-control" id="nationality" value="{{ old('nationality') }}"
                            name="nationality" placeholder="Enter nationality">
                        @error('nationality')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="DOB" value="2015-08-09" name="DOB"
                            value="{{ old('dob') }}" placeholder="Enter date of birth">
                        @error('dob')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="age">Select Gender</label>
                        <select class="form-select" name="gender" aria-label="Default select example">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
        
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" type="file" id="cv" name="cv">
                        @error('cv')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary pt-2">Submit</button>
                    </div>
            </div>
        </div>
      </div>
    </div>
  

  
  
  
   

  </main>
  
@endsection
@section('scripts')
    <script>
        $("#application_form").validate({
  // Specify the validation rules
  rules: {
      name: "required",
      nationality: "required",
      DOB: "required",
      cv: "required",
      gender: "required",
  },

  // Specify the validation error messages
  messages: {
      name: "Please enter your  name",
      nationality: "Please enter your nationality",
      DOB: "Please enter your  date of birth",
      cv: "Please upload your cv",
  },

  submitHandler: function(form) {
    form.submit();
  }
});
    </script>
@endsection
