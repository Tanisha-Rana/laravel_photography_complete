<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancePayment extends Model
{
    use HasFactory;

    protected $table = 'advance_payments';
    protected $primaryKey = 'advance_payment_id';

    protected $fillable = ['appointment_id', 'amount', 'payment_mode', 'payment_status', 'payment_date'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }
}
