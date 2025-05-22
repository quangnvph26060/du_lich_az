<?php

namespace App\RankmathSEOForLaravel\Suggestions;

class UrlLengthSuggestion implements SuggestionInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $seoDescription, string $slug): array
    {
        $length = strlen($slug);

        if ($length > 75) {
            $status = 'warning';
            $passed = true;
            $score = 5;
        } elseif ($length > 0 && $length <= 75) {
            $status = 'success';
            $passed = false;
            $score = 10; 
        } else {
            $status = 'danger';
            $passed = false;
            $score = 0;
        }

        return [
            'rule' => 'url_length',
            'passed' => $passed,
            'score' => $score,
            'message' => match ($status) {
                'success' => "Chiều dài URL hợp lý: {$length} ký tự",
                'warning' => "Chiều dài URL là {$length} ký tự (tốt nhất nên đạt tối đa 75 ký tự)",
                'danger' => $length === 0
                    ? "Slug không được để trống."
                    : "Chiều dài URL là {$length} ký tự (nên ≤ 75)",
            },
            'suggestion' => match ($status) {
                'success' => '',
                'warning' => 'Bạn có thể tận dụng thêm độ dài để đưa thêm từ khóa vào slug (tối đa 75 ký tự).',
                'danger' => $length === 0
                    ? 'Bạn cần nhập slug để URL hoạt động chính xác.'
                    : 'Bạn nên rút gọn slug để tối ưu URL cho SEO (≤ 75 ký tự).',
            },
            'status' => $status,
        ];
    }
}
