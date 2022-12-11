<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class BundleSku extends Model
{
    protected $fillable = ['parent_variation_id','child_variation_id','quantity'];
    protected $dates = ['deleted_at'];
}
