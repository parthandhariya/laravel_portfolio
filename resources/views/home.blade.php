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
            {{-- <h1 class="m-0">Dashboard</h1> --}}
            <h1 class="m-0 text-red mb-3">Note About How to Use this Website</h1>
            <dl>
              <dt>Pages</dt>
              <dd>- Enter Page Name (you can create maximum FOUR pages)</dd>
              <dt>Theme Options (Theme Design)</dt>
              <dd>- Choose Slider Image (you can create maximum THREE Slider Images)</dd>
              <dt>Property Detail</dt>
              <dd>- Category (Add New Category)</dd>
              <dd>- Property Price (Add Min & Max Price)</dd>
              <dd>- List (Add New Property) (Enter all property detail) (By Enabling Google Location, you can view Google Map on frontend)</dd>
              <dd>- After Adding Property Detail, you can add property images from proprety Action Column</dd>
              <dt>All this Changes will affect on Preview Website So, Refesh the page and select specific search Option, and then Press Search Button</dt>
            </dl> 
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
