<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shelf extends Model
{
    use SoftDeletes;
    protected $table = 'shelfs';
    protected $fillable = ['warehouse_id','shelf_name','user_id','status'];
    protected $dates = ['deleted_at'];

    public function getShelfNameAttribute() {
        $warehouseName = isset($this->warehouse->warehouse_name) ? ' ('.$this->warehouse->warehouse_name.')' : '';
        return $this->attributes['shelf_name'].$warehouseName;
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function total_product(){
        return $this->belongsToMany('App\ProductVariation','product_shelfs','shelf_id','variation_id')->wherePivot('quantity','!=',0)->withPivot('quantity')->wherePivot('deleted_at',NULL);
    }

    public function shelf_quantity(){
        return $this->belongsToMany('App\Shelf','product_shelfs','variation_id','shelf_id')->withPivot('quantity');
    }

    public function pivot(){
        return $this->hasOne('App\ShelfedProduct','shelf_id','id');
    }

    public function total_shelf_product(){
        return $this->hasMany('App\ShelfedProduct');
    }

    public function warehouse() {
        return $this->belongsTo('App\Warehouse','warehouse_id','id')->select('id','warehouse_name');
    }
}
