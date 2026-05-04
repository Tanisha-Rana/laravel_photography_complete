<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';

    protected $fillable = ['role_name'];

    public function clients()
    {
        return $this->hasMany(Client::class, 'role_id', 'role_id');
    }

    public function photographers()
    {
        return $this->hasMany(Photographer::class, 'role_id', 'role_id');
    }
}
