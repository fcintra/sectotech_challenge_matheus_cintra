<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = ['title', 'description', 'author'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
