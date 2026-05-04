<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FullPayment extends Model
{
    use HasFactory;

    protected $table = 'full_payments';
    protected $primaryKey = 'full_payment_id';

    protected $fillable = ['booking_id', 'amount', 'payment_date', 'payment_mode'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}
