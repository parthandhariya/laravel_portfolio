@foreach($data as $key => $value)

    @if(is_null($value->property_image))

        @continue

    @endif

    <div class="p-3">
        <div class="text-right">
            <input type="checkbox" class="form-check-input large-checkbox img-checkbox" data-id="{{ $value->id }}" style="transform: scale(1.3);">
        </div>

        <a href="{{ $value->property_image }}" data-lightbox="image-set" width="1000">            
            <img src="{{ $value->property_image }}" alt="" width="250" height="250">
        </a>

    </div>	

@endforeach