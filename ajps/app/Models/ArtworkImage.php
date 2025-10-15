<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtworkImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id',
        'image_path',
        'title',
        'description',
    ];

    // Relationship: bawat artwork image ay pagmamay-ari ng isang artist
    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
