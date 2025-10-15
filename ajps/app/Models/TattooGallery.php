<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TattooGallery extends Model
{
    use HasFactory;

    protected $table = 'tattoo_galleries';

    protected $fillable = [
        'headertitle',
        'tattooimages',
        'listheader',
        'pricelistimages',
    ];

    protected $casts = [
        'tattooimages' => 'array',
        'pricelistimages' => 'array',
    ];
}
