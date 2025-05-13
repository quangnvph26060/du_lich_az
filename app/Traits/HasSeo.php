<?php

namespace App\Traits;

use App\Services\SeoService;

trait HasSeo
{
    protected $seoService;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->seoService = app(SeoService::class);
    }

    /**
     * Boot the trait
     */
    protected static function bootHasSeo()
    {
        static::creating(function ($model) {
            if (empty($model->seo_title)) {
                $model->seo_title = $model->seoService->generateMetaTitle($model->title);
            }
            if (empty($model->seo_description)) {
                $model->seo_description = $model->seoService->generateMetaDescription($model->content);
            }
            if (empty($model->slug)) {
                $model->slug = $model->seoService->generateSlug($model->title);
            }
        });
    }

    /**
     * Get SEO score
     */
    public function getSeoScore(): array
    {
        $score = 0;
        $maxScore = 100;
        $details = [];

        // Kiểm tra meta title
        $titleCheck = $this->seoService->checkMetaTitleLength($this->seo_title);
        $details['title'] = $titleCheck;
        if ($titleCheck['is_optimal']) {
            $score += 20;
        }

        // Kiểm tra meta description
        $descriptionCheck = $this->seoService->checkMetaDescriptionLength($this->seo_description);
        $details['description'] = $descriptionCheck;
        if ($descriptionCheck['is_optimal']) {
            $score += 20;
        }

        // Kiểm tra slug
        if (!empty($this->slug)) {
            $score += 20;
            $details['slug'] = ['is_optimal' => true, 'message' => 'Slug hợp lệ'];
        } else {
            $details['slug'] = ['is_optimal' => false, 'message' => 'Slug không được để trống'];
        }

        // Kiểm tra từ khóa
        if (!empty($this->meta_keywords)) {
            $keywords = explode(',', $this->meta_keywords);
            $keywordScore = 0;
            foreach ($keywords as $keyword) {
                $densityCheck = $this->seoService->checkKeywordDensity($this->content, trim($keyword));
                if ($densityCheck['is_optimal']) {
                    $keywordScore += 10;
                }
            }
            $score += min($keywordScore, 40);
            $details['keywords'] = ['score' => $keywordScore, 'message' => 'Điểm từ khóa: ' . $keywordScore];
        } else {
            $details['keywords'] = ['score' => 0, 'message' => 'Chưa có từ khóa'];
        }

        return [
            'score' => $score,
            'percentage' => ($score / $maxScore) * 100,
            'details' => $details
        ];
    }

    /**
     * Get SEO suggestions
     */
    public function getSeoSuggestions(): array
    {
        $suggestions = [];
        $seoScore = $this->getSeoScore();

        foreach ($seoScore['details'] as $key => $detail) {
            if (!$detail['is_optimal']) {
                $suggestions[] = $detail['message'];
            }
        }

        return $suggestions;
    }
} 