<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasSeo;

    protected $fillable = [
        'catalogue_id',
        'title',
        'slug',
        'image',
        'short_description',
        'content',
        'posted_at',
        'remove_at',
        'view_count',
        'status',
        'tags',
        'seo_title',
        'seo_description',
        'meta_keywords'
    ];

    protected $casts = [
        'status' => 'boolean',
        'tags' => 'array',
        'posted_at' => 'datetime',
        'remove_at' => 'datetime'
    ];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
} 