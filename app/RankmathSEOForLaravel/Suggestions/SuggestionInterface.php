<?php

namespace App\RankmathSEOForLaravel\Suggestions;

interface SuggestionInterface
{
    public function check(string $title, string $content, string $focusKeyword, string $shortDescription, string $slug): array;

}