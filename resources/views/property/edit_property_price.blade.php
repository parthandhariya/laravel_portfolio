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
          <div class="col-md-9">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mr-3">Edit Property Price Range</h3>
                <a href="{{ route('propertyprice.index') }}" class="btn btn-secondary">{{ "Go Back" }}</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('propertyprice.update',$propertyPrice->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body"> 
                  <div class="row">                    
                      <div class="col-md-5 form-group">                        
                        <input type="number" class="form-control" id="minPrice" name="min_price" min="0" max="999999999999999" step="1" value="{{ $propertyPrice->min_price }}" placeholder="Min Price" required="">
                      </div>

                      <div class="col-md-5 form-group">                        
                        <input type="number" class="form-control" id="maxPrice" name="max_price" min="0" max="999999999999999" step="1" value="{{ $propertyPrice->max_price }}" placeholder="Max Price" required="">
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

    

    
  </div>

@endsection
  <!-- /.content-wrapper -->
