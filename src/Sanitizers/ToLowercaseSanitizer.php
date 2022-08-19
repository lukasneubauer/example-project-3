<?php

declare(strict_types=1);

namespace App\Sanitizers;

class ToLowercaseSanitizer
{
    public function toLowercase(string $subject): string
    {
        return \strtolower($subject);
    }
}
