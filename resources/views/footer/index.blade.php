@extends('layouts.app')

@section('style')

{{-- <style>
td.dt-control {
    background: url('https://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.dt-control {
    background: url('https://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
}
</style> --}}




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
                <h3 class="card-title mb-0">Footer Detail</h3>
              </div>

              <div class="card-body">

                <form method="get" action="{{ route('viewfooterdetail') }}">
                  
                  <div class="row">                  
                    <div class="col-md-9">
                      <div class="form-group">
                          <select name="footer_heading_id" class="form-control">
                            <option value="">-- Select Footer Heading --</option>
                            @foreach($footerHeading as $key => $value)
                              <option value="{{ $value->id }}" {{ in_array($footerDetail->footer_id, $value->toArray()) ? 'selected' : '' }}>{{ ucwords($value->footer_heading) }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="col-md-3 mt-auto">
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">View</button>
                      </div>
                    </div>
                  </div>

                </form>


                <form method="post" action="{{ route('updatefooter') }}">
                  
                  @csrf
                  
                  <input type="hidden" name="user_id" value="{{ $footerDetail->user_id }}">
                  <input type="hidden" name="footer_id" value="{{ $footerDetail->footer_id }}">        
                          


                            
                            <div class="row">                  
                              <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="{{ 'line1' }}" value="{{ (!is_null($footerDetail->line1)) ? $footerDetail->line1 : '' }}" class="form-control" placeholder="{{ 'Fooer Line 1' }}">
                                </div>
                              </div>

                              <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="{{ 'line2' }}" value="{{ (!is_null($footerDetail->line2)) ? $footerDetail->line2 : '' }}" class="form-control" placeholder="{{ 'Fooer Line 2' }}">
                                </div>
                              </div>

                              <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="{{ 'line3' }}" value="{{ (!is_null($footerDetail->line3)) ? $footerDetail->line3 : '' }}" class="form-control" placeholder="{{ 'Fooer Line 3' }}">
                                </div>
                              </div>

                              <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="{{ 'line4' }}" value="{{ (!is_null($footerDetail->line4)) ? $footerDetail->line4 : '' }}" class="form-control" placeholder="{{ 'Fooer Line 4' }}">
                                </div>
                              </div>

                              <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="{{ 'line5' }}" value="{{ (!is_null($footerDetail->line5)) ? $footerDetail->line5 : '' }}" class="form-control" placeholder="{{ 'Fooer Line 5' }}">
                                </div>
                              </div>

                              <div class="col-md-9">
                                <div class="form-group">
                                  <input type="submit" value="Save" class="btn btn-primary">
                                </div>
                              </div>
                            </div>

                          
                          
                      

                </form>


              </div>
              
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


<script type="text/javascript">
  $(function () {

    var table = $('#tableOption').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('themeoption.list') }}",        
        columns: [
             /*{
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },*/
            
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            /*{data: 'user', name: 'user'},*/
            {data: 'site_favicon', name: 'site_favicon'},
            {data: 'site_logo', name: 'site_logo'},
            {data: 'site_name', name: 'site_name'},
            {data: 'created', name: 'created'},            
            {data: 'last_modified', name: 'last_modified'},
            {data: 'action', name: 'action', orderable: false, searchable: false},


        ],

        /*order: [[1, 'asc']],*/

        drawCallback: function(settings) {          
          var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
          pagination.toggle(this.api().page.info().pages > 1);
        }
      
    });

    // Add event listener for opening and closing details
    /*$('#tableOption tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });*/

    
  });

  /*function format(d) {
        
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px">' +
            '<tr>' +
                '<td>Site Name:</td>' +
                '<td>' + d.site_name + '</td>' +
            '</tr>' +
            '<tr>' +
                '<td>Created:</td>' +
                '<td>' + d.created + '</td>' +
            '</tr>' +
            '<tr>' +
                '<td>Extra info:</td>' +
                '<td>And any further details here (images etc).</td>' +
            '</tr>' +
        '</table>';
    }*/

  
  $("#tableOption").on("click",".a-fancybox",function(){          
       Fancybox.bind('img', {}); 
  });
  
  /*$.noConflict();*/


</script>

@endsection
