<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function show($id)
    {
        $content = Content::findOrFail($id);
        return response()->json($content);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contents' => 'required|array|min:1',
            'contents.*.playlist_id' => 'required|exists:playlists,id',
            'contents.*.title' => 'required|max:150',
            'contents.*.url' => 'required|max:255',
            'contents.*.author' => 'nullable|max:150',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $createdContents = [];

        foreach ($request->contents as $contentData) {
            $content = Content::create($contentData);
            $createdContents[] = $content;
        }

        return response()->json(['data' => $createdContents], 201);
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
        return response()->json(['message' => 'Content deleted successfully']);
    }
}
