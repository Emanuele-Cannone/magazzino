<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'article_id',
        'quantity',
        'price'
    ];

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
