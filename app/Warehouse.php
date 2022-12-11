<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    protected $fillable = ['warehouse_name','warehouse_slug','warehouse_location','status','is_default'];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function shelf_products() {
        return $this->hasManyThrough('App\ShelfedProduct','App\Shelf','warehouse_id','shelf_id','id','id');
    }

    public function shelfs() {
        return $this->hasMany('App\Shelf','warehouse_id','id');
    }
}
