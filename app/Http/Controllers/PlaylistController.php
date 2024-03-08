<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Content;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::paginate(10);
        return response()->json($playlists->items());
    }

    public function show($id)
    {
        $playlist = Playlist::with('contents')->findOrFail($id);
        return response()->json($playlist);
    }

    public function store(Request $request)
    {
        $playlist = Playlist::create($request->all());
        return response()->json($playlist);
    }

    public function update(Request $request, $id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->update($request->all());
        return response()->json($playlist);
    }

    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();
        return response()->json(['message' => 'Playlist deleted successfully']);
    }
}
