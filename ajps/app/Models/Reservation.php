<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'service',
        'instruction',
    ];
}
