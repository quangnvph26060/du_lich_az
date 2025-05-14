<?php

namespace App\RankmathSEOForLaravel\Services;

class HeadingStructureChecker
{
    public static function check(string $content): array
    {
        $h1Count = preg_match_all('/<h1[^>]*>/i', $content, $matches);

        return [
            'rule' => 'heading_structure',
            'score' => $h1Count === 1 ? 10 : 5,
            'passed' => $h1Count === 1,
            'message' => $h1Count === 1 ? 'Tốt' : 'Nên có đúng 1 thẻ <h1>'
        ];
    }
}
