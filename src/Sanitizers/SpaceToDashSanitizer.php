<?php

declare(strict_types=1);

namespace App\Sanitizers;

class SpaceToDashSanitizer
{
    public function spaceToDash(string $subject): string
    {
        return \str_replace(' ', '-', $subject);
    }
}
