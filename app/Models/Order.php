<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['idemployee', 'orderdate', 'subtotal', 'iva', 'total'];

    // Relación con Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'idemployee');
    }

    // Relación con OrderDetails
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'idorder');
    }
}
