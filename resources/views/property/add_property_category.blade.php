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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mb-0">Add Property Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('propertycategory.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body"> 
                  <div class="row">                    
                      <div class="col-9 form-group">                        
                        <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" required="">
                      </div>
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

    

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <div class="table-responsive">

                  <table class="table table-bordered property_datatable" id="tablePropertyCategory">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>name</th>                              
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

    var table = $('#tablePropertyCategory').DataTable({

        processing: true,
        serverSide: true,        
        ajax: "{{ route('propertycategory.list') }}",        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'name', name: 'name'},            
            {data: 'created', name: 'created'},            
            {data: 'last_modified', name: 'last_modified'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        drawCallback: function(settings) {          
          var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
          pagination.toggle(this.api().page.info().pages > 1);
        }
      
    });

    
  });

</script>

@endsection
