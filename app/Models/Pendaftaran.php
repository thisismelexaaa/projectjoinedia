<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

<<<<<<< HEAD
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
=======
    protected $guarded = ['id'];

    // relasi ke tabel event
>>>>>>> 8019b8b (70% Progress)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

<<<<<<< HEAD
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
=======
    // relasi ke table transaksi
    public function transaksi()
>>>>>>> 8019b8b (70% Progress)
    {
        return $this->hasOne(Transaksi::class, 'pendaftarans_id');
    }
}
