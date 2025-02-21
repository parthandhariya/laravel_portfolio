<form method="POST" action="{{ route('savefooterdetail') }}">
    @csrf
    <input type="hidden" name="footer_id" value="{{ $footerDetail->id }}"/>                  
    <div class="row">                  
        <div class="col-3">                                            
            @for($fl = 1; $fl <= 4; $fl++)
                
                @php
                    $lineColumn = "footer_line".$fl;                    
                @endphp
                <div class="form-group">
                    <input type="text" name="footer_line{{ $fl }}" value="{{ $footerDetail->$lineColumn }}" class="form-control" placeholder="Footer Line{{ $fl }}" />
                </div>
            @endfor
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>                  
    </div>                 
</form>