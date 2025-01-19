<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table='reviews';
    protected $primaryKey= ['users_id', 'games_id'];
    public $incrementing = false;
    protected $fillable=[
        'nilai',
        'deskripsi',
        'tanggal_ulasan',
        'users_id',
        'games_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
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
