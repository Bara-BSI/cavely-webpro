<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_game',
        'tanggal_rilis',
        'harga',
        'status',
        'deskripsi',
        'users_id',
    ];
    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function game_genres()
    {
        return $this->hasMany(Game_Genre::class, 'games_id', 'id');
    }

    public function game_medias()
    {
        return $this->hasMany(Game_Media::class, 'games_id', 'id');
    }

    public $timestamps = false;
}
