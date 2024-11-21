<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function recordListening(Request $request, $songId)
    {
        $userId = auth()->id(); 
        if (!$userId) {
            return response()->json(['message' => __('Unauthorized')], 401);
        }
        $history = History::where('user_id', $userId)->where('song_id', $songId)->first();

        if ($history) {
            $history->increment('listen_count');
        } else {

            History::create([
                'user_id' => $userId,
                'song_id' => $songId,
            ]);
        }

        return response()->json(['message' => __('Listening recorded successfully')]);
    }

    public function userHistory()
    {
        $histories = History::with('song')->where('user_id', auth()->id())->get();

        return view('histories.index', compact('histories'));
    }
}
