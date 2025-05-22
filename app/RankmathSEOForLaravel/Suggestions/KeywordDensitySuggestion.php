<?php

namespace App\RankmathSEOForLaravel\Suggestions;
use App\RankmathSEOForLaravel\Suggestions\SuggestionInterface;

class KeywordDensitySuggestion implements SuggestionInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $seoDescription, string $slug): array
    {
        $content = strip_tags($content);
        $content = trim($content);

        $wordsArray = preg_split('/\s+/u', $content);
        $totalWords = count($wordsArray);

        if (empty($focusKeyword) || $totalWords === 0) {
            return [
                'rule' => 'keyword_density',
                'passed' => false,
                'message' => 'Từ khóa hoặc nội dung không hợp lệ để tính mật độ từ khóa.',
                'score' => 0,
                'suggestion' => 'Vui lòng cung cấp từ khóa và nội dung hợp lệ.',
                'status' => 'danger',
            ];
        }

        $pattern = '/\b' . preg_quote(mb_strtolower($focusKeyword), '/') . '\b/u';
        preg_match_all($pattern, mb_strtolower($content), $matches);
        $keywordCount = count($matches[0]);

        $density = ($keywordCount / $totalWords) * 100;
        $isOptimal = $density >= 0.5 && $density <= 2.5;

        $message = $isOptimal
            ? "Mật độ từ khóa tối ưu (" . rtrim(rtrim(number_format($density, 2), '0'), '.') . "%)"
            : "Mật độ từ khóa " . rtrim(rtrim(number_format($density, 2), '0'), '.') . "% (nên từ 0.5% đến 2.5%)";

        return [
            'rule' => 'keyword_density',
            'passed' => $isOptimal,
            'message' => $message,
            'score' => $isOptimal ? 10 : 0,
            'suggestion' => !$isOptimal
                ? ($density < 0.5 ? 'Tăng số lần xuất hiện từ khóa' : 'Giảm số lần xuất hiện từ khóa')
                : '',
            'status' => $isOptimal ? 'success' : 'danger',
        ];
    }
}
