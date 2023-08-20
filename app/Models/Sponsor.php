<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sponsor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = ['name', 'logo', 'event_id', 'description', 'start_date', 'end_date'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
