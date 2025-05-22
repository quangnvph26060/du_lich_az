<?php

namespace App\RankmathSEOForLaravel\Rules;


class KeywordInTitleRule implements RuleInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $seoDescription): array
    {
        $passed = !empty($focusKeyword) && !empty($seoTitle) && stripos($seoTitle, $focusKeyword) !== false;

        return [
            'rule' => 'focus_keyword_in_title',
            'passed' => $passed,
            'message' => $passed ? 'Từ khóa có trong tiêu đề SEO.' : 'Từ khóa không có trong tiêu đề SEO',
            'score' => $passed ? 10 : 0,
            'status' => $passed ? 'success' : 'danger',
            'suggestion' => $passed ? '' : 'Thêm từ khóa chính vào tiêu đề để tối ưu SEO.',
        ];
    }

}