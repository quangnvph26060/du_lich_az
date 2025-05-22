<?php

namespace App\RankmathSEOForLaravel\Rules;

class KeywordInDescriptionRule implements RuleInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $seoDescription): array
    {
        $description = trim(strip_tags($seoDescription ?? ''));

        if (empty($focusKeyword)) {
            return [
                'rule' => 'keyword_in_short_description',
                'passed' => false,
                'message' => 'Không có từ khóa để kiểm tra trong mô tả ngắn.',
                'score' => 0,
                'suggestion' => 'Nhập từ khóa chính để kiểm tra trong mô tả ngắn.',
                'status' => 'danger',
            ];
        }

        if (empty($description)) {
            return [
                'rule' => 'keyword_in_short_description',
                'passed' => false,
                'message' => 'Mô tả ngắn đang trống.',
                'score' => 0,
                'suggestion' => 'Viết mô tả ngắn và thêm từ khóa vào trong đó.',
                'status' => 'danger',
            ];
        }

        $hasKeyword = stripos(mb_strtolower($description), mb_strtolower($focusKeyword)) !== false;

        return [
            'rule' => 'keyword_in_short_description',
            'passed' => $hasKeyword,
            'message' => $hasKeyword
                ? 'Từ khóa có trong mô tả ngắn.'
                : 'Từ khóa chưa có trong mô tả ngắn.',
            'score' => $hasKeyword ? 10 : 0,
            'suggestion' => $hasKeyword ? '' : 'Thêm từ khóa vào mô tả ngắn để tăng tính liên quan.',
            'status' => $hasKeyword ? 'success' : 'danger',
        ];
    }
}
