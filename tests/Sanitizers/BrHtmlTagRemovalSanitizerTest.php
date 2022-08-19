<?php

declare(strict_types=1);

namespace Tests\App\Sanitizers;

use App\Sanitizers\BrHtmlTagRemovalSanitizer;
use PHPUnit\Framework\TestCase;

final class BrHtmlTagRemovalSanitizerTest extends TestCase
{
    public function testRemoveBrHtmlTag(): void
    {
        $brHtmlTagRemovalSanitizer = new BrHtmlTagRemovalSanitizer();
        $result = $brHtmlTagRemovalSanitizer->removeBrHtmlTag('abc<br>def');
        self::assertSame('abcdef', $result);
    }
}
