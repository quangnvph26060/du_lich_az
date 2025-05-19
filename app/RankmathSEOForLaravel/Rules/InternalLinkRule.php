<?php

namespace App\RankmathSEOForLaravel\Rules;

class InternalLinkRule implements RuleInterface
{
    public function check(string $title, string $content, string $focusKeyword, string $shortDescription): array
    {
        $decodedContent = html_entity_decode($content);

        preg_match_all('/<a[^>]+href=["\']([^"\']+)["\']/', $decodedContent, $matches);

        $hasAnyLink = !empty($matches[1]);

        return [
            'rule' => 'internal_link',
            'passed' => $hasAnyLink,
            'message' => $hasAnyLink ? 'Đã có liên kết trong bài viết.' : 'Chưa có liên kết trong bài viết.',
            'score' => $hasAnyLink ? 10 : 0,
            'status' => $hasAnyLink ? 'success' : 'danger',
            'suggestion' => $hasAnyLink ? '' : 'Thêm ít nhất 1 liên kết để tăng giá trị SEO cho bài viết.',
        ];
    }
}
