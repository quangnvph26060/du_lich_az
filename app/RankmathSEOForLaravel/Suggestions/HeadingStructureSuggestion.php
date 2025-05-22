<?php

namespace App\RankmathSEOForLaravel\Suggestions;

use App\RankmathSEOForLaravel\Suggestions\SuggestionInterface;

class HeadingStructureSuggestion implements SuggestionInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $seoDescription, string $slug): array
    {
        $h1Count = preg_match_all('/<h1[^>]*>/i', $content, $matches);

        $passed = $h1Count === 1;
        $score = $passed ? 10 : 0;

        return [
            'rule' => 'heading_structure',
            'passed' => $passed,
            'score' => $score,
            'message' => $passed ? 'Cấu trúc thẻ heading hợp lý (1 thẻ <h1>)' : "Tìm thấy {$h1Count} thẻ <h1> (nên có đúng 1 thẻ)",
            'suggestion' => $passed ? '' : 'Nên đảm bảo chỉ có duy nhất 1 thẻ <h1> trong nội dung.',
            'status' => $passed ? 'success' : 'danger',
        ];
    }
}
