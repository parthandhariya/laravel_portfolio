<form method="POST" action="{{ route('savefooterdetail') }}">
    @csrf
    <fieldset>
        <legend>Footer Line</legend>
        <input type="hidden" name="footer_id" value="{{ $footerDetail->id }}"/>                  
        <div class="col-md-12">
            <div class="row">
                
                    @for($fl = 1; $fl <= 4; $fl++)
                        <div class="col-auto">
                            @php
                                $lineColumn = "footer_line".$fl;                    
                            @endphp
                            <div class="form-group">
                                <input type="text" name="footer_line{{ $fl }}" value="{{ $footerDetail->$lineColumn }}" class="form-control" placeholder="Footer Line{{ $fl }}" />
                            </div>
                        </div>
                    @endfor
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>     
        </div>
    </fieldset>             
</form>