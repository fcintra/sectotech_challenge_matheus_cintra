<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'url', 'author', 'playlist_id'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
