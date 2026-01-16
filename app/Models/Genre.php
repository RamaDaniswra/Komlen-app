<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
     public $timestamps = false;
    protected $table = 'genre';
    protected $fillable = ['name'];

    public function comics()
    {
        return $this->belongsToMany(Comic::class, 'comic_genre', 'genre_id', 'comic_id');
    }
}
