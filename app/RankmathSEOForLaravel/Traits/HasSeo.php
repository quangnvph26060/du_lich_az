<?php

namespace App\RankmathSEOForLaravel\Traits;

use App\RankmathSEOForLaravel\Services\SeoService;

trait HasSeo
{
    protected $seoService;

    protected static function bootHasSeo()
    {
        static::creating(function ($model) {
            $seoService = app(SeoService::class);

            if (empty($model->seo_title)) {
                $model->seo_title = $seoService->generateMetaTitle($model->title ?? '');
            }
            if (empty($model->seo_description)) {
                $model->seo_description = $seoService->generateMetaDescription($model->content ?? '');
            }
            if (empty($model->slug)) {
                $model->slug = $seoService->generateSlug($model->title ?? '');
            }
        });
    }

    protected function getSeoService(): SeoService
    {
        if (!$this->seoService) {
            $this->seoService = app(SeoService::class);
        }
        return $this->seoService;
    }

    public function getSeoScore(): array
    {
        $seoService = $this->getSeoService();

        $score = 0;
        $maxScore = 100;
        $details = [];

        $titleCheck = $seoService->checkMetaTitleLength($this->seo_title ?? '');
        $details['title'] = $titleCheck;
        if ($titleCheck['is_optimal']) {
            $score += 20;
        }

        $descriptionCheck = $seoService->checkMetaDescriptionLength($this->seo_description ?? '');
        $details['description'] = $descriptionCheck;
        if ($descriptionCheck['is_optimal']) {
            $score += 20;
        }

        if (!empty($this->slug)) {
            $score += 20;
            $details['slug'] = ['is_optimal' => true, 'message' => 'Slug hợp lệ'];
        } else {
            $details['slug'] = ['is_optimal' => false, 'message' => 'Slug không được để trống'];
        }

        if (!empty($this->meta_keywords)) {
            $keywords = explode(',', $this->meta_keywords);
            $keywordScore = 0;
            foreach ($keywords as $keyword) {
                $densityCheck = $seoService->checkKeywordDensity($this->content ?? '', trim($keyword));
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

    public function getSeoSuggestions(): array
    {
        $suggestions = [];
        $seoScore = $this->getSeoScore();

        foreach ($seoScore['details'] as $key => $detail) {
            if (isset($detail['is_optimal']) && !$detail['is_optimal']) {
                $suggestions[] = $detail['message'];
            }
        }

        return $suggestions;
    }
}
