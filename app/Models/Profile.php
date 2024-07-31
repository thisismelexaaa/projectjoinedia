<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_picture_url',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
