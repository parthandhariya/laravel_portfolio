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
              <div class="card-header">
                <h3 class="card-title mb-0"><a href="{{ route('property.index') }}" class="btn btn-secondary">Add New Property</a></h3>
              </div>
              <div class="card-body">

                <div class="col-md-12">
                  <div class="row mb-4">                  
                    <div class="col-md-3 pl-0 mb-2">
                      <select class="form-control" name="option_id" id="option_id">
                        <option value="">---Select Option---</option>
                        @foreach($propertyOption as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-3 pl-0 mb-2">
                      <select class="form-control" name="category_id" id="category_id">
                        <option value="">---Select Category---</option>
                        @foreach($propertyCategory as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-3 pl-0 mb-2">
                      <select class="form-control" name="price_id" id="price_id">
                        <option value="">---Select Price---</option>
                        @foreach($propertyPrice as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-3">
                      
                    </div>
                  </div>
                </div>

                <div class="table-responsive">

                  <table class="table table-bordered property_datatable" id="tableProperty">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Option</th>
                              <th>Category</th>
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
        ajax: { 
            url: "{{ route('property.list') }}",
            data:function(d){
              d.option_id = $("#option_id").val();
              d.category_id = $("#category_id").val();
              d.price_id = $("#price_id").val();
            }
          },        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'title', name: 'title'},
            {data: 'option_id', name: 'option_id'},
            {data: 'category_id', name: 'category_id'},
            {data: 'price_id', name: 'price_id'},
            {data: 'created', name: 'created'},            
            {data: 'last_modified', name: 'last_modified'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        drawCallback: function(settings) {          
          var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
          pagination.toggle(this.api().page.info().pages > 1);
        }
      
    });

    $('#option_id').on('change', function() {
        table.draw();
    });

    $('#category_id').on('change', function() {
        table.draw();
    });

    $('#price_id').on('change', function() {
        table.draw();
    });

    
  });

  
  

</script>

@endsection