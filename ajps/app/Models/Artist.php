<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'contact_number',
        'email',
        'description',
        'profile_photo',
        'cover_photo',
        'artworks', // ✅ added artworks JSON column
    ];

    protected $casts = [
        'artworks' => 'array', // ✅ auto convert JSON to PHP array
    ];
}
