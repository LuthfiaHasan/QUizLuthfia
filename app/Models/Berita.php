<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'foto', 'konten', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


