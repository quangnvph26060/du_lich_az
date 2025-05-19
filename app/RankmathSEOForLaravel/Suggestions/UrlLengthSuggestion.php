<?php

namespace App\RankmathSEOForLaravel\Suggestions;

class UrlLengthSuggestion implements SuggestionInterface
{
    public function check(string $title, string $content, string $focusKeyword, string $shortDescription, string $slug): array
    {
        $length = strlen($slug);

        $passed = $length <= 75;
        $score = $passed ? 10 : 0;

        return [
            'rule' => 'url_length',
            'passed' => $passed,
            'score' => $score,
            'message' => $passed
                ? "Chiều dài URL hợp lý: {$length} ký tự"
                : "Chiều dài URL là {$length} ký tự (nên ≤ 75)",
            'suggestion' => $passed
                ? ''
                : 'Bạn nên rút gọn slug để tối ưu URL cho SEO (≤ 75 ký tự).',
            'status' => $passed ? 'success' : 'warning',
        ];
    }
}

