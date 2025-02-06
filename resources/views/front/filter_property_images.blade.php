
@php
	$count = 0;	
@endphp

	@foreach($data as $key => $value)

		@php
			$propertyWiseCount = 0;	
		@endphp

		<div class="row mt-2">
			<div class="d-flex">
				
				<h3 class="me-3">{{ 'Title:' }}</h3>				
				<span><b>{{ $value->title ?? "--" }}</b></span>
				
			</div>
		
			<div class="d-flex">

				<h3 class="me-3">{{ 'Price:' }}</h3>
				<span><b>{{ $value->axat_price ?? "--" }}</b></span>

			</div>
		

		{{-- <div class="row col-md-12"> --}}
											
		@foreach($value->propertyDetail as $k => $v)
																
			@if(!is_null($v->property_image))
				
				@php
					$count = 1;
					$propertyWiseCount++;						
				@endphp

				@if($propertyWiseCount % 6 == 0 || $propertyWiseCount == 0)
					{{-- <div class="row">						 --}}
				@endif
				
					<div class="col-md-3 mt-5">					
						<a href="{{ $v->property_image }}" data-lightbox="image-set" width="1000">							
							<img src="{{ $v->property_image }}" alt="" width="250" height="250">
						</a>				
					</div>

				@if($propertyWiseCount % 6 == 0 || $propertyWiseCount == 0)
					{{-- </div> --}}
				@endif
			@endif
			
		@endforeach

		@if(!is_null($value->latitude) && !is_null($value->longitude))
						
			@php
				$count = 1;			
			@endphp
							
			<div class="row ms-2 mt-2 col-md-12">
				<div class="form-group col-9 mt-5 mb-5">
					<div id="map{{ $value->id }}"></div>
				</div>
			</div>
			<div class="row col-md-12 mb-4">
				<div class="col-12 mt-5">
					<button id="btn_view_map" class="btn btn-primary btn-view-map" data-lat="{{ $value->latitude }}" data-lng="{{ $value->longitude }}" data-mapId="{{ $value->id }}" >View Map</button>
				</div>
			</div>	
							
		@endif

		{{-- @if($key == ($count - 1))
			<div class="row col-md-12 mt-5 form-group">
				<hr style="border-top: 2px doted #000;">
			</div>
		@endif --}}
		{{-- <div> --}}
		</div>
	@endforeach

@if($count == 0)
	<div class="alert alert-danger p-4 col-md-10" data-dismiss="alert" aria-label="Close" style="cursor: pointer;">
		<strong>Alert !</strong> No matching data found.
  	</div>
@endif