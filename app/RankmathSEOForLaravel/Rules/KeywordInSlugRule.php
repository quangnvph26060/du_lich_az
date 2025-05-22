<?php

namespace App\RankmathSEOForLaravel\Rules;

class KeywordInSlugRule implements RuleInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $slug): array
    {
        // Chuẩn hóa slug và từ khóa
        $normalizedSlug = $this->normalize($slug);
        $normalizedKeyword = $this->normalize($focusKeyword);

        $hasKeywordInSlug = !empty($normalizedSlug) && !empty($normalizedKeyword) && strpos($normalizedSlug, $normalizedKeyword) !== false;

        return [
            'rule' => 'keyword_in_slug',
            'passed' => $hasKeywordInSlug,
            'message' => $hasKeywordInSlug ? 'Từ khóa đã có trong đường dẫn (slug).' : 'Từ khóa chưa có trong đường dẫn (slug).',
            'score' => $hasKeywordInSlug ? 10 : 0,
            'status' => $hasKeywordInSlug ? 'success' : 'danger',
            'suggestion' => $hasKeywordInSlug ? '' : 'Thêm từ khóa chính vào slug để cải thiện SEO.',
        ];
    }

    // Chuẩn hóa: lowercase, trim, thay khoảng trắng thành dấu '-'
    private function normalize(string $text): string
    {
        $text = strtolower($text);
        $text = trim($text);
        $text = preg_replace('/\s+/', '-', $text);
        $text = $this->removeVietnameseAccents($text);
        return $text;
    }

    // Bỏ dấu tiếng Việt
    private function removeVietnameseAccents(string $str): string
    {
        $accents = [
            'a' => '/[àáạảãâầấậẩẫăằắặẳẵ]/u',
            'e' => '/[èéẹẻẽêềếệểễ]/u',
            'i' => '/[ìíịỉĩ]/u',
            'o' => '/[òóọỏõôồốộổỗơờớợởỡ]/u',
            'u' => '/[ùúụủũưừứựửữ]/u',
            'y' => '/[ỳýỵỷỹ]/u',
            'd' => '/[đ]/u',
        ];
        foreach ($accents as $nonAccent => $accentRegex) {
            $str = preg_replace($accentRegex, $nonAccent, $str);
        }
        return $str;
    }
}
