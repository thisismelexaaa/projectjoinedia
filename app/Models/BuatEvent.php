<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuatEvent extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = [
        'nama',
        'hari',
        'start_date',
        'end_date',
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
=======
    protected $guarded = [];
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36

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
