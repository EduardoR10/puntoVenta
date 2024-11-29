<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = ['mensaje', 'id_user'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
