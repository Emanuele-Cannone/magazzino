<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    use HasFactory;

    private const PAYMENT_TYPES = [
        'garanzia',
        'pagamento',
        'interno'
    ];

    protected $fillable = [
        'customer_id',
        'user_id',
        'worksheet_status_id',
        'appointment_id',
        'description',
        'payment_type',
        'amount'
    ];

    public function worksheetStatus()
    {
        return $this->hasOne(WorksheetStatus::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}
