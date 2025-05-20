<?php

namespace App\RankmathSEOForLaravel\Services;

use App\RankmathSEOForLaravel\DTO\SeoAnalysisResult;
use App\RankmathSEOForLaravel\Rules\ContentLengthRule;
use App\RankmathSEOForLaravel\Rules\KeywordInTitleRule;
use App\RankmathSEOForLaravel\Rules\RuleInterface;
use App\RankmathSEOForLaravel\Rules\KeywordInDescriptionRule;
use App\RankmathSEOForLaravel\Rules\InternalLinkRule;
use App\RankmathSEOForLaravel\Rules\ImageAltRule;
use App\RankmathSEOForLaravel\Rules\KeywordInSlugRule;
use App\RankmathSEOForLaravel\Rules\KeywordPositionRule;
use App\RankmathSEOForLaravel\Suggestions\HeadingStructureSuggestion;
use App\RankmathSEOForLaravel\Suggestions\KeywordDensitySuggestion;
use App\RankmathSEOForLaravel\Suggestions\SuggestionInterface;
use App\RankmathSEOForLaravel\Suggestions\UrlLengthSuggestion;

class SeoAnalyzer
{
    protected array $rules = [];
    protected array $ruleGroups = [
        'basic' => [
            'focus_keyword_in_title',
            'keyword_density',
            'keyword_in_slug',
            'keyword_position',
            'keyword_in_short_description',
        ],
        'content' => [
            'internal_link',
            'image_alt',
            'content_length',

        ],
    ];

    public function __construct()
    {
        $this->rules = [

            // Rules
            new KeywordInTitleRule(),
            new KeywordInDescriptionRule(),
            new InternalLinkRule(),
            new ImageAltRule(),
            new KeywordPositionRule(),
            new KeywordInSlugRule(),
            new ContentLengthRule(),

            // Suggesstion
            new KeywordDensitySuggestion(),
            new HeadingStructureSuggestion(),
            new UrlLengthSuggestion(),
        ];
    }

    public function analyze(string $seoTitle = '', string $content ='', string $focusKeyword = '', string $seoDescription = '', string $slug= ''): SeoAnalysisResult
    {
        $checks = [];
        $suggestions = [];

        $validRules = array_filter($this->rules, fn($r) => $r instanceof RuleInterface);
        $suggestionRules = array_filter($this->rules, fn($r) => $r instanceof SuggestionInterface);

        $groupScores = [
            'basic' => ['score' => 0, 'max_score' => 0],
            'content' => ['score' => 0, 'max_score' => 0],
        ];

        foreach ($validRules as $rule) {
            $result = $rule->check($seoTitle, $content, $focusKeyword, $seoDescription);
            $checks[] = $result;

            foreach ($this->ruleGroups as $group => $ruleNames) {
                if (in_array($result['rule'], $ruleNames)) {
                    $groupScores[$group]['score'] += $result['score'];
                    $groupScores[$group]['max_score'] += 10;
                }
            }
        }

        foreach ($groupScores as &$group) {
            $group['percentage'] = $group['max_score'] > 0
                ? ($group['score'] / $group['max_score']) * 100
                : 0;
        }
        unset($group);

        $totalScore = array_sum(array_column($groupScores, 'score'));
        $maxScore = array_sum(array_column($groupScores, 'max_score'));

        foreach ($suggestionRules as $suggestionRule) {
            $result = $suggestionRule->check($seoTitle, $content, $focusKeyword, $seoDescription, $slug);
            $suggestions[] = $result;
        }

        return new SeoAnalysisResult(
            $totalScore,
            $checks,
            $groupScores,
            $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0,
            $suggestions,
        );
    }


    public function analyzeFromBlog(\App\Models\Blog $blog): SeoAnalysisResult
    {
        return $this->analyze(
            $blog->title,
            $blog->content,
            $blog->seo_title ?? '',
            $blog->short_description ?? '',
            $blog->slug,

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


}

