<?php

declare(strict_types=1);

namespace Tests\App\Database;

use App\Database\Configuration;
use PHPUnit\Framework\TestCase;

final class ConfigurationTest extends TestCase
{
    public function testGetPath(): void
    {
        $configuration = new Configuration('/path/to/directory');
        $path = $configuration->getPath();
        self::assertSame('/path/to/directory', $path);
    }
}
