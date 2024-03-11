<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{

    public function index()
    {
        $content = Content::all();
        return response()->json($content);
    }

    public function show($id)
    {
        $content = Content::findOrFail($id);
        return response()->json($content);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'playlist_id' => 'required|exists:playlists,id',
            'title' => 'required|max:150',
            'url' => 'required|max:255',
            'author' => 'nullable|max:150',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $content = Content::create($request->all());

        return redirect('/')->with('success', 'Content criada com sucesso!');
    }

    public function update(Request $request, $id)
    {

        $content = Content::findOrFail($id);
        $content->update($request->all());
        return response()->json($content);
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        return redirect('/')->with('success', 'Content deletada com sucesso!');
    }
}
