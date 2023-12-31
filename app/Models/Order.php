<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',

    ];

    public function articles()
    {
        return $this->hasMany(OrderArticle::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
