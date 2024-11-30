<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['idemployee', 'idcustomer', 'orderdate', 'subtotal', 'iva', 'total'];

    //Relaciones
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'idemployee');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'idcustomer');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'idorder');
    }
}
