<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function show($id)
    {
        $song = Song::findOrFail($id);
        $song->increment('plays');
        return view('music.show', compact('song'));
    }
}

