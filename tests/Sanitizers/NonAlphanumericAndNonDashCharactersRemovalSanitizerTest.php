<?php

declare(strict_types=1);

namespace Tests\App\Sanitizers;

use App\Sanitizers\NonAlphanumericAndNonDashCharactersRemovalSanitizer;
use PHPUnit\Framework\TestCase;

final class NonAlphanumericAndNonDashCharactersRemovalSanitizerTest extends TestCase
{
    public function testRemoveNonAlphanumericAndNonDashCharacters(): void
    {
        $nonAlphanumericAndNonDashCharactersRemovalSanitizer = new NonAlphanumericAndNonDashCharactersRemovalSanitizer();
        $result = $nonAlphanumericAndNonDashCharactersRemovalSanitizer->removeNonAlphanumericAndNonDashCharacters('+abc-def+');
        self::assertSame('abc-def', $result);
    }
}
