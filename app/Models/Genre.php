<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'nama_genre', 'usia_minimal'];

    public function game_genres()
    {
        return $this->hasMany(Game_Genre::class);
    }

    public $timestamps = false;
}
