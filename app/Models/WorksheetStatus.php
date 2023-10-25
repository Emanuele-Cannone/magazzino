<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorksheetStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function worksheet()
    {
        return $this->belongsTo(Worksheet::class);
    }
}
