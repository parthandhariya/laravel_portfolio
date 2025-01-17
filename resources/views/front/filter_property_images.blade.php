
@php
	$count = 0;
@endphp

	@foreach($data as $key => $value)

		@foreach($value->propertyDetail as $k => $v)
			
			@if(is_null($v->property_image) || $v->image_status != '1')

				@continue

			@endif
			
			<div class="col-md-3 mt-5">

				@php
					$count = 1;				
				@endphp

				<a href="{{ $v->property_image }}" data-lightbox="image-set" width="1000">
					{{-- <img src="{{ $v->property_image }}" alt="" width="250" height="250"> --}}
					<img src="{{ $v->property_image }}" alt="" width="250" height="250">
				</a>
		
			</div>

		@endforeach

	@endforeach

@if($count == 0)
	<div class="alert alert-danger m-4 p-4 col-md-10" data-dismiss="alert" aria-label="Close" style="cursor: pointer;">
		<strong>Alert !</strong> No matching data found.
  	</div>
@endif