<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $guarded = ['id'];

    // relasi ke tabel event
=======
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
>>>>>>> f89a811 (First Commit : Progress 80%)
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

<<<<<<< HEAD
    // relasi ke table transaksi
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'pendaftarans_id');
    }

    // relasi ke user
=======
    // Relationship pendaftaran dengan user
>>>>>>> f89a811 (First Commit : Progress 80%)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
