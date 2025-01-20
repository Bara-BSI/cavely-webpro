<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game_Genre extends Model
{
    use HasFactory;
    protected $table='game_genres';
    protected $primaryKey= ['games_id', 'genres_id'];
    public $incrementing = false;
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
    public function getKeyType() 
    { return 'array'; 
    }
    protected function setKeysForSaveQuery($query) { $query->where($this->primaryKey[0], '=', $this->getAttribute($this->primaryKey[0])) ->where($this->primaryKey[1], '=', $this->getAttribute($this->primaryKey[1])); return $query; }
}
