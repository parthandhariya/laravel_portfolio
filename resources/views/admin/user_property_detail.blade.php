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
    
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <div class="row pl-3">
                    <div class="col-md-4 pl-0">
                        <select class="form-control" name="property_id" id="property_id">
                        <option value="">---Select Property---</option>
                        @foreach($property as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mt-auto">
                        <button type="button" class="btn btn-primary" id="btn_view_images">View Detail</button>
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
        $(document).on("click","#btn_view_images",function(){
          
          var property_id = $("#property_id").val();          

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
      });

</script>

@endsection
