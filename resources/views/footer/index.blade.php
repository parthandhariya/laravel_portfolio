@extends('layouts.app')

@section('style')

<style>
  fieldset {
    border: 2px solid #ccc;
    padding: 10px;
  }

  legend {
    float: none;
    width: auto;
    font-weight: bold;
    font-size: larger;
    padding: 0 5px;    
  }
</style>




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
                
                @if($footerHeadings->count() == 0)
                  <form method="post" action="{{ route('createfooter') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Create Footer</button>
                  </form>
                @else
                  <h3 class="card-title mb-0">Footer Detail</h3>  
                @endif
              </div>

              <div class="card-body">                  
                
                  <form method="post" action="{{ route('savefooterheading') }}">
                    @csrf
                    <div class="row">
                      @foreach ($footerHeadings as $key => $value)
                        <div class="col-auto form-group">
                          <div class="mb-1">Heading {{ $key + 1 }}</div>
                          <input type="text" value="{{ $value->footer_heading }}" name="footerHeading[{{ $value->id }}]" class="form-control" placeholder="Footer Heading {{ $key + 1  }}" />
                        </div>
                      @endforeach
                      
                      @if($footerHeadings->count() != 0)
                        <div class="col-auto mt-auto form-group">
                          <input type="submit" value="Save" class="btn btn-primary"/>
                        </div>
                      @endif
                    </div>
                  </form>
                                            
                @if($footerHeadings->count() != 0)
                  
                  <div class="row">                  
                    <div class="col-md-3">
                      <div class="form-group">
                          <select name="footer_id" id="footer_id" class="form-control">
                            <option value="">-- Select Footer Heading --</option>
                            @foreach($footerHeadings as $key => $value)
                              @if(is_null($value->footer_heading) || $value->footer_heading == "")
                                @continue
                              @endif
                              <option value="{{ $value->id }}">{{ ucwords($value->footer_heading) }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>                    
                  </div>

              <div id="footerDetail">
                
              </div>

                @endif
                                
              </div>
              
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

    $(document).on("change","#footer_id",function(){

      if($(this).val() == "" || $(this).val() == null)
      {
        $("#footerDetail").empty();
        return false;
      }

      $("#footerDetail").empty();
      var footer_id = $(this).val();
     
      $.ajax({
          url: "{{ route('viewfooterdetail') }}",
          type: "POST",
          data: {'_token':'{{ csrf_token() }}',footer_id:footer_id},
          dataType: "text",
          success: function(res) {
              //console.log("Server Response:", res);
              $("#footerDetail").append(res);
          },
          error: function (xhr) {
            if (xhr.status === 401 || xhr.status === 419) {  // Unauthorized or CSRF Token Mismatch
                
                location.reload();
            }
          }
      });

    });

  });

</script>

@endsection
