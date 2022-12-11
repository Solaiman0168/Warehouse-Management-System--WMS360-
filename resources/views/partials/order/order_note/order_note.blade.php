<span class="append_note{{$id}}" id="s{{$id}}">
    @if(isset($order_note) || ($buyer_message != null))
        <label class="label label-success view-note" style="cursor: pointer" id="{{$id}}"
               onclick="view_note({{$id}});">View Note</label>
    @endif
</span>
