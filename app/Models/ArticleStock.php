<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'current_stock',
        'min_stock'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
