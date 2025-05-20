<?php

namespace App\RankmathSEOForLaravel\Rules;

interface RuleInterface
{
    public function check(string $seoTitle, string $content, string $focusKeyword, string $seoDescription): array;

}