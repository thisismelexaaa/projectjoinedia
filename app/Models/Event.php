<?php

namespace App\Models;

<<<<<<< HEAD
<<<<<<< HEAD
use App\Models\Penjadwalan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
use App\Models\Penjadwalan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 8019b8b (70% Progress)

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 8019b8b (70% Progress)
        'nama',
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
<<<<<<< HEAD
        'user_id',
        'event_id',
        'kuota',
        'level',
=======
        'eventname',
        'eventdate',
        'eventtype',
        'eventorganizer',
        'eventstatus',
        'eventimage',
        'eventdescription',
        'eventkategori',
        'eventlocation',
        'eventprice',
=======
>>>>>>> 8019b8b (70% Progress)
        'user_id',
        'event_id',
>>>>>>> f89a811 (First Commit : Progress 80%)
    ];

    // Relationship event dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 8019b8b (70% Progress)
    public function penjadwalan()
    {
        return $this->hasOne(Penjadwalan::class, 'event_id');
    }

    public function sponsor()
    {
<<<<<<< HEAD
        return $this->hasMany(Sponsor::class);
    }

=======
    // Relationship event dengan pendaftaran
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
        return $this->hasOne(Sponsor::class, 'event_id');
    }

>>>>>>> 8019b8b (70% Progress)
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'event_id');
    }

    public function sponsorCount()
    {
        return $this->sponsor()->count();
    }
}
