<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table='carts';
    protected $fillable=[
        'jumlah',
        'users_id',
        'games_id',
        'checkouts_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }
    public $timestamps = false;
}
