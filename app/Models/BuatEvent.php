<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuatEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'hari',
        'type',
        'organizer',
        'status',
        'image',
        'description',
        'kategori',
        'location',
        'price',
        'user_id',
        'event_id',
        'kuota',
        'level',
    ];

    // Relationship event dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penjadwalan()
    {
        return $this->hasOne(Penjadwalan::class, 'event_id');
    }

    public function sponsor()
    {
        return $this->hasMany(Sponsor::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'event_id');
    }
}
