<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id', 'id');
    }

    public function transactionDetail()
    {
        return $this->hasMany('App\TransactionDetail', 'product_id', 'id');
    }

    public function image()
    {
        return $this->hasMany('App\Image', 'product_id', 'id');
    }
}
