<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'unitprice',
        'code',
        'stock',
        'stockmin',
        'image',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'unitprice' => 'decimal:2',
        'stock' => 'integer',
        'stockmin' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
