@extends('layouts.app')

@section('style')

@endsection

<!-- Content Wrapper. Contains page content -->
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">                
                <a class="mr-3">Edit Theme Option Detail</a>
                <a href="{{ route('themeoption.index') }}" class="btn btn-secondary">{{ "Go Back" }}</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('themeoption.update',$viewObject->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="row">

                    <div>
                      <div class="col-auto form-group">
                        <div class="custom-file">
                          <input type="file" name="site_favicon" class="custom-file-input" id="site_favicon">
                          <label class="custom-file-label" for="exampleInputFile">Choose Favicon Image</label>
                        </div>
                      </div>
                      <div class="col-auto form-group">
                        <div id="site_favicon_preview">
                          <img src="{{ $viewObject->site_favicon }}" height="300" width="300" />
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="col-auto form-group">
                        <div class="custom-file">
                          <input type="file" name="site_logo" class="custom-file-input" id="site_logo">
                          <label class="custom-file-label" for="exampleInputFile">Choose Site Logo</label>
                        </div>
                      </div>
                      <div class="col-auto form-group">
                        <div id="site_logo_preview">
                          <img src="{{ $viewObject->site_logo }}" height="300" width="300" />
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="col-auto form-group">                        
                        <input type="text" class="form-control" name="site_name" id="site_name" value="{{ $viewObject->site_name }}" placeholder="Site Name" required="">
                      </div>
                    </div>

                    <div>
                      <div class="col-auto mt-auto form-group">                      
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>                    

                  </div>
                </div>
                <!-- /.card-body -->                
              </form>
            </div>
            <!-- /.card -->          
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
            $('#' + preview).append('<img src="'+e.target.result+'" width="300" height="300"/>');
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#site_favicon").change(function () {
        filePreview(this,'site_favicon_preview');
    });

    $("#site_logo").change(function () {
        filePreview(this,'site_logo_preview');
    });

  });
</script>

@endsection
