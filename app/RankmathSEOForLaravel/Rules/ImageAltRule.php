<?php

namespace App\RankmathSEOForLaravel\Rules;

class ImageAltRule implements RuleInterface
{
    public function check(string $title, string $content, string $focusKeyword): array
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
        
        return [
            'rule' => 'image_alt',
            'passed' => $hasImages && $allImagesHaveAlt,
            'message' => !$hasImages ? 'Chưa có hình ảnh trong bài viết' : 
                        ($allImagesHaveAlt ? 'Tất cả hình ảnh đều có alt text' : 'Có hình ảnh chưa có alt text'),
            'score' => ($hasImages && $allImagesHaveAlt) ? 10 : 0,
            'suggestion' => 'Thêm alt text cho tất cả hình ảnh'
        ];
    }
}
