<?php

declare(strict_types=1);

namespace App\Sanitizers;

class MultipleSpacesToSingleSpaceSanitizer
{
    public function multipleSpacesToSingleSpace(string $subject): string
    {
        return (string) \preg_replace('# +#', ' ', $subject);
    }
}
