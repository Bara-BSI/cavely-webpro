<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bank',
        'hp'
    ];
    protected $guarded = ['id'];

    public function checkout()
    {
        return $this->hasMany(Checkout::class);
    }
    public $timestamps = false;
}
