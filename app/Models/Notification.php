<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'id';

    protected $fillable = ['client_id', 'message', 'title', 'url', 'is_read'];

    /**
     * Helper to create notifications
     */
    public static function createNotification($clientId, $title, $message, $url = null)
    {
        return self::create([
            'client_id' => $clientId,
            'title' => $title,
            'message' => $message,
            'url' => $url,
            'is_read' => 'no'
        ]);
    }
}
