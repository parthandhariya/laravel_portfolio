@extends('layouts.app')

@section('style')

@endsection

<!-- Content Wrapper. Contains page content -->
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

            <form method="post" action="{{ route('profile') }}" enctype="multipart/form-data">
              @csrf
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center text-lg-left">

                    @if(!is_null(auth()->user()->profile_image))
                      <div id="profile_image">
                        <img class="profile-user-img img-fluid img-circle"
                           src="{{ auth()->user()->profile_image }}"
                           alt="User profile picture">
                      </div>
                    @else
                      <div id="profile_image">
                        <img class="profile-user-img img-fluid img-circle"
                           src="{{ asset('images/profile_images/default_proflie_image.png') }}"
                           alt="User profile picture">
                      </div>
                    @endif

                    
                  </div>


                  <div class="row mt-3">
                    
                    <div class="col-sm-6 form-group mt-auto">
                      <div class="custom-file">
                        <input type="file" name="profile_image" class="custom-file-input profile_image" id="exampleInputFile" accept="image/*">
                        <label class="custom-file-label" for="exampleInputFile">Profile Image</label>
                      </div>
                    </div>
                                      
                    <div class="col-sm-6 form-group">
                      <div class="custom-file">
                        <input type="file" name="dashboard_image" class="custom-file-input" id="exampleInputFile" accept="image/*">
                        <label class="custom-file-label" for="exampleInputFile">Dashboard Image</label>
                      </div>                        
                    </div>

                    

                  </div>

                  <div class="row mt-2">
                    <div class="col-sm-6 form-group mt-auto">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" id="name" value="{{ auth()->user()->name }}">
                    </div>

                    <div class="col-sm-6 form-group">
                      <label>Gender</label><br>
                      <div class="form-check form-check-inline">                        
                      <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" {{ auth()->user()->gender == "Male" ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" {{ auth()->user()->gender == "Female" ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                      </div>
                    </div>

                  </div>

                  <div class="row mt-2">
                    
                    <div class="col-sm-6 form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->email }}" placeholder="Email" disabled="">
                    </div>
                  
                    <div class="col-sm-6 form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->phone }}" placeholder="Phone" disabled="">
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-sm-12 form-group">
                      <label>About Us</label>
                      <textarea cols="10" rows="5" name="about_us" class="form-control">{{ auth()->user()->about_us }}</textarea>                        
                    </div>
                  </div>

                  <div class="row col-12">
                    <div class="pl-0 form-group">
                      <button class="btn btn-primary btn-block" type="submit" name="submit">Update Profile</button>
                    </div>
                    {{-- <div class="col-sm-6 pl-0 form-group">                      
                      <a href="{{ route('frontend',auth()->user()->slug) }}" class="btn btn-success w-100" target="_blank"><i class="fa fa-eye"></i> Preview Website</a>
                    </div> --}}
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </form>

          </div>
        
          <div class="col-md-6">

            <form method="post" action="{{ route('update.password') }}">
              @csrf
              <!-- Profile Image -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title mb-0">Change Password</h3>
                </div>
                <div class="card-body box-profile">
                  
                  <div class="row">

                      @if ($errors->has('current_password'))
                        <div class="col-sm-12 form-group">
                          <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        </div>
                      @endif

                      @if($errors->customBag->any())
                        <div class="col-sm-12 form-group">
                          {!! implode('', $errors->customBag->all('<div class="text-red">:message</div>')) !!}
                        </div>
                      @endif
                                                           
                    <div class="col-sm-12 form-group">
                        <label>
                          Enter Current Password
                          <span class="text-red"> *</span>
                        </label>
                        <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                    </div>

                    <div class="col-sm-12 form-group">
                        <label>
                          Enter New Password
                          <span class="text-red"> *</span>
                        </label>
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                    </div>

                    <div class="col-sm-12 form-group">
                        <label>
                          Confirm New Password
                          <span class="text-red"> *</span>
                        </label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password">
                    </div>

                  </div>
                
                  <div class="row col-2">
                    <div>
                    <button class="btn btn-primary btn-block" type="submit" name="submit">Update Password</button>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </form>

          </div>
        </div>
      </div>
    </section>
  
    <!-- /.content -->
  </div>

@endsection
  <!-- /.content-wrapper -->

@section('script')

<script type="text/javascript">

  $(document).ready(function(){

      function filePreview(input,preview) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#' + preview).empty();
                  $('#' + preview).append('<img src="'+e.target.result+'" class="profile-user-img img-fluid img-circle"/>');
              };
              reader.readAsDataURL(input.files[0]);
            }
        }

        $(".profile_image").change(function () {          
            filePreview(this,'profile_image');
        });

  });

</script>

@endsection
