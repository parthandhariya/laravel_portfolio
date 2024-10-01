@foreach($data as $key => $value)

	@foreach($value->propertyDetail as $k => $v)

		@if(is_null($v->property_image))

			@continue

		@endif

		<div class="col-md-3 mt-5">

			<img src="{{ $v->property_image }}" alt="" width="250" height="250">
	
		</div>

	@endforeach

@endforeach