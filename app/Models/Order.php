<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email',
        'phone', 'address', 'city', 'zip', 'payment_method',
        'status', 'total'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItems::class);
    }
}
