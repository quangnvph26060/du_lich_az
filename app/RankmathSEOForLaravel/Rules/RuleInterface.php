<?php

namespace App\RankmathSEOForLaravel\Rules;

interface RuleInterface
{
    public function check(string $title, string $content, string $focusKeyword): array;

}