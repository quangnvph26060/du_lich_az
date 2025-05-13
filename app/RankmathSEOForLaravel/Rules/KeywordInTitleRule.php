<?php

namespace App\RankmathSEOForLaravel\Rules;


class KeywordInTitleRule implements RuleInterface
{
    public function check(string $title, string $content, string $focusKeyword): array
    {
        $passed = stripos($title, $focusKeyword) !== false;

        return [
            'rule' => 'focus_keyword_in_title',
            'passed' => $passed,
            'message' => $passed ? 'Từ khóa có trong tiêu đề.' : 'Từ khóa không có trong tiêu đề',
            'score' => $passed ? 10 : 0,
        ];
    }
}