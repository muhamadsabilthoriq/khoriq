<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relasi: Genre memiliki banyak Manga (many-to-many)
     */
    public function mangas()
    {
        return $this->belongsToMany(Manga::class, 'genre_manga');
    }
}
