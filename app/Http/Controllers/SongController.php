<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Models\MusicStyle;

class SongController extends Controller
{

    public function index()
    {
        $songs = Song::all();
        return view('songs.index', compact('songs'));
    }

    public function create()
    {
        $musicStyles = MusicStyle::all();
        $albums = Album::all();
        return view('songs.create',compact('albums','musicStyles'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'artist' => 'required',
        'album_id' => 'nullable|exists:albums,id',
        'year' => 'required|integer',
        'image' => 'nullable|image',
        'music_file' => 'nullable|mimes:mp3',
        'music_style_id' => 'nullable|exists:music_styles,id',
    ]);

    $data = $request->all();
    $data['user_id'] = auth()->id();

    if ($request->hasFile('image')) {
        $data['image'] = $this->uploadFile($request->file('image'), 'users/songs/images');
    }

    if ($request->hasFile('music_file')) {
        $data['music_file'] = $this->uploadFile($request->file('music_file'), 'users/songs/mp3');
    }

    Song::create($data);

    return redirect()->route('songs.index')->with('success', __('Song added successfully.'));
}

    

    public function show(Song $song)
    {
        return view('songs.show', compact('song'));
    }

    public function edit(Song $song)
    {
        $albums = Album::all();
        $musicStyles = MusicStyle::all();
        return view('songs.edit', compact('song','albums','musicStyles'));
    }


    public function update(Request $request, Song $song)
{
    $request->validate([
        'title' => 'required',
        'artist' => 'required',
        'album_id' => 'nullable|exists:albums,id', // Đảm bảo tên trường là album_id
        'year' => 'required|integer',
        'image' => 'nullable|image',
        'music_file' => 'nullable|mimes:mp3',
        'music_style_id' => 'nullable|exists:music_styles,id',
    ]);

    $data = $request->all();
   
    if ($request->hasFile('image')) {
        $data['image'] = $this->uploadFile($request->file('image'), 'users/songs/images');
    }

    if ($request->hasFile('music_file')) {
        $data['music_file'] = $this->uploadFile($request->file('music_file'), 'users/songs/mp3');
    }

    $song->update($data);

    return redirect()->route('songs.index')->with('success', __('Song updated successfully.'));
}


    public function destroy(Song $song)
    {
        $song->delete();
        return redirect()->route('songs.index')->with('success', __('Song deleted successfully.'));
    }


    private function uploadFile($file, $path)
    {
       
        $path = rtrim($path, '/');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($path), $filename);
        return $path . '/' . $filename;
    }
}
