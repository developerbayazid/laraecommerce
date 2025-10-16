<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
            'product_title', 'product_category', 'product_price', 'product_quantity', 'product_description', 'product_image'
    ];

}
