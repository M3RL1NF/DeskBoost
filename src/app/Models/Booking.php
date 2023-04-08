<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'rooms'
    protected $fillable = [
        'user_id',
        'room_id',
        'date',
        'block'
    ];
}
