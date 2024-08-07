@extends('layouts.app')

@section('style')

@endsection

@php
  $imageArray = json_decode($property->images,true);
@endphp

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
                <h3 class="card-title mr-3">Add Property Images</h3>
                 <span class="text-red">(Maximum six images are allowed)</span>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="propertyId" value="{{ $property->id }}">

                <div class="card-body"> 

                  <div class="row">
                  
                    @foreach($imageArray as $k => $v)

                      
                        <div class="col-auto form-group">
                          <div class="custom-file">
                            <input type="file" name="images[{{ $v }}]" class="custom-file-input images" data-id="{{ $v }}">
                            <label class="custom-file-label" for="exampleInputFile">Choose Property Image {{ $v + 1 }}</label>
                          </div>
                          <div class="mt-3" id="{{ 'previewId'.$v }}">
                            
                          </div>
                        </div>
                        
                    @endforeach
                    
                  </div>

                  <div class="row">
                      <div class="col-auto mt-auto form-group">                      
                        <button type="submit" class="btn btn-primary">Save</button>
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

    function filePreview(input,preview,fileid) {
    
    if (input.files && input.files[0]) {

        var reader = new FileReader();
        reader.onload = function (e) {            
            $('#' + preview).empty();
            $('#' + preview).append('<img src="'+e.target.result+'" width="200" height="200"/>');
        };
        reader.readAsDataURL(input.files[0]);
      }
  }

    $(".images").change(function () {
        //console.log($(this).data('id'));
        filePreview(this,'previewId' + $(this).data('id'), $(this).data('id'));
    });

  });

</script>

@endsection
