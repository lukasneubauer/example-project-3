<?php

declare(strict_types=1);

namespace Tests\App\Sanitizers;

use App\Sanitizers\LineBreakToSpaceSanitizer;
use PHPUnit\Framework\TestCase;

final class LineBreakToSpaceSanitizerTest extends TestCase
{
    public function testLineBreakToSpace(): void
    {
        $lineBreakToSpaceSanitizer = new LineBreakToSpaceSanitizer();
        $result = $lineBreakToSpaceSanitizer->lineBreakToSpace("abc\ndef");
        self::assertSame('abc def', $result);
    }
}
