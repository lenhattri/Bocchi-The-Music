<?php

namespace App\Http\Controllers;

use App\Models\MusicStyle;
use Illuminate\Http\Request;

class MusicStyleController extends Controller
{
    /**
     * Hiển thị danh sách các MusicStyle.
     */
    public function index()
    {
        $musicStyles = MusicStyle::all();
        return view('music_styles.index', compact('musicStyles'));
    }

    public function create()
    {
        return view('music_styles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:music_styles,name|max:255',
            'description' => 'nullable|string',
        ]);

        MusicStyle::create($request->all());

        return redirect()->route('music_styles.index')->with('success', __('Music Style created successfully.'));
    }

    public function show(MusicStyle $musicStyle)
    {
        return view('music_styles.show', compact('musicStyle'));
    }

    public function edit(MusicStyle $musicStyle)
    {
        return view('music_styles.edit', compact('musicStyle'));
    }

    public function update(Request $request, MusicStyle $musicStyle)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:music_styles,name,' . $musicStyle->id,
            'description' => 'nullable|string',
        ]);

        $musicStyle->update($request->all());

        return redirect()->route('music_styles.index')->with('success', __('Music Style updated successfully.'));
    }

    public function destroy(MusicStyle $musicStyle)
    {
        $musicStyle->delete();

        return redirect()->route('music_styles.index')->with('success', __('Music Style deleted successfully.'));
    }
}
