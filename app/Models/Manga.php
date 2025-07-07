<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
    ];

    /**
     * Relasi: Satu Manga memiliki banyak Chapter
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    /**
     * Relasi: Manga memiliki banyak Genre (many-to-many)
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_manga');
    }
}
