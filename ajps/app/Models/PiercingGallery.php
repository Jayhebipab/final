<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiercingGallery extends Model
{
    use HasFactory;

    protected $table = 'piercing_galleries';

    protected $fillable = [
        'headertitle',
        'piercingimages',
        'listheader',
        'pricelistimages',
    ];

    protected $casts = [
        'piercingimages' => 'array',
        'pricelistimages' => 'array',
    ];
}
