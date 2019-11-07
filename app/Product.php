<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function groupIs()
    {
        return $this->belongsTo('App\ProductGroup', 'product_group_id', 'id');
    }
}
