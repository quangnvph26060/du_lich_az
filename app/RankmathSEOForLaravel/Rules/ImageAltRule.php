<?php

namespace App\RankmathSEOForLaravel\Rules;

class ImageAltRule implements RuleInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $seoDescription): array
    {
        // Kiểm tra tất cả hình ảnh có alt text
        preg_match_all('/<img[^>]+>/', $content, $images);
        $hasImages = !empty($images[0]);
        $allImagesHaveAlt = true;

        if ($hasImages) {
            foreach ($images[0] as $img) {
                if (!preg_match('/alt=["\'][^"\']+["\']/', $img)) {
                    $allImagesHaveAlt = false;
                    break;
                }
            }
        }

        $passed = $hasImages && $allImagesHaveAlt;

        return [
            'rule' => 'image_alt',
            'passed' => $passed,
            'message' => !$hasImages
                ? 'Chưa có hình ảnh trong bài viết.'
                : ($allImagesHaveAlt ? 'Tất cả hình ảnh đều có alt text.' : 'Có hình ảnh chưa có alt text.'),
            'score' => $passed ? 10 : 0,
            'status' => !$hasImages ? 'danger' : ($allImagesHaveAlt ? 'success' : 'danger'),
            'suggestion' => !$hasImages
                ? 'Thêm hình ảnh để cải thiện nội dung bài viết.'
                : ($allImagesHaveAlt ? '' : 'Thêm alt text cho tất cả hình ảnh để cải thiện SEO.'),
        ];
    }
}
