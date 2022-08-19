<?php

declare(strict_types=1);

namespace App\Sanitizers;

class LineBreakToSpaceSanitizer
{
    public function lineBreakToSpace(string $subject): string
    {
        return \str_replace("\n", ' ', $subject);
    }
}
