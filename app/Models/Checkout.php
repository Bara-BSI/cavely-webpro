<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table='checkouts';
    protected $fillable=[
        'tanggal_checkout',
        'total_harga',
        'payments_id'
    ];
    
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public $timestamps = false;
}
