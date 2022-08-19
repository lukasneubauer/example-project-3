<?php

declare(strict_types=1);

namespace Tests\App\Sanitizers;

use App\Sanitizers\NonAlphanumericAndNonSpaceCharactersRemovalSanitizer;
use PHPUnit\Framework\TestCase;

final class NonAlphanumericAndNonSpaceCharactersRemovalSanitizerTest extends TestCase
{
    public function testRemoveNonAlphanumericAndNonSpaceCharacters(): void
    {
        $nonAlphanumericAndNonSpaceCharactersRemovalSanitizer = new NonAlphanumericAndNonSpaceCharactersRemovalSanitizer();
        $result = $nonAlphanumericAndNonSpaceCharactersRemovalSanitizer->removeNonAlphanumericAndNonSpaceCharacters('+abc def+');
        self::assertSame('abc def', $result);
    }
}
