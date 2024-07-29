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

    <form method="post" action="{{ route('blockunblockuser') }}" id="frmBlockUnblockUser">
      @csrf
      <input type="hidden" name="id" id="blockUnblockUserId" value="">
      <input type="hidden" name="status" id="blockUnblockStatus" value="">
    </form>


    <form method="post" action="{{ route('resetuserpassword') }}" id="frmResetPassword">
      @csrf
      <input type="hidden" name="id" id="resetPasswordId" value="">      
    </form>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <div>

                  <table class="table table-bordered allusers_datatable" id="tableUsers">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Gender</th>
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

    var table = $('.allusers_datatable').DataTable({
        //console.log(table);
        processing: true,
        serverSide: true,        
        ajax: "{{ route('allusers.list') }}",        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'gender', name: 'gender'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        drawCallback: function(settings) {          
          var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
          pagination.toggle(this.api().page.info().pages > 1);
        }
      
    });

    
  });


  $(document).ready(function() {
  
    // Start blockUnblock User
    $("#tableUsers").on('click', '.btn-blockunblock-user', function() {      
      
      $("#blockUnblockUserId").val($(this).data('id'));
      $("#blockUnblockStatus").val($(this).data('status'));

      $("#frmBlockUnblockUser").submit();

    });
    // End blockUnblock User


    // Start resetUser Password
    $("#tableUsers").on('click', '.btn-reset-password', function() {      
      
      $("#resetPasswordId").val($(this).data('id'));
      
      $("#frmResetPassword").submit();

    });
    // End resetUser Password


  });


</script>

@endsection
