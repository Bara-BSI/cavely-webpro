<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game_Media extends Model
{
    use HasFactory;
    protected $table='game_medias';
    protected $fillable=['nama','jenis','games_id'];
    protected $guarded = ['id'];
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    public $timestamps = false;
}
