<?php

declare(strict_types=1);

namespace Tests\App\Sanitizers;

use App\Sanitizers\SpaceToDashSanitizer;
use PHPUnit\Framework\TestCase;

final class SpaceToDashSanitizerTest extends TestCase
{
    public function testSpaceToDash(): void
    {
        $spaceToDashSanitizer = new SpaceToDashSanitizer();
        $result = $spaceToDashSanitizer->spaceToDash('abc def');
        self::assertSame('abc-def', $result);
    }
}
