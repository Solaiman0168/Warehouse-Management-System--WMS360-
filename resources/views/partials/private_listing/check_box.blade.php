@if(isset($profile_id))
    <input type="checkbox" name="private_listing[{{$profile_id}}]" value="1" class="custom-control-input private_listing" id="private_listing{{$profile_id}}"
           @if($result)
               checked

        @endif
    >
@else
    <input type="checkbox" name="private_listing" value="1" class="custom-control-input private_listing" id="private_listing"
           @if(isset($result))
                @if($result)
                   checked
                @endif
           @endif
    >
@endif
