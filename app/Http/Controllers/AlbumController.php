<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    public function index()
    {
        $albums = Album::all();
        return view('albums.index', compact('albums'));
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'release_date' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id(); 

        Album::create($data);

        return redirect()->route('albums.index')->with('success', __('Album created successfully.'));
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'release_date' => 'nullable|date',
        ]);

        $album->update($request->all());

        return redirect()->route('albums.index')->with('success', __('Album updated successfully.'));
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('success', __('Album deleted successfully.'));
    }
}
