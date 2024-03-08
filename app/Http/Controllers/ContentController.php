<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    public function show($id)
    {
        $content = Content::findOrFail($id);
        return response()->json($content);
    }

    public function store(Request $request)
    {
        $content = Content::create($request->all());
        return response()->json($content);
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
