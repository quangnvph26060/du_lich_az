<?php

namespace App\RankmathSEOForLaravel\Rules;

class KeywordPositionRule implements RuleInterface
{
    public function check(string $title, string $content, string $focusKeyword): array
    {
        $content = strip_tags($content);
        $content = trim($content);

        if (empty($focusKeyword)) {
            return [
                'rule' => 'keyword_position',
                'passed' => false,
                'message' => 'Không có từ khóa để kiểm tra vị trí.',
                'score' => 0,
                'suggestion' => 'Hãy nhập từ khóa chính.',
                'status' => 'warning',
            ];
        }

        $length = mb_strlen($content);
        $firstTenPercent = mb_substr($content, 0, intval($length * 0.1));
        $found = mb_stripos($firstTenPercent, $focusKeyword) !== false;

        return [
            'rule' => 'keyword_position',
            'passed' => $found,
            'message' => $found
                ? 'Từ khóa xuất hiện trong 10% đầu nội dung.'
                : 'Từ khóa không xuất hiện trong 10% đầu nội dung.',
            'score' => $found ? 10 : 0,
            'suggestion' => $found ? '' : 'Đưa từ khóa vào đoạn đầu bài viết.',
            'status' => $found ? 'success' : 'warning',
        ];
    }
}