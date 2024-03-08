<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $playlists = Playlist::paginate(20);
        return view('welcome', compact('playlists'));
    }
}
