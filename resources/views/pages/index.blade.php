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
          <div class="modal fade" id="modal_page_delete">
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
                <h3 class="card-title mb-0 mr-2">Pages</h3>
                {{-- <span class="text-red">(Pages will only be shown in Preview Website, Detail developement is Pending)</span> --}}
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('pages.store') }}">
                @csrf
                <div class="card-body"> 
                  <div class="row">
                    <div class="col-md-3 form-group">
                      <label for="Name">Page Name <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="name" id="Name" placeholder="Name" required="">
                    </div>
                    <div class="col-md-3 form-group">
                      <label for="Name">Parent Page <span class="text-red">*</span></label>
                      <select class="form-control" name="parent_with_level">
                        <option value="{{ implode(',',[0,-1]) }}">------- ROOT -------</option>
                        {{-- @foreach($pages as $k => $v)
                          <option value="{{ implode(',', [$v->id,$v->level]) }}">{{ $v->name }}</option>
                        @endforeach --}}
                      </select>
                    </div>
                    <div class="col-md-3 form-group">
                      <label for="Name">Page Link <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="page_link" id="page_link" placeholder="Page Link" required="">
                    </div>
                    <div class="col-md-2 form-group">
                      <label>Status <span class="text-red">*</span></label>
                      <select class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>                      
                      </select>
                    </div>
                    <div class="col-md-1 mt-auto form-group">                      
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

    <div class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">

              @if(count($pages) > 0)
                <div class="card-header text-right">
                  {{-- <h3 class="card-title">Pages</h3> --}}
                  <a href="javascript:;" class="btn btn-danger" id="btn_reset_pages">Reset Pages</a>
                </div>
              @endif

              <div class="card-body">
                {{-- <div class="row mb-4">
                  <div class="col-md-12">
                    <div class="col-md-3 pl-0">
                      <input type="text" name="filter_page_link" value="" class="filter_page_link form-control" placeholder="Search Page Link">
                    </div>

                    <div class="col-md-3">
                      
                    </div>
                  </div>
                </div> --}}
                <div class="table-responsive">

                  <table class="table table-bordered page_datatable">
                      <thead>
                          <tr>
                              <th>ID</th>
                              {{-- <th>User</th> --}}
                              <th>Page Name</th>
                              <th>Parent Pages</th>
                              <th>Status</th>
                              <th>Page Link</th>
                              <th>Created</th>
                              <th>Last Modified</th>
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

    /*drawCallback: function(settings) {
      var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
      pagination.toggle(this.api().page.info().pages > 1);
    }*/

    var table = $('.page_datatable').DataTable({

        processing: true,
        serverSide: true,        
        
        ajax: {
               url: "{{ route('pages.list') }}",
               data: function (d) {
                   d.page_link = $('.page_link').val()
                       /*d.search = $('input[type="search"]').val()*/
               },
           },        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            /*{data: 'user', name: 'user'},*/
            {data: 'name', name: 'name'},
            {data: 'parent_id', name: 'parent_id'},
            {data: 'status', name: 'status'},
            {data: 'page_link', name: 'page_link'},
            {data: 'created', name: 'created'},            
            {data: 'last_modified', name: 'last_modified'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        drawCallback: function(settings) {          
          var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
          pagination.toggle(this.api().page.info().pages > 1);
        },      
    });

    $(document).on('keyup',".filter_page_link",function(){
        table.draw();           
    });

  });

$(document).ready(function(){
  $(document).on("click","#btn_reset_pages",function(){

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

            window.location.href = "{{ route('resetpages') }}";
                    
          }
    });
    
  });  
});

</script>

@endsection
