<?php

namespace App\RankmathSEOforLaravel\Services;

class KeywordDensityChecker
{
    public static function check(string $content, string $keyword): array
    {
        $wordCount = str_word_count(strip_tags($content));
        $keywordCount = substr_count(strtolower($content), strtolower($keyword));

        $density = $wordCount > 0 ? ($keywordCount / $wordCount) * 100 : 0;
        $passed = $density >= 1 && $density <= 3;

        return [
            'rule' => 'keyword_density',
            'score' => $passed ? 10 : 5,
            'passed' => $passed,
            'density' => round($density, 2)
        ];
    }
}

