<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['id','draft_product_id','image_url'];
    protected $dates = ['deleted_at'];

    public function getImageUrlAttribute($value) {
        if($value) {
            return (filter_var($value, FILTER_VALIDATE_URL) == FALSE) ? asset('/').ltrim($value,'/') : $value;
        }
        return $value;
    }
}
