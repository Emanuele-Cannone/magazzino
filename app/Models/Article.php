<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'in_order'
    ];

    public function clusters()
    {
        return $this->belongsToMany(Cluster::class);
    }

    public function stock()
    {
        return $this->hasOne(ArticleStock::class);
    }

    public function price()
    {
        return $this->hasOne(ArticlePrice::class);
    }

    public function worksheets()
    {
        return $this->belongsToMany(Article::class);
    }
}
