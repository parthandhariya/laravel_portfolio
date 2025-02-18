
@php
	$count = 0;	
@endphp

	@foreach($data as $key => $value)

		@php
			$propertyWiseCount = 0;	
			$count = 1;
		@endphp

		<div class="row">
			<div class="w-100">

				
				<div class="property-address col-md-1">
					<address class="auto-break">
						<b>Type:</b>
						{{ $value->propertyOption->option_name ?? "--" }}
					</address>
				</div>

				<div class="property-address col-md-1">
					<p class="auto-break">
						<b>Price:</b>						
						<span>{{ '₹' . number_format($value->axat_price, 2, '.', ',') }}</span>
					</p>
				</div>

				<div class="property-address col-md-2">
					<address class="auto-break">
						<b>Title:</b>
						{{ $value->title ?? "--" }}
					</address>
				</div>

				<div class="property-address col-md-3">
					<address class="auto-break">
						<b>Address:</b>
						{{ $value->address_line1 ?? "--" }}
						{{ $value->address_line2 ?? "" }}
						{{ $value->address_line3 ?? "" }}
					</address>
				</div>

				<div class="property-address col-md-1">
					<p class="auto-break">
						<b>State:</b>						
						<span>{{ $value->state->name ?? "--" }}</span>
					</p>
				</div>

				<div class="property-address col-md-1">
					<p class="auto-break">
						<b>City:</b>						
						<span>{{ $value->city->city ?? "--" }}</span>
					</p>
				</div>
				
				
			</div>
										
		{{-- <div class="row col-md-12"> --}}
											
		@foreach($value->propertyDetail as $k => $v)
																
			@if(!is_null($v->property_image))
				
				@php
					$count = 1;
					$propertyWiseCount++;						
				@endphp

				
				
				<div class="col-md-3 mt-5 mb-3">					
					<a href="{{ $v->property_image }}" data-lightbox="image-set" width="1000">							
						<img src="{{ $v->property_image }}" alt="" width="250" height="250">
					</a>				
				</div>

				
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
	<div class="alert alert-danger p-4 col-md-10 alert-message" data-dismiss="alert" aria-label="Close" style="cursor: pointer;">
		<strong>Alert !</strong> No matching data found.
  	</div>
@endif