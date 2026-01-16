<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    
    protected $table = 'comic';

    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_image',
        'uploaded_by',
        'slug',
    ];

    public function getRouteKeyName()
{
    return 'slug';
}

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'comic_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'comic_genre', 'comic_id', 'genre_id');
    }

    public function latestChapter()
    {
        return $this->hasOne(Chapter::class, 'comic_id')->latestOfMany('created_at');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'comic_id');
    }

    // Fungsi pembantu untuk menghitung rata-rata rating
    public function averageRating()
    {
        return round($this->ratings()->avg('rating'), 1) ?: 0;
    }

}
