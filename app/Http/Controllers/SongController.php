<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Hiển thị danh sách bài hát
     */
    public function index()
    {
        $songs = Song::all();
        return view('songs.index', compact('songs'));
    }

    /**
     * Hiển thị form thêm bài hát
     */
    public function create()
    {
        return view('songs.create');
    }

    /**
     * Lưu bài hát mới vào cơ sở dữ liệu
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'album' => 'required',
            'year' => 'required|integer',
            'image' => 'nullable|image',
            'music_file' => 'nullable|mimes:mp3',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id(); // Lưu user_id cho bài hát

        // Sử dụng phương thức uploadFile để lưu các file vào public
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), 'users/songs/images');
        }

        if ($request->hasFile('music_file')) {
            $data['music_file'] = $this->uploadFile($request->file('music_file'), 'users/songs/mp3');
        }

        Song::create($data);
        return redirect()->route('songs.index')->with('success', 'Song added successfully.');
    }

    /**
     * Hiển thị chi tiết bài hát
     */
    public function show(Song $song)
    {
        return view('songs.show', compact('song'));
    }

    /**
     * Hiển thị form chỉnh sửa bài hát
     */
    public function edit(Song $song)
    {
        return view('songs.edit', compact('song'));
    }

    /**
     * Cập nhật bài hát trong cơ sở dữ liệu
     */
    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'album' => 'required',
            'year' => 'required|integer',
            'image' => 'nullable|image',
            'music_file' => 'nullable|mimes:mp3',
        ]);

        $data = $request->all();

        // Sử dụng phương thức uploadFile để lưu các file mới nếu có vào public
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), 'users/songs/images');
        }

        if ($request->hasFile('music_file')) {
            $data['music_file'] = $this->uploadFile($request->file('music_file'), 'users/songs/mp3');
        }

        $song->update($data);
        return redirect()->route('songs.index')->with('success', 'Song updated successfully.');
    }

    /**
     * Xóa bài hát khỏi cơ sở dữ liệu
     */
    public function destroy(Song $song)
    {
        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Song deleted successfully.');
    }

    /**
     * Phương thức riêng để upload file vào thư mục public
     */
    private function uploadFile($file, $path)
    {
        // Đảm bảo $path không kết thúc bằng dấu '/' để tránh lặp
        $path = rtrim($path, '/');

        // Tạo tên file duy nhất để tránh trùng lặp
        $filename = time() . '_' . $file->getClientOriginalName();

        // Lưu file vào thư mục public
        $file->move(public_path($path), $filename);

        // Trả về đường dẫn công khai từ thư mục public
        return $path . '/' . $filename;
    }
}
