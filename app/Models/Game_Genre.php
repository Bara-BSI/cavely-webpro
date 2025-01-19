<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game_Genre extends Model
{
    use HasFactory;
    protected $table='game_genres';
    protected $fillable=['games_id','genres_id'];
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    public $timestamps = false;
}
