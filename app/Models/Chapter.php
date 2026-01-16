<?php
namespace App\Models;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';
    protected $fillable = ['comic_id','title','number'];


    public function comic()
    {
        return $this->belongsTo(Comic::class, 'comic_id');
    }

     public function pages()
    {
        return $this->hasMany(Page::class)
        ->orderBy('page_number', 'asc');
    }

    public function comments()
{
    return $this->hasMany(Comment::class);
}

public function reads()
{
    return $this->hasMany(UserRead::class);
}


    
}
