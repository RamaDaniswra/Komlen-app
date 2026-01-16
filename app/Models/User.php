<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

      @var list<string>
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

      @var list<string>
     
    protected $hidden = [
        'password',
        'remember_token',
    ];

     
      @return array<string, string>
     
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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
