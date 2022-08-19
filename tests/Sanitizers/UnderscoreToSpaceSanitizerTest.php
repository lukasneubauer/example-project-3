<?php

declare(strict_types=1);

namespace Tests\App\Sanitizers;

use App\Sanitizers\UnderscoreToSpaceSanitizer;
use PHPUnit\Framework\TestCase;

final class UnderscoreToSpaceSanitizerTest extends TestCase
{
    public function testUnderscoreToSpace(): void
    {
        $underscoreToSpaceSanitizer = new UnderscoreToSpaceSanitizer();
        $result = $underscoreToSpaceSanitizer->underscoreToSpace('abc_def');
        self::assertSame('abc def', $result);
    }
}
