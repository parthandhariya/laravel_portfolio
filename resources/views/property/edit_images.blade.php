@extends('layouts.app')

@section('style')

<style type="text/css">
  
  .large-checkbox {
    transform: scale(1.5); /* Increase the size of the checkbox */
    margin-right: 10px; /* Optional: adjust spacing between checkbox and label */
    cursor: pointer;
  }

  .custom-img-thumbnail{
    max-height: 270px;
  }

</style>

@endsection

@php
  $blankImageFlag = 0;
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
                 <a class="mr-3">Add Property Images</a>
                 <span class="text-red">(Maximum six Images and Maximum size 2MB Per Image are allowed)</span>
                 
                 <a href="{{ route('property.list.view') }}" class="btn btn-secondary">{{ "Go Back" }}</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                            
              <form method="post" action="{{ route('deletepropertyimage') }}" id="frmImageId">
                  @csrf
                  <input type="hidden" name="imageId" id="imageId" value="">
              </form>
              
              <form method="post" action="{{ route('updatepropertyimage') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="propertyId" value="{{ $propertyImages[0]->property_id }}">

                <div class="card-body"> 

                  <div class="row">

                    @foreach($propertyImages as $k => $v)

                        @if(!is_null($v->property_image))
                          
                        <div class="col-md-4 form-group">
                              <div class="text-right">
                                <input type="checkbox" class="form-check-input large-checkbox img-checkbox" data-id="{{ $v->id }}">
                              </div>                              
                              <img src="{{ $v->property_image }}" class="img-thumbnail custom-img-thumbnail" width="100%" height="200" />
                        </div>
                        
                        @else
                        
                            @php 
                              $blankImageFlag = 1;
                            @endphp

                        <div class="col-md-4 form-group">                            
                            <div class="custom-file">
                                <input type="file" name="images[{{ $k }}]" class="custom-file-input images" data-id="{{ $v->id }}" accept="image/*">
                                <label class="custom-file-label" for="exampleInputFile">Choose Property Image {{ $k + 1 }}</label>
                            </div>
                            <div class="mt-3" id="{{ 'previewId'.$v->id }}">
                            </div>
                        </div>

                        @endif
                        
                    @endforeach
                    
                  </div>

                  
                  <div class="row">
                      @if($blankImageFlag == 1)
                      <div class="col-auto mt-auto form-group">                        
                          <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                      @endif
                      <div class="col-auto mt-auto form-group d-none" id="id-container">
                          <button type="button" class="btn btn-danger" id="btn-delete-image">Delete</button>
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
            $('#' + preview).append('<img src="'+e.target.result+'" class="img-thumbnail" width="100%" height="200"/>');
        };
        reader.readAsDataURL(input.files[0]);
      }
  }

    $(".images").change(function () {
        //console.log($(this).data('id'));
        filePreview(this,'previewId' + $(this).data('id'), $(this).data('id'));
    });


    var idArray = [];

    $(document).on("change",".img-checkbox",function(){
        var ischecked= $(this).is(':checked');
        if(!ischecked){
          idArray.pop($(this).data('id'));
        }else{
          idArray.push($(this).data('id'));
        }
        
        if(idArray.length === 0)
        {
          $("#id-container").addClass('d-none');      
        }

        if(idArray.length > 0)
        {
          $("#id-container").removeClass('d-none');          
        }       
    })

    $(document).on("click","#btn-delete-image",function(){
        
        $("#imageId").val(idArray.join(","));
        
        $("#frmImageId").submit();        
    });

  });

</script>

@endsection
