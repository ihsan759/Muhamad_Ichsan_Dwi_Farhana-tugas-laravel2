<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'like';
    protected $guarded = ['id'];

    public function like()
    {
        return $this->belongsTo(Blog::class, 'id_blog');
    }
}
