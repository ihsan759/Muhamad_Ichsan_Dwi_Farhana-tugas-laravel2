<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $guarded = ['id'];

    public function komentar()
    {
        return $this->belongsTo(Blog::class, 'id_blog');
    }
}
