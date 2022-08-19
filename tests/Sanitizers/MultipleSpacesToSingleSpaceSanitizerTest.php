<?php

declare(strict_types=1);

namespace Tests\App\Sanitizers;

use App\Sanitizers\MultipleSpacesToSingleSpaceSanitizer;
use PHPUnit\Framework\TestCase;

final class MultipleSpacesToSingleSpaceSanitizerTest extends TestCase
{
    public function testMultipleSpacesToSingleSpace(): void
    {
        $multipleSpacesToSingleSpaceSanitizer = new MultipleSpacesToSingleSpaceSanitizer();
        $result = $multipleSpacesToSingleSpaceSanitizer->multipleSpacesToSingleSpace('abc  def');
        self::assertSame('abc def', $result);
    }
}
