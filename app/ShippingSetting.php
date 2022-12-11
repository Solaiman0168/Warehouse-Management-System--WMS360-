<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingSetting extends Model
{
    protected $fillable = ['id, aggregate_value, shipping_fee, color_code'];
}
