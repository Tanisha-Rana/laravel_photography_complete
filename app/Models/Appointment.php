<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $primaryKey = 'appointment_id';

    protected $fillable = ['slot_id', 'client_id', 'appointment_date', 'status'];

    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id', 'slot_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'appointment_id', 'appointment_id');
    }

    public function advance_payments()
    {
        return $this->hasMany(AdvancePayment::class, 'appointment_id', 'appointment_id');
    }
}
