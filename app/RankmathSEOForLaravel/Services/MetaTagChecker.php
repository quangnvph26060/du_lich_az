<?php
namespace App\RankmathSEOForLaravel\Services;

class MetaTagChecker
{
    public static function check(string $title, string $description, string $keyword): array
    {
        $titleHasKeyword = stripos($title, $keyword) !== false;
        $descHasKeyword = stripos($description, $keyword) !== false;

        return [
            [
                'rule' => 'keyword_in_title',
                'score' => $titleHasKeyword ? 10 : 0,
                'passed' => $titleHasKeyword,
            ],
            [
                'rule' => 'keyword_in_description',
                'score' => $descHasKeyword ? 10 : 0,
                'passed' => $descHasKeyword,
            ]
        ];
    }
}
