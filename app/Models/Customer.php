<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contactname',
        'address',
        'city',
        'country',
        'phonenumber',
        'razonsocial',
        'regimenfiscal',
        'rfc',
        'email',
        'is_active',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class, 'idcustomer', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
