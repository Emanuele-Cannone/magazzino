<?php

namespace App\Models;

use App\Scopes\AppointmentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from',
        'to',
        'title'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AppointmentScope());
    }

}
