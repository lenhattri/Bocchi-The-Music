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
        'user_id',
        'plays', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
