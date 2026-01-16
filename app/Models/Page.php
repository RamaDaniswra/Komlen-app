<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';

    protected $fillable = [
        'chapter_id',
        'page_number',
        'image_path',
        'page_number'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
