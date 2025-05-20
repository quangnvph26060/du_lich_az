<?php

namespace App\RankmathSEOForLaravel\Rules;

class ContentLengthRule implements RuleInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $seoDescription): array
    {
        // Loại bỏ thẻ HTML để đếm số từ
        $textOnly = strip_tags($content);
        $wordCount = str_word_count($textOnly);

        if ($wordCount >= 600) {
            $status = 'success';
            $score = 10;
            $message = "Độ dài bài viết đạt với $wordCount từ.";
        } elseif ($wordCount >= 300) {
            $status = 'warning';
            $score = 5;
            $message = "Bài viết có $wordCount từ, nên viết thêm để đạt ít nhất 600 từ.";
        } else {
            $status = 'danger';
            $score = 0;
            $message = "Bài viết quá ngắn ($wordCount từ), không đạt chuẩn SEO.";
        }

        return [
            'rule' => 'content_length',
            'passed' => $status === 'success',
            'message' => $message,
            'score' => $score,
            'status' => $status,
        ];
    }
}
