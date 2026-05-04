<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'catalogue_id', 'status'];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class, 'catalogue_id', 'id');
    }
}
