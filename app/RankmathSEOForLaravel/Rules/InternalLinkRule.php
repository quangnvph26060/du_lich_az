<?php

namespace App\RankmathSEOForLaravel\Rules;

class InternalLinkRule implements RuleInterface
{
    public function check(string $title, string $content, string $focusKeyword): array
    {
        // Kiểm tra có ít nhất 1 internal link
        $hasInternalLink = preg_match('/<a[^>]+href=["\'](?!https?:\/\/)[^"\']+["\'][^>]*>/', $content);
        
        return [
            'rule' => 'internal_link',
            'passed' => $hasInternalLink,
            'message' => $hasInternalLink ? 'Đã có internal link trong bài viết' : 'Chưa có internal link trong bài viết',
            'score' => $hasInternalLink ? 10 : 0,
            'suggestion' => 'Thêm ít nhất 1 internal link để tăng tính liên kết'
        ];
    }
}
