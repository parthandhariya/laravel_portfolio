@extends('layouts.app')

@section('style')

@endsection

<!-- Content Wrapper. Contains page content -->
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <!-- The Modal (Delete Confirmation)-->
        <div class="modal fade" id="modal_themeoption_delete">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Delete Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                Are you sure for delete.?
              </div>
              
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="modal_btn_delete" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              </div>
              
            </div>
          </div>
        </div>
        <!-- End Modal -->
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
                <h3 class="card-title">Theme Option</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('themeoption.store') }}" enctype="multipart/form-data">
                @csrf
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
                          
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="col-auto form-group">                        
                        <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site Name">
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
                <div>

                  <table class="table table-bordered themeoption_datatable" id="tableOption">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Favicon</th>
                              <th>Logo</th>
                              <th>Name</th>
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
  </div>

@endsection
  <!-- /.content-wrapper -->

@section('script')


<script type="text/javascript">
  $(function () {

    var table = $('.themeoption_datatable').DataTable({

        processing: true,
        serverSide: true,        
        ajax: "{{ route('themeoption.list') }}",        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'site_favicon', name: 'site_favicon'},
            {data: 'site_logo', name: 'site_logo'},
            {data: 'site_name', name: 'site_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        drawCallback: function(settings) {          
          var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
          pagination.toggle(this.api().page.info().pages > 1);
        }
      
    });

    
  });

  
  $("#tableOption").on("click",".a-fancybox",function(){          
       Fancybox.bind('img', {}); 
  });
  
  /*$.noConflict();*/


$(document).ready(function(){
  $(document).on("click","#btn_delete",function(){

    var id = $(this).data('id');

    $("#modal_themeoption_delete").modal();

    $(document).on("click","#modal_btn_delete",function(){

        var baseUrl = "{{ url('/') }}";        
        var action = baseUrl + "/themeoption/" + id;
        $("#frm_submit").attr('action',action).submit();

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

  $(document).on("click","#btn_delete",function(){

    var id = $(this).data('id');

    $("#modal_themeoption_delete").modal();

    $(document).on("click","#modal_btn_delete",function(){

        var baseUrl = "{{ url('admin/') }}";        
        var action = baseUrl + "/themeoption/" + id;
        $("#frm_submit").attr('action',action).submit();

    });
    
  }); 

});

</script>

@endsection
