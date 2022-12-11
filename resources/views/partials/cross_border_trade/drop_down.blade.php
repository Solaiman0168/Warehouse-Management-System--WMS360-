@if(isset($profile_id))
    <select name="cross_border_trade[{{$profile_id ?? ''}}]" class="form-control" id="condition-select">
        @if($cross_border_trade == "None")
            <option value="None" selected>-</option>
            <option value="North America">eBay US and Canada</option>
        @elseif($cross_border_trade == "North America")
            <option value="None">-</option>
            <option value="North America" selected>eBay US and Canada</option>
        @else
            <option value="None" selected>-</option>
            <option value="North America" >eBay US and Canada</option>
        @endif
        @else
                <select name="cross_border_trade" class="form-control" id="condition-select">
                    @if(isset($cross_border_trade))
                        @if($cross_border_trade == "None")
                            <option value="None" selected>-</option>
                            <option value="North America">eBay US and Canada</option>
                        @elseif($cross_border_trade == "North America")
                            <option value="None">-</option>
                            <option value="North America" selected>eBay US and Canada</option>
                        @else
                            <option value="None" selected>-</option>
                            <option value="North America" >eBay US and Canada</option>
                        @endif
                    @else
                        <option value="None" selected>-</option>
                        <option value="North America" >eBay US and Canada</option>
                    @endif
                @endif
            </select>
