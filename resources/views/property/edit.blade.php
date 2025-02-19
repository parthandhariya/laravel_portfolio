@extends('layouts.app')

@section('style')

@endsection
{{-- @dd($propertyState) --}}
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
                <a class="mr-3">Update Property Detail</a>
                <a href="{{ route('property.list.view') }}" class="btn btn-secondary">{{ "Go Back" }}</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('property.update',$property->id) }}" id="frmSaveProperty">
                @csrf
                @method('PUT')
                <input type="hidden" name="latitude" id="latitude" value="{{ $property->latitude }}"/>
                <input type="hidden" name="longitude" id="longitude" value="{{ $property->longitude }}"/>

                <div class="card-body"> 

                  <div class="row">                    
                      <div class="col-4 form-group">
                        <label for="title">Title <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $property->title }}" placeholder="Property Title"  required>
                      </div>
                                      
                      <div class="col-4 form-group">
                      <label for="title">Type <span class="text-red">*</span></label>                        
                        <select name="option_id" class="form-control">
                          @foreach($propertyOption as $key => $value)
                            <option value="{{ $key }}" {{ ($property->propertyOption->id == $key) ? 'selected' : '' }}>{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                                    
                      <div class="col-4 form-group">
                      <label for="title">Category <span class="text-red">*</span></label>                        
                        <select name="category_id" class="form-control"  required>
                          @foreach($propertyCategory as $key => $value)
                            <option value="{{ $key }}" {{ ($property->propertyCategory->id == $key) ? 'selected' : '' }}>{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                                    
                      <div class="col-4 form-group">
                      <label for="title">Price Range<span class="text-red">*</span></label>                        
                        <select name="price_id" class="form-control"  required>
                          @foreach($propertyPrice as $key => $value)
                            <option value="{{ $key }}" {{ ($property->propertyPrice->id == $key) ? 'selected' : '' }}>{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                  

                      <div class="col-4 form-group">
                        <label for="title">Actual Price <span class="text-red">*</span></label>
                        <input type="number" class="form-control" name="axat_price" id="axat_price" value="{{ $property->axat_price }}" placeholder="Actual Price" required>
                      </div>
                  </div>

                  <div class="row">

                      <div class="col-4 form-group">
                        <label for="address_line1">Address Line1 <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="address_line1" id="address_line1" value="{{ $property->address_line1 }}" placeholder="Address Line1" required>
                      </div>

                      <div class="col-4 form-group">
                        <label for="address_line2">Address Line2 </label>
                        <input type="text" class="form-control" name="address_line2" id="address_line2" value="{{ $property->address_line2 }}" placeholder="Address Line2">
                      </div>

                      <div class="col-4 form-group">
                        <label for="address_line3">Address Line3 </label>
                        <input type="text" class="form-control" name="address_line3" id="address_line3"  value="{{ $property->address_line3 }}" placeholder="Address Line3">
                      </div>

                      <div class="col-4 form-group">
                        <label>State <span class="text-red">*</span></label>
                        <select class="form-control select2" name="state_id" id="state_id" style="width: 100%;" required>
                          <option selected="selected" value="{{ NULL }}">---Select State---</option>                          
                          @foreach($propertyState as $key => $value)                            
                            <option value="{{ $key }}" {{ $key == $property->state_id ? 'selected' : '' }}> {{ ucwords(strtolower($value)) }} </option>
                          @endforeach
                        </select>
                      </div>

                      <div class="col-4 form-group">
                        <label>City <span class="text-red">*</span></label>
                        <select class="form-control select2" name="city_id" id="city_id" style="width: 100%;" required>
                          <option selected="selected" value="{{ NULL }}">---Select City---</option>
                          @foreach($propertyCity as $key => $value)
                            <option value="{{ $key }}" {{ $key == $property->city_id ? 'selected' : '' }}> {{ ucwords(strtolower($value)) }} </option>
                          @endforeach                                                
                        </select>
                      </div>

                      <div class="col-4 form-group mt-4">                        
                        <textarea class="form-control" name="description" placeholder="Property Description">{{ $property->description }}</textarea>
                      </div>

                  </div>

                  <div class="row">
                      <div class="col-md-4 ml-3 pl-4 form-group">                        
                        <input type="checkbox" id="load-api" class="form-check-input"/> <label class="form-check-label" for="load-api"> Update Google Location </label>
                      </div>                    
                      <div class="col-8">                        
                        <input type="text" class="form-control"  id="autocomplete" placeholder="Enter a location">                        
                      </div>
                      <div class="col-12 form-group">
                        <span class="text-green" id="location-error-message"></span>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-auto mt-auto form-group">                      
                        <button type="submit" class="btn btn-primary" id="btnsubmit">Save</button>
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

<script>

 $(document).ready(function(){
 
  let googleApiLoaded = false;
  let isPlaceSelected = false;
  $("#autocomplete").hide();

    $('#load-api').change(function() {
        if(this.checked) {
         
          // Check if API is already loaded
          
          if (googleApiLoaded) {              
              $("#autocomplete").show();
              //$("#btnsubmit").show();
              return;
          }

          // Dynamically load the Google Places API script
          const script = document.createElement('script');
          
          script.src = 'https://maps.gomaps.pro/maps/api/js?key=AlzaSyrNlkOdl0-1B20KiC-KT8k-IgYGdwhJOpd&libraries=places';
          script.async = true;
          script.defer = true;

          script.onload = function () {
              googleApiLoaded = true; // Set flag to true
              initializeAutocomplete(); // Initialize the autocomplete feature              
          };

          script.onerror = function () {
              alert('Failed to load Google Places API.');
          };

          document.head.appendChild(script);
          $("#autocomplete").show();
          //$("#btnsubmit").show();

        }else{

          // googleApiLoaded = false;
          isPlaceSelected = false;
          $("#autocomplete").val("").hide();          
          $('#location-error-message').text('');

        }      
    });    

  // Function to initialize Autocomplete
    function initializeAutocomplete() {
        const autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'));
        componentRestrictions: { country: 'IN' } // Restrict to India      
            
        autocomplete.addListener('place_changed', function () {
            const place = autocomplete.getPlace();
            
            if (place && place.geometry) {
                                
                $("#latitude").val(place.geometry.location.lat());
                $("#longitude").val(place.geometry.location.lng());                
                $('#location-error-message').text('');
                isPlaceSelected = true;
                //$("#btnsubmit").show();
                
            } else { 
              isPlaceSelected = false;                                             
            }          
        });
                        
    }

    $('#frmSaveProperty').on('submit', function (e) {
      //alert($('#load-api').is(':checked'));
        if ($('#load-api').is(':checked')) {
          if(!isPlaceSelected){          
            e.preventDefault(); // Prevent form submission                          
            $('#location-error-message').text('Please wait..');
          }
        } 
    });

    //Get State wise cities
    $(document).on("select2:select","#state_id",function(){
        var state_id = $(this).val();
        var option = '';
        $("#city_id").empty();
        $.ajax({
          url: '{{ route("getcityfromstate") }}',
          data: { _token: $('meta[name="csrf-token"]').attr('content'), state_id:state_id },
          type: 'POST',
          success: function(res){
            option += '<option value = ' + null + '>---Select City---</option>';
            $.each(res, function(index,value){
              option += '<option value = '+ index +'>'+ value +'</option>';
            })
            
            $("#city_id").append(option);           
          }

        });
    });

})

</script>

@endsection
