<?php

namespace App\RankmathSEOForLaravel\Rules;

class KeywordInDescriptionRule implements RuleInterface
{
    public function check(string $title, string $content, string $focusKeyword): array
    {
        // Lấy meta description từ content
        preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\']([^"\']+)["\'][^>]*>/', $content, $matches);
        $description = $matches[1] ?? '';
        
        // Kiểm tra từ khóa có trong description không
        $hasKeyword = stripos($description, $focusKeyword) !== false;
        
        return [
            'rule' => 'keyword_in_description',
            'passed' => $hasKeyword,
            'message' => $hasKeyword ? 
                        'Từ khóa có trong meta description' : 
                        'Từ khóa chưa có trong meta description',
            'score' => $hasKeyword ? 10 : 0,
            'suggestion' => 'Thêm từ khóa vào meta description để tăng tính liên quan'
        ];
    }
}
