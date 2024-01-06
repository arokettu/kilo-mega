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
        self::assertEquals('12 B', format_bytes(12));
        self::assertEquals('123 B', format_bytes(123));
        self::assertEquals('1.2 KiB', format_bytes(1234));
        self::assertEquals('12.1 KiB', format_bytes(12345));
        self::assertEquals('120.6 KiB', format_bytes(123456));
        self::assertEquals('1.2 MiB', format_bytes(1234567));
        self::assertEquals('11.8 MiB', format_bytes(12345678));
        self::assertEquals('117.7 MiB', format_bytes(123456789));
        self::assertEquals('1.1 GiB', format_bytes(1234567890));

        // all other prefixes
        self::assertEquals('1.1 TiB', format_bytes(1.234e12));
        self::assertEquals('1.1 PiB', format_bytes(1.234e15));
        self::assertEquals('1.1 EiB', format_bytes(1.234e18));
        self::assertEquals('1.0 ZiB', format_bytes(1.234e21));
        self::assertEquals('1.0 YiB', format_bytes(1.234e24));
        self::assertEquals('1020.7 YiB', format_bytes(1.234e27)); // < 1024
        self::assertEquals('10.0 RiB', format_bytes(1.234e28));
        self::assertEquals('996.8 RiB', format_bytes(1.234e30)); // < 1024
        self::assertEquals('9.7 QiB', format_bytes(1.234e31));

        // below 1 is 0
        self::assertEquals('0 B', format_bytes(0.1));
        // max
        self::assertEquals('97.0 QiB', format_bytes(1.23e32));
        // over max
        self::assertEquals('970298.9 QiB', format_bytes(1.23e36));
    }
}
