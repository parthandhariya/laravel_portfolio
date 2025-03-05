
@php
	$count = 0;	
@endphp

	@foreach($data as $key => $value)

		@php
			$propertyWiseCount = 0;	
			$count = 1;
		@endphp

		<div class="row">
			<div class="w-100 ps-4 pt-4">

				
				<div class="property-address col-md-1">
					<address class="text-black">
						<b>Type:</b>
						</br>
						{{ $value->propertyOption->option_name ?? "--" }}
					</address>
				</div>

				<div class="property-address col-md-1">
					<span class="text-black">
						<b>Price:</b>					
						{{-- <span class="info-value-color">{{ '₹' . number_format($value->axat_price, 2, '.', ',') }}</span> --}}
						<h4 class="info-value-color">{{ '₹' .  formatIndianCurrency($value->axat_price) }}</h4>
					</span>
				</div>

				<div class="property-address col-md-2">
					<address class="text-black">
						<b>Title:</b>
						</br>
						{{ $value->title ?? "--" }}
					</address>
				</div>

				<div class="property-address col-md-3">
					<p class="text-black">
						<b>Location:</b>
						</br>
						<span>{{ $value->address_line1 ?? "--" }}</span>
						<span>{{ $value->address_line2 ?? "" }}</span>
						<span>{{ $value->address_line3 ?? "" }}</span>						
					</p>
				</div>

				<div class="property-address col-md-2">
					<p class="text-black">
						<b>State:</b>						
						</br>
						<span>{{ ucwords(strtolower($value->state->name ?? "")) ?? "--" }}</span>
					</p>
				</div>

				<div class="property-address col-md-1">
					<p class="text-black">
						<b>City:</b>
						</br>						
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