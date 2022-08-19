<?php

declare(strict_types=1);

namespace App\Sanitizers;

class UnderscoreToSpaceSanitizer
{
    public function underscoreToSpace(string $subject): string
    {
        return \str_replace('_', ' ', $subject);
    }
}
