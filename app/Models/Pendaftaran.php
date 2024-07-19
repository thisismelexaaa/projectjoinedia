<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // relasi ke tabel event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // relasi ke table transaksi
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'pendaftarans_id');
    }

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
