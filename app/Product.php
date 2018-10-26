<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Product extends Model
{
    public function scopeGetPrices ($query)
    {
        return $query->where('price', '>', '5');
    }
}
