<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $playlists = Playlist::orderBy('created_at', 'desc')->paginate(10);
        return view('welcome', compact('playlists'));
    }
}
