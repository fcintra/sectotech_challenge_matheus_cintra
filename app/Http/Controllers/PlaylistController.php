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
        $playlists = Playlist::with('contents')->orderBy('created_at', 'desc')->paginate(20);
        return response()->json($playlists->items());
    }

    public function show($id)
    {
        $playlist = Playlist::with('contents')->findOrFail($id);
        return response()->json($playlist);
    }

    public function edit($id)
    {
        $playlist = Playlist::with('contents')->findOrFail($id);
        return view('editPlaylist', compact('playlist'));
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
        return redirect('/')->with('success', 'Playlist criada com sucesso!');
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
        return redirect('/')->with('success', 'Playlist deletada com sucesso!');
    }
}
