<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'photographer_name',
    ];

    // Relationships
    public function images()
    {
        return $this->hasMany(AlbumImage::class);
    }
}
