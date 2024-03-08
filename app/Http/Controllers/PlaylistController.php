<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;


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

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:200',
            'author' => 'nullable|max:150',
        ]);


        // Verificar se a validação falhou
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

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
