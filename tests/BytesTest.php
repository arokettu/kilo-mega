<?php

declare(strict_types=1);

namespace Arokettu\KiloMega\Tests;

use PHPUnit\Framework\TestCase;

use function Arokettu\KiloMega\format_bytes;

class BytesTest extends TestCase
{
    public function testBytes(): void
    {
        self::assertEquals('1 B', format_bytes(1));
    }
}
