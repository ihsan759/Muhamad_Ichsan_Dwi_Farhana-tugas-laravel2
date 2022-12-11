<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'blogs';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function komentar()
    {
        return $this->hasMany(komentar::class, 'id_blog');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'id_blog');
    }
}
