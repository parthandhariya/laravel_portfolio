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
                <h3 class="card-title mr-3">Edit Property Category</h3>
                <a href="{{ route('propertycategory.index') }}" class="btn btn-secondary">{{ "Go Back" }}</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('propertycategory.update',$category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body"> 
                  <div class="row">                    
                      <div class="col-9 form-group">                        
                        <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" placeholder="Category Name" required="">
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
