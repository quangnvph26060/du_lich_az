<?php

namespace App\RankmathSEOForLaravel\Services;

use App\RankmathSEOForLaravel\DTO\SeoAnalysisResult;
use App\RankmathSEOForLaravel\Rules\KeywordInTitleRule;
use App\RankmathSEOForLaravel\Rules\RuleInterface;
use App\RankmathSEOForLaravel\Rules\KeywordInDescriptionRule;
use App\RankmathSEOForLaravel\Rules\KeywordDensityRule;
use App\RankmathSEOForLaravel\Rules\InternalLinkRule;
use App\RankmathSEOForLaravel\Rules\ImageAltRule;

class SeoAnalyzer
{
    protected array $rules = [];
    protected array $ruleGroups = [
        'basic' => [
            'keyword_in_title',
            'keyword_in_description',
            'keyword_density'
        ],
        'content' => [
            'internal_link',
            'image_alt'
        ]
    ];

    public function __construct()
    {
        // Khởi tạo các rule mặc định
        $this->rules = [
            new KeywordInTitleRule(),
            new KeywordInDescriptionRule(),
            new KeywordDensityRule(),
            new InternalLinkRule(),
            new ImageAltRule()
        ];
    }

    public function analyze(string $title, string $content, string $focusKeyword): SeoAnalysisResult
    {
        $totalScore = 0;
        $maxScore = 0;
        $checks = [];
        $groupScores = [];

        foreach ($this->ruleGroups as $group => $ruleNames) {
            $groupScore = 0;
            $groupMaxScore = 0;

            foreach ($this->rules as $rule) {
                if (!$rule instanceof RuleInterface) continue;
                
                $result = $rule->check($title, $content, $focusKeyword);
                $checks[] = $result;
                
                if (in_array($result['rule'], $ruleNames)) {
                    $groupScore += $result['score'];
                    $groupMaxScore += 10; // Mỗi rule có tối đa 10 điểm
                }
            }

            $groupScores[$group] = [
                'score' => $groupScore,
                'max_score' => $groupMaxScore,
                'percentage' => $groupMaxScore > 0 ? ($groupScore / $groupMaxScore) * 100 : 0
            ];

            $totalScore += $groupScore;
            $maxScore += $groupMaxScore;
        }

        return new SeoAnalysisResult(
            $totalScore,
            $checks,
            $groupScores,
            $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0
        );
    }

    public function analyzeFromBlog(\App\Models\Blog $blog): SeoAnalysisResult
    {
        return $this->analyze(
            $blog->title,
            $blog->content,
            $blog->seo_title ?? ''
        );
    }

    public function getRuleGroups(): array
    {
        return $this->ruleGroups;
    }

    public function addRule(RuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }

    public function removeRule(string $ruleName): void
    {
        $this->rules = array_filter($this->rules, function($rule) use ($ruleName) {
            return !($rule instanceof RuleInterface && $rule->check('', '', '')['rule'] === $ruleName);
        });
    }
}
