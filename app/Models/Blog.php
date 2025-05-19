<?php

namespace App\Models;

use App\RankmathSEOForLaravel\Services\SeoAnalyzer;
use App\RankmathSEOForLaravel\DTO\SeoAnalysisResult;
use App\RankmathSEOForLaravel\Traits\HasSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes, HasSeo;

    protected $table = 'blogs';

    protected $fillable = [
        'id',
        'title',
        'content',
        'image',
        'short_description',
        'posted_at',
        'remove_at',
        'view_count',
        'status',
        'seo_title',
        'seo_description',
        'catalogue_id',
        'slug',
    ];

    protected $appends = [
        'seo_score',
        'seo_suggestions',
        'seo_analysis'
    ];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function blogTags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id');
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'blog_keyword');
    }

    public function getSeoAnalysisAttribute(): ?SeoAnalysisResult
    {
        if (!$this->seo_title) {
            return null;
        }

        $analyzer = app(SeoAnalyzer::class);
        return $analyzer->analyzeFromBlog($this);
    }

    public function seoScore()
    {
        return $this->hasOne(SeoScore::class, 'blog_id', 'id');
    }

}