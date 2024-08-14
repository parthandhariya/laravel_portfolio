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
                <h3 class="card-title">Add Property</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('property.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body"> 
                  <div class="row">                    
                      <div class="col-6 form-group">                        
                        <input type="text" class="form-control" name="title" id="title" placeholder="Property Title" required="">
                      </div>
                  </div>

                  <div class="row">                    
                      <div class="col-6 form-group">                        
                        <select name="option_id" class="form-control">
                          @foreach($propertyOption as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>

                  <div class="row">                    
                      <div class="col-6 form-group">                        
                        <input type="text" class="form-control" name="price" id="price" placeholder="Property Price" required="">
                      </div>
                  </div>

                  <div class="row">                    
                      <div class="col-6 form-group">                        
                        <textarea class="form-control" rows="5" name="description" placeholder="Property Description" required=""></textarea>
                      </div>
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

    

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <div>

                  <table class="table table-bordered property_datatable" id="tableProperty">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Option</th>
                              <th>Price</th>
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

    var table = $('.property_datatable').DataTable({

        processing: true,
        serverSide: true,        
        ajax: "{{ route('property.list') }}",        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'title', name: 'title'},
            {data: 'option_id', name: 'option_id'},
            {data: 'price', name: 'price'},
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
