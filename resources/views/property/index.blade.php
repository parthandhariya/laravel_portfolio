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
                <a class="mr-3">Add Property Detail</a>                
                <a href="{{ route('property.list.view') }}" class="btn btn-secondary">{{ "Go Back" }}</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('property.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body"> 
                  <div class="row">                    
                      <div class="col-12 form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Property Title">
                      </div>
                  </div>

                  <div class="row">                    
                      <div class="col-12 form-group">
                      <label for="title">Type <span class="text-red">*</span></label>                        
                        <select name="option_id" class="form-control">
                          @foreach($propertyOption as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>

                  <div class="row">                    
                      <div class="col-12 form-group">
                      <label for="title">Category <span class="text-red">*</label>                        
                        <select name="category_id" class="form-control">
                          <option value="">---Select Category---</option>
                          @foreach($propertyCategory as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>

                  <div class="row">                    
                      <div class="col-12 form-group">
                      <label for="title">Price <span class="text-red">*</label>                        
                        <select name="price_id" class="form-control">
                          <option value="">---Select Price---</option>
                          @foreach($propertyPrice as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>

                  {{-- <div class="row">                    
                      <div class="col-12 form-group">                        
                        <input type="number" class="form-control" name="price_id" id="price_id" placeholder="Property Price" required="">
                      </div>
                  </div> --}}

                  <div class="row">                    
                      <div class="col-12 form-group">                        
                        <textarea class="form-control" rows="5" name="description" placeholder="Property Description"></textarea>
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

    


  </div>

@endsection
  <!-- /.content-wrapper -->

@section('script')

@endsection
