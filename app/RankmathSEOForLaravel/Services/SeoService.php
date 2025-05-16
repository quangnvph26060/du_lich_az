<?php

namespace App\RankmathSEOForLaravel\Services;

use Illuminate\Support\Str;

class SeoService
{
    /**
     * Tạo meta title từ tiêu đề
     */
    public function generateMetaTitle(string $title, int $maxLength = 60): string
    {
        return Str::limit($title, $maxLength);
    }

    /**
     * Tạo meta description từ nội dung
     */
    public function generateMetaDescription(string $content, int $maxLength = 160): string
    {
        // Loại bỏ HTML tags
        $content = strip_tags($content);
        // Loại bỏ khoảng trắng thừa
        $content = preg_replace('/\s+/', ' ', $content);
        return Str::limit($content, $maxLength);
    }

    /**
     * Tạo slug từ tiêu đề
     */
    public function generateSlug(string $title): string
    {
        // Thay thế tiếng Việt có dấu thành không dấu
        $slug = Str::slug($title, '-');
        return $slug;
    }


    /**
     * Tạo keywords từ nội dung
     */
    public function generateKeywords(string $content, int $maxKeywords = 5): array
    {
        // Loại bỏ HTML tags
        $content = strip_tags($content);
        // Loại bỏ các ký tự đặc biệt
        $content = preg_replace('/[^\p{L}\p{N}\s]/u', '', $content);
        // Chuyển về chữ thường
        $content = mb_strtolower($content);
        // Tách thành từng từ
        $words = explode(' ', $content);
        // Đếm tần suất xuất hiện của từng từ
        $wordCount = array_count_values($words);
        // Sắp xếp theo tần suất giảm dần
        arsort($wordCount);
        // Lấy top keywords
        return array_slice(array_keys($wordCount), 0, $maxKeywords);
    }

    /**
     * Kiểm tra độ dài meta title
     */
    public function checkMetaTitleLength(string $title): array
    {
        $length = mb_strlen($title);
        return [
            'length' => $length,
            'is_optimal' => $length >= 30 && $length <= 60,
            'message' => $length < 30 ? 'Meta title quá ngắn' : ($length > 60 ? 'Meta title quá dài' : 'Meta title tối ưu')
        ];
    }

    /**
     * Kiểm tra độ dài meta description
     */
    public function checkMetaDescriptionLength(string $description): array
    {
        $length = mb_strlen($description);
        return [
            'length' => $length,
            'is_optimal' => $length >= 120 && $length <= 160,
            'message' => $length < 120 ? 'Meta description quá ngắn' : ($length > 160 ? 'Meta description quá dài' : 'Meta description tối ưu')
        ];
    }

    /**
     * Kiểm tra mật độ từ khóa
     */
    public function checkKeywordDensity(string $content, string $keyword): array
    {
        $contentLower = mb_strtolower($content);
        $keywordLower = mb_strtolower($keyword);

        $totalWords = preg_match_all('/\p{L}+/u', strip_tags($content), $matches);
        $keywordCount = substr_count($contentLower, $keywordLower);

        $density = $totalWords > 0 ? ($keywordCount / $totalWords) * 100 : 0;

        return [
            'density' => round($density, 2),
            'is_optimal' => $density >= 0.5 && $density <= 2.5,
            'message' => $density < 0.5 ? 'Mật độ từ khóa quá thấp' : ($density > 2.5 ? 'Mật độ từ khóa quá cao' : 'Mật độ từ khóa tối ưu')
        ];
    }

}