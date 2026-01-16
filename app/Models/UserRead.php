<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRead extends Model
{
    protected $fillable = [
        'user_id',
        'chapter_id',
        'last_read_page',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
