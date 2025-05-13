<?php

namespace App\RankmathSEOForLaravel\Rules;

class KeywordDensityRule implements RuleInterface
{
    public function check(string $title, string $content, string $focusKeyword): array
    {
        $content = strip_tags($content);
        
        // Đếm tổng số từ
        $totalWords = str_word_count($content);
        
        // Đếm số lần xuất hiện từ khóa
        $keywordCount = substr_count(strtolower($content), strtolower($focusKeyword));
        
        // Tính mật độ từ khóa
        $density = ($keywordCount / $totalWords) * 100;
        
        // Kiểm tra mật độ từ khóa (0.5% - 2.5%)
        $isOptimal = $density >= 0.5 && $density <= 2.5;
        
        return [
            'rule' => 'keyword_density',
            'passed' => $isOptimal,
            'message' => $isOptimal ? 
                        "Mật độ từ khóa tối ưu ({$density}%)" : 
                        "Mật độ từ khóa {$density}% (nên từ 0.5% đến 2.5%)",
            'score' => $isOptimal ? 10 : 0,
            'suggestion' => $density < 0.5 ? 
                          'Tăng số lần xuất hiện từ khóa' : 
                          'Giảm số lần xuất hiện từ khóa'
        ];
    }
}
