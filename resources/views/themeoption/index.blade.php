@extends('layouts.app')

@section('style')

{{-- <style>
td.dt-control {
    background: url('https://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.dt-control {
    background: url('https://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
}
</style> --}}




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

  <form method="post" id="frm_submit">
    @csrf
    @method('DELETE')
  </form>


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mb-0">Theme Option</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('themeoption.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="row">

                  @if($errors->any())
                      {!! implode(' ', $errors->all('<div class="col-3 mr-5 text-red form-group">:message</div>')) !!}
                  @endif
                  
                  </div>
                  <div style="clear:both;"></div>
                  <div class="row">

                    <div>                      
                      <div class="col-auto form-group">
                        <div class="custom-file">
                          <input type="file" name="site_favicon" class="custom-file-input" id="site_favicon" accept="image/*" required="">
                          <label class="custom-file-label" for="exampleInputFile">Choose Favicon Image</label>
                        </div>
                      </div>
                      <div class="col-auto form-group">
                        <div id="site_favicon_preview">
                          
                        </div>
                      </div>
                    </div>

                    <div>                      
                      <div class="col-auto form-group">
                        <div class="custom-file">
                          <input type="file" name="site_logo" class="custom-file-input" id="site_logo" accept="image/*" required="">
                          <label class="custom-file-label" for="exampleInputFile">Choose Site Logo</label>
                        </div>
                      </div>
                      <div class="col-auto form-group">
                        <div id="site_logo_preview">
                          
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="col-auto form-group">                        
                        <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site Name" required="">
                      </div>
                    </div>

                    <div>
                      <div class="col-auto mt-auto form-group">                      
                        <button type="submit" class="btn btn-primary">Save</button>
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

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <div class="table-responsive">

                  <table class="table table-bordered themeoption_datatable" id="tableOption">
                      <thead>
                          <tr>
                              {{-- <th></th> --}}
                              <th>ID</th>
                              {{-- <th>User</th> --}}
                              <th>Favicon</th>
                              <th>Logo</th>
                              <th>Name</th>
                              {{-- <th>Created</th>
                              <th>Last Modified</th> --}}
                              <th width="100px">Action</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- /.banner images -->

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">                
                <a class="mr-3">Select Banner Images</a>
                <form action="{{ route('themeoption.reset.design') }}" method="POST" class="float-right" id="frm_reset_theme_option">
                  @csrf
                  <button type="button" class="btn btn-danger" id="btn_reset_theme_option">Reset</button>
                </form>               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('themeoption.save.design') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="card-body">
                  <div class="row">
                    
                    @if(!is_null($bannerImages) && !empty($bannerImages))

                      @foreach($bannerImages as $key => $value)
                                           
                        <div>
                          {{-- <div class="col-auto form-group">
                            <div class="custom-file">
                              <input type="file" name="banner_images[]" class="custom-file-input banner_image" data-id="banner_image{{ $key }}">
                              <label class="custom-file-label" for="exampleInputFile">{{ "Choose Banner Image" }}</label>
                            </div>
                          </div> --}}
                          <div class="col-auto form-group">
                            <div id="banner_image{{ $key }}">
                              <img src="{{ $value }}" height="250" width="250" />
                            </div>
                          </div>
                        </div>

                      @endforeach

                      @if(count($bannerImages) < $totalBannerImages)

                        @for($totalImage = count($bannerImages);  $totalImage < $totalBannerImages; $totalImage++)
                          
                        <div>
                          <div class="col-auto form-group">
                            <div class="custom-file">
                              <input type="file" name="banner_images[]" class="custom-file-input banner_image" data-id="banner_image{{ $totalImage }}">
                              <label class="custom-file-label" for="exampleInputFile">{{ "Choose Banner Image" }}</label>
                            </div>
                          </div>
                          <div class="col-auto form-group">
                            <div id="banner_image{{ $totalImage }}">
                              {{-- <img src="" height="250" width="250" /> --}}
                            </div>
                          </div>
                        </div>

                        @endfor
                        
                      @endif
                                          
                    @else
                      
                      @for($totalImage = 1;  $totalImage <= $totalBannerImages; $totalImage++)
                        
                      <div>
                        <div class="col-auto form-group">
                          <div class="custom-file">
                            <input type="file" name="banner_images[]" class="custom-file-input banner_image" data-id="banner_image{{ $totalImage }}">
                            <label class="custom-file-label" for="exampleInputFile">{{ "Choose Banner Image" }}</label>
                          </div>
                        </div>
                        <div class="col-auto form-group">
                          <div id="banner_image{{ $totalImage }}">
                            {{-- <img src="" height="250" width="250" /> --}}
                          </div>
                        </div>
                      </div>

                      @endfor                      

                    @endif

                  </div>
                
                  <div class="row mb-4">
                    <div>
                      <div class="col-auto mt-auto form-group">                      
                        <label for="myColor" class="form-label">Menu Background Color</label>
                        <input type="color" name="menu_background" class="form-control form-control-color" id="myColor" value="#CCCCCC" title="Choose a color">
                      </div>
                    </div>
                  </div>

                <div class="row">
                  <div>
                    <div class="col-auto mt-auto form-group">                      
                      <button type="submit" class="btn btn-primary">Save</button>
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

    <!-- /.banner images -->

  </div>

@endsection
  <!-- /.content-wrapper -->

@section('script')


<script type="text/javascript">
  $(function () {

    var table = $('#tableOption').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('themeoption.list') }}",        
        columns: [
             /*{
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },*/
            
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },           
            {data: 'site_favicon', name: 'site_favicon'},
            {data: 'site_logo', name: 'site_logo'},
            {data: 'site_name', name: 'site_name'},          
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ],

        /*order: [[1, 'asc']],*/

        drawCallback: function(settings) {          
          var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
          pagination.toggle(this.api().page.info().pages > 1);
        }
      
    });

    // Add event listener for opening and closing details
    /*$('#tableOption tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });*/

    
  });

  /*function format(d) {
        
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px">' +
            '<tr>' +
                '<td>Site Name:</td>' +
                '<td>' + d.site_name + '</td>' +
            '</tr>' +
            '<tr>' +
                '<td>Created:</td>' +
                '<td>' + d.created + '</td>' +
            '</tr>' +
            '<tr>' +
                '<td>Extra info:</td>' +
                '<td>And any further details here (images etc).</td>' +
            '</tr>' +
        '</table>';
    }*/

  
  $("#tableOption").on("click",".a-fancybox",function(){          
       Fancybox.bind('img', {}); 
  });
  
  /*$.noConflict();*/


$(document).ready(function(){

  $(document).on("click",".btn-delete",function(){

      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {

            var id = $(this).data('id');
            var baseUrl = "{{ url('user/') }}";        
            var action = baseUrl + "/themeoption/" + id;

            $("#frm_submit").attr('action',action).submit();
              
          }
    });
    
  });

  $(document).on("click","#btn_reset_theme_option",function(){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reset it!'
    }).then((result) => {
        if (result.isConfirmed) {         
          $("#frm_reset_theme_option").submit();            
        }
    });

  });

  

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


  function themeOptionFilePreview(input,preview) {
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + preview).empty();
            $('#' + preview).append('<img src="'+e.target.result+'" width="250" height="250"/>');
        };
        reader.readAsDataURL(input.files[0]);
      }
  }

  $(".banner_image").change(function () {        
    themeOptionFilePreview(this, $(this).data("id"));
  });
  
});

</script>

@endsection
