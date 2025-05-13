<?php

namespace App\RankmathSEOForLaravel\DTO;

class SeoAnalysisResult
{
    public float $score;
    public array $checks;
    public array $groupScores;
    public float $percentage;

    public function __construct(float $score, array $checks, array $groupScores, float $percentage)
    {
        $this->score = $score;
        $this->checks = $checks;
        $this->groupScores = $groupScores;
        $this->percentage = $percentage;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function getChecks(): array
    {
        return $this->checks;
    }

    public function getGroupScores(): array
    {
        return $this->groupScores;
    }

    public function getPercentage(): float
    {
        return $this->percentage;
    }

    public function getPassedChecks(): array
    {
        return array_filter($this->checks, function($check) {
            return $check['passed'];
        });
    }

    public function getFailedChecks(): array
    {
        return array_filter($this->checks, function($check) {
            return !$check['passed'];
        });
    }

    public function getSuggestions(): array
    {
        return array_map(function($check) {
            return $check['suggestion'];
        }, $this->getFailedChecks());
    }
}