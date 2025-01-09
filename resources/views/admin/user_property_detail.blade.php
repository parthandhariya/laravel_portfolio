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
    
  <form method="post" action="{{ route('admin.approveimages') }}" id="frmImageId">
    @csrf
    <input type="hidden" name="imageId" id="imageId" value="">
  </form>

  <form method="post" action="{{ route('admin.rejectimages') }}" id="frmRejectImageId">
    @csrf
    <input type="hidden" name="imageId" id="reject-imageId" value="">
  </form>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <div class="row pl-3">
                    <div class="col-md-4 pl-0 mr-3">
                        <select class="form-control" name="property_id" id="property_id">
                        <option value="">---Select Property---</option>
                        @foreach($property as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="mt-auto pr-3">
                        <button type="button" class="btn btn-primary" id="btn_view_images">View Detail</button>                      
                    </div>
                    <div class="mt-auto pr-3 d-none id-container">
                      <button type="button" class="btn btn-success" id="btn-approve-image">Approve Image</button>                      
                    </div>
                    <div class="mt-auto pr-3 d-none id-container">
                      <button type="button" class="btn btn-danger" id="btn-reject-image">Reject Image</button>                      
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <div class="row" id="filterImages">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
  <!-- /.content-wrapper -->

@section('script')


<script type="text/javascript">
  
  $(document).ready(function(){

        var idArray = [];

        $(document).on("click","#btn_view_images",function(){
          
          var property_id = $("#property_id").val();          

          idArray = [];
          $("#imageId").val("");
          $("#reject-imageId").val("");
          $("#filterImages").empty();

          $.ajax({
              url: "{{ route('admin.filterimage') }}",
              method: "post",              
              dataType: 'text',
              data: {
                "_token": "{{ csrf_token() }}",                
                'property_id':property_id,                
              },
              success: function(res)
              {
                if(res == ""){
                  res = "<h5 class='text-red col-md-12'>No image found for this property</h5>";
                }
                $("#filterImages").append(res);
              }
          });

        });    

    $(document).on("change",".img-checkbox",function(){

        var ischecked= $(this).is(':checked');
        if(!ischecked){
          idArray.pop($(this).data('id'));
        }else{
          idArray.push($(this).data('id'));
        }
        
        if(idArray.length === 0)
        {
          $(".id-container").addClass('d-none');      
        }

        if(idArray.length > 0)
        {
          $(".id-container").removeClass('d-none');          
        }       
    })

    $(document).on("click","#btn-approve-image",function(){
        
        $("#imageId").val(idArray.join(","));
        
        $("#frmImageId").submit();        
    });

    $(document).on("click","#btn-reject-image",function(){
        
        $("#reject-imageId").val(idArray.join(","));
        
        $("#frmRejectImageId").submit();        
    });

  });

</script>

@endsection
