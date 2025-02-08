@extends('layouts.app')

@section('style')

<style>
  .ds-bg-image{
    background-image: url('{{ asset('images/dashboard_background_image/dashboard_bg_image.jpg') }}') !important; 
    background-size: cover;
  }
</style>

@endsection

<!-- Content Wrapper. Contains page content -->
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

@endsection
  <!-- /.content-wrapper -->

@section('script')

@endsection
