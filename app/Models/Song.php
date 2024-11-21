<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Song extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'artist',
        'album',
        'year',
        'image',
        'music_file',
        'music_style_id',
        'user_id',
        'album_id',
        'plays', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    public function musicStyle()
    {
    return $this->belongsTo(MusicStyle::class);
    }

}
