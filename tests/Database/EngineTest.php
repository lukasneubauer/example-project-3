<?php

declare(strict_types=1);

namespace Tests\App\Database;

use App\Database\Engine;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

final class EngineTest extends TestCase
{
    public function testCreate(): void
    {
        $engine = new Engine();
        $finder = $engine->create();
        self::assertInstanceOf(Finder::class, $finder);
    }
}
