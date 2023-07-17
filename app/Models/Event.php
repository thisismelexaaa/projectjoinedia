<?php

namespace App\Models;

<<<<<<< HEAD
use App\Models\Penjadwalan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
>>>>>>> f89a811 (First Commit : Progress 80%)

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
<<<<<<< HEAD
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
    public function penjadwalan()
    {
        return $this->hasOne(Penjadwalan::class, 'event_id');
    }

    public function sponsor()
    {
        return $this->hasMany(Sponsor::class);
    }

=======
    // Relationship event dengan pendaftaran
>>>>>>> f89a811 (First Commit : Progress 80%)
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'event_id');
    }
}
