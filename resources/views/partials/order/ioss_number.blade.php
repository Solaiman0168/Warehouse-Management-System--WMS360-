<div class="d-flex justify-content-start mb-2">
    <div class="content-left">
        <h7> eBay Tax Reference </h7>
    </div>

    <div class="content-right">
        <h7> :
            @if(isset($ebay_tax_reference))
                @if(isset(unserialize($ebay_tax_reference)['eBayReference']))
                    <span style="background-color: #000dfd;padding: 3px;"><strong style="color:white"> {{unserialize($ebay_tax_reference)['eBayReference']}}</strong></span>
                @endif
            @endif
        </h7>
    </div>
</div>
