@extends('layouts.app')

@section('style')

@endsection

@php

  $status = ["1" => 'Active', "0" => "Inactive"]  

@endphp


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
                  <a class="mr-3">Edit Page</a>
                  <a href="{{ route('pages.index') }}" class="btn btn-secondary">{{ "Go Back" }}</a>                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('pages.update',$page->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" name="name" id="Name" value="{{ $page->name }}" placeholder="Name" required="">
                    </div>
                    <div class="col-md-3 form-group">
                      <label for="Name">Page</label>
                      <select class="form-control" name="parent_with_level">
                        <option value="{{ implode(',',[0,-1]) }}">------- Root -------</option>
                        @foreach($pages as $k => $v)

                          @if($v->id == $page->id)
                            @continue
                          @endif
                          <option value="{{ implode(',', [$v->id,$v->level]) }}" {{ $v->id == $page->parent_id ? 'selected' : '' }}>{{ $v->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">

                        @foreach($status as $k => $v)
                          <option value="{{ $k }}" {{ $page->status == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                        
                      </select>
                    </div>
                    <div class="col-md-3 mt-auto form-group">
                      <button type="submit" class="btn btn-primary">Update</button>
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
