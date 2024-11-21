<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\History;

class MusicController extends Controller
{
    public function show($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return redirect()->route('login')->with('error', __('Please login to view this song.'));
        }

        // Lấy bài hát hiện tại
        $currentSong = Song::with(['album', 'musicStyle'])->findOrFail($id);

        // Lấy lịch sử nghe của người dùng
        $histories = History::where('user_id', $userId)->get();

        // Tính toán tổng số lần nghe
        $totalGenrePlays = $histories->groupBy('song.musicStyle.id')->map->sum('listen_count');
        $totalAlbumPlays = $histories->groupBy('song.album.id')->map->sum('listen_count');
        $totalArtistPlays = $histories->groupBy('song.artist')->map->sum('listen_count');
        $maxSongPlays = $histories->max('listen_count');

        // Định nghĩa các trọng số
        $weights = [
            'genre' => 0.25,
            'album' => 0.20,
            'artist' => 0.20,
            'frequency' => 0.20,
            'recency' => 0.15,
        ];

        // Lọc các bài hát khác để gợi ý
        $songs = Song::where('id', '!=', $id)->with(['album', 'musicStyle'])->get();

        // Tính điểm cho từng bài hát
        $songScores = $songs->map(function ($song) use ($histories, $totalGenrePlays, $totalAlbumPlays, $totalArtistPlays, $maxSongPlays, $weights) {
            $userHistory = $histories->where('song_id', $song->id)->first();
            $lastPlayedDays = $userHistory ? now()->diffInDays($userHistory->updated_at) : null;

            // Tính các thành phần điểm
            $genreScore = $song->musicStyle
                ? ($totalGenrePlays[$song->musicStyle->id] ?? 0) / max(1, $totalGenrePlays->sum())
                : 0;

            $albumScore = $song->album
                ? ($totalAlbumPlays[$song->album->id] ?? 0) / max(1, $totalAlbumPlays->sum())
                : 0;

            $artistScore = $song->artist
                ? ($totalArtistPlays[$song->artist] ?? 0) / max(1, $totalArtistPlays->sum())
                : 0;

            $frequencyScore = $userHistory
                ? $userHistory->listen_count / max(1, $maxSongPlays)
                : 0;

            $recencyScore = $lastPlayedDays !== null
                ? 1 / (1 + $lastPlayedDays)
                : 0;

            // Tính tổng điểm
            $totalScore = $weights['genre'] * $genreScore +
                          $weights['album'] * $albumScore +
                          $weights['artist'] * $artistScore +
                          $weights['frequency'] * $frequencyScore +
                          $weights['recency'] * $recencyScore;

            return [
                'song' => $song,
                'score' => $totalScore,
            ];
        });

      
        $topSongs = $songScores->sortByDesc('score')->take(5);

        return view('music.show', [
            'currentSong' => $currentSong,
            'topSongs' => $topSongs,
        ]);
    }
}
