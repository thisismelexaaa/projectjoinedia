<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'nomertiket',
        'nama',
        'email',
        'username',
        'type',
        'event_id',
        'user_id',
        'price',
        'status',
    ];

    // Relationship pendaftaran dengan event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Relationship pendaftaran dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
