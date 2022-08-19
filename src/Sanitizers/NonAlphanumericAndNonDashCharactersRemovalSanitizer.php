<?php

declare(strict_types=1);

namespace App\Sanitizers;

class NonAlphanumericAndNonDashCharactersRemovalSanitizer
{
    public function removeNonAlphanumericAndNonDashCharacters(string $subject): string
    {
        return (string) \preg_replace('#[^0-9A-Za-z-]#', '', $subject);
    }
}
