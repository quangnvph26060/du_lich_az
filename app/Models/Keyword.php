<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keyword extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keywords';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_keyword');
    }

}
