<?php
namespace App\RankmathSEOforLaravel\Services;

class ScoreCalculator
{
    public static function calculate(array $checks): array
    {
        $total = 0;
        $max = count($checks) * 10;

        foreach ($checks as $check) {
            $total += $check['score'];
        }

        return [
            'total_score' => $total,
            'max_score' => $max,
            'percentage' => $max > 0 ? ($total / $max) * 100 : 0
        ];
    }
}
