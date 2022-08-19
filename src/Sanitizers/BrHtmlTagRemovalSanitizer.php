<?php

declare(strict_types=1);

namespace App\Sanitizers;

class BrHtmlTagRemovalSanitizer
{
    public function removeBrHtmlTag(string $subject): string
    {
        return \str_replace('<br>', '', $subject);
    }
}
