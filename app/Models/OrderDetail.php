<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'ordersdetails'; // Nombre de la tabla en la base de datos

    protected $fillable = ['idorder', 'idproduct', 'unitprice', 'quantity'];

    public $timestamps = false;

    // Relación con Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'idorder');
    }



    // Relación con Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'idproduct');
    }
}
