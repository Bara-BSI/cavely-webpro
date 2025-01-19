<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'nama_region',
    ];
    protected $guarded = ['id'];

    public function countries()
    {
        return $this->hasMany(Country::class);
    }
    public $timestamps = false;
}
