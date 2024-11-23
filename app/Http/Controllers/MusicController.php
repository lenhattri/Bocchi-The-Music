<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\History;

class MusicController extends Controller
{
    public function show($id)
    {
        $userId = auth()->id();

        $currentSong = Song::findOrFail($id);
        $currentSong->increment('plays'); 

    
        if (auth()->check()) {
            $userId = auth()->id();
            $history = History::where('user_id', $userId)->where('song_id', $currentSong->id)->first();
            if ($history) {
                $history->increment('listen_count');
            } else {
                History::create([
                    'user_id' => $userId,
                    'song_id' => $currentSong->id,
                ]);
            }
        }
        if (!$userId) {
            return redirect()->route('login')->with('error', __('Please login to view this song.'));
        }

        
        $currentSong = Song::with(['album', 'musicStyle'])->findOrFail($id);

        
        $histories = History::where('user_id', $userId)->get();

        $totalGenrePlays = $histories->groupBy(fn ($history) => $history->song->musicStyle->id ?? 'null')
            ->map->sum('listen_count');
        $totalAlbumPlays = $histories->groupBy(fn ($history) => $history->song->album->id ?? 'null')
            ->map->sum('listen_count');
        $totalArtistPlays = $histories->groupBy(fn ($history) => $history->song->artist ?? 'null')
            ->map->sum('listen_count');
        $maxSongPlays = $histories->max('listen_count');

     
        $weights = [
            'genre' => 0.25,
            'album' => 0.20,
            'artist' => 0.20,
            'frequency' => 0.20,
            'recency' => 0.15,
        ];

       
        $songs = Song::where('id', '!=', $id)->with(['album', 'musicStyle'])->get();

    
        $songScores = $songs->map(function ($song) use (
            $histories,
            $totalGenrePlays,
            $totalAlbumPlays,
            $totalArtistPlays,
            $maxSongPlays,
            $weights
        ) {
            $userHistory = $histories->where('song_id', $song->id)->first();
            $lastPlayedDays = $userHistory ? now()->diffInDays($userHistory->updated_at) : null;

            // Tính các thành phần điểm
            $genreKey = $song->musicStyle->id ?? 'null';
            $genreScore = $totalGenrePlays->has($genreKey)
                ? $totalGenrePlays[$genreKey] / max(1, $totalGenrePlays->sum())
                : 0;

            $albumKey = $song->album->id ?? 'null';
            $albumScore = $totalAlbumPlays->has($albumKey)
                ? $totalAlbumPlays[$albumKey] / max(1, $totalAlbumPlays->sum())
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
