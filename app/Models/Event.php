<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
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
    ];

    // Relationship event dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship event dengan pendaftaran
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'event_id');
    }
}
