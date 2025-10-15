<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artwork_images extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'image_path'];

   public function artworks()
{
    return $this->hasMany(Artwork::class);
}
}
