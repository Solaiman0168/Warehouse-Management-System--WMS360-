<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavbarHumbergerExpandCollapse extends Model
{
    protected $fillable = ['id', 'user_id', 'expand_collapse_value'];
}
