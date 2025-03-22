<?php

namespace App\Http\Controllers;

use App\Models\PlayHistory;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Song::all();

        return Inertia::render('Songs/Index', [
            'songs' => $data,
        ]);
    }

    public function getRandom()
    {
        $user = request()->user();

        $lastPlayed = PlayHistory::where('user_id', $user->id)
                        ->latest()
                        ->first();

        $lastSong = $lastPlayed ? Song::find($lastPlayed->song_id) : null;

        $randomSong = Song::where('id', '!=', $lastPlayed->song_id ?? null)
                        ->when($lastSong, function ($query) use ($lastSong) {
                            return $query->where('artist', '!=', $lastSong->artist);
                        })
                        ->inRandomOrder()
                        ->first();


        Log::info(json_encode($user));
        Log::info(json_encode($randomSong));

        if ($user) {
            PlayHistory::create([
                'user_id' => $user->id,
                'song_id' => $randomSong->id,
            ]);
        }

        return response()->json($randomSong, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PlayHistory::create([
            'user_id' => $request->user()->id,
            'song_id' => $request->song_id,
        ]);

        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
