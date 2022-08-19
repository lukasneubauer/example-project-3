<?php

declare(strict_types=1);

namespace Tests\App\Sanitizers;

use App\Sanitizers\ToLowercaseSanitizer;
use PHPUnit\Framework\TestCase;

final class ToLowercaseSanitizerTest extends TestCase
{
    public function testToLowercase(): void
    {
        $toLowercaseSanitizer = new ToLowercaseSanitizer();
        $result = $toLowercaseSanitizer->toLowercase('ABC-DEF');
        self::assertSame('abc-def', $result);
    }
}
