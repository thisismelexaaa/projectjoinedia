<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
<<<<<<< HEAD

    public function buat_events()
    {
        return $this->belongsTo(BuatEvent::class, "event_id", "id");
    }
=======
>>>>>>> 8019b8b (70% Progress)
}
