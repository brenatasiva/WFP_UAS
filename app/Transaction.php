<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsToMany(
            'App\Product',
            'transaction_details',
            'transaction_id',
            'product_id'
        )->withPivot('quantity', 'price', 'subtotal');
    }

    public function insertProduct($cart, $user)
    {
        $total = 0;
        $subtotal = 0;
        foreach ($cart as $id => $detail) {
            $subtotal = $detail['price'] * $detail['quantity'];
            $total += $detail['price'] * $detail['quantity'];
            $this->product()->attach($id, ['quantity' => $detail['quantity'], 'subtotal' => $subtotal, 'price' => $detail['price'], 'product_id' => $detail['productId']]);
        }

        return $total;
    }
}
