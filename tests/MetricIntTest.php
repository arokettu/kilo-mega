<?php

declare(strict_types=1);

namespace Arokettu\KiloMega\Tests;

use PHPUnit\Framework\TestCase;

use function Arokettu\KiloMega\format_metric;

class MetricIntTest extends TestCase
{
    public function testBytes(): void
    {
        self::assertEquals('1 B', format_metric(1, onlyIntegers: true));
        self::assertEquals('12 B', format_metric(12, onlyIntegers: true));
        self::assertEquals('123 B', format_metric(123, onlyIntegers: true));
        self::assertEquals('1.2 kB', format_metric(1234, onlyIntegers: true));
        self::assertEquals('12.3 kB', format_metric(12345, onlyIntegers: true));
        self::assertEquals('123.5 kB', format_metric(123456, onlyIntegers: true));
        self::assertEquals('1.2 MB', format_metric(1234567, onlyIntegers: true));
        self::assertEquals('12.3 MB', format_metric(12345678, onlyIntegers: true));
        self::assertEquals('123.5 MB', format_metric(123456789, onlyIntegers: true));
        self::assertEquals('1.2 GB', format_metric(1234567890, onlyIntegers: true));

        // all other prefixes
        self::assertEquals('1.2 TB', format_metric(1.234e12, onlyIntegers: true));
        self::assertEquals('1.2 PB', format_metric(1.234e15, onlyIntegers: true));
        self::assertEquals('1.2 EB', format_metric(1.234e18, onlyIntegers: true));
        self::assertEquals('1.2 ZB', format_metric(1.234e21, onlyIntegers: true));
        self::assertEquals('1.2 YB', format_metric(1.234e24, onlyIntegers: true));
        self::assertEquals('1.2 RB', format_metric(1.234e27, onlyIntegers: true)); // < 1024
        self::assertEquals('12.3 RB', format_metric(1.234e28, onlyIntegers: true));
        self::assertEquals('1.2 QB', format_metric(1.234e30, onlyIntegers: true)); // < 1024
        self::assertEquals('12.3 QB', format_metric(1.234e31, onlyIntegers: true));

        // below 1 is 0
        self::assertEquals('0 B', format_metric(0.1, onlyIntegers: true));
        // max
        self::assertEquals('123.0 QB', format_metric(1.23e32, onlyIntegers: true));
        // over max
        self::assertEquals('1230000.0 QB', format_metric(1.23e36, onlyIntegers: true));
        self::assertEquals('12300000000.0 QB', format_metric(1.23e40, onlyIntegers: true)); // scale overflow
    }

    public function testBytesFixed(): void
    {
        self::assertEquals('1 B', format_metric(1, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('12 B', format_metric(12, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('123 B', format_metric(123, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 kB', format_metric(1234, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('12 kB', format_metric(12345, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('123 kB', format_metric(123456, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 MB', format_metric(1234567, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('12 MB', format_metric(12345678, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('123 MB', format_metric(123456789, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 GB', format_metric(1234567890, onlyIntegers: true, fixedWidth: true));

        // all other prefixes
        self::assertEquals('1.2 TB', format_metric(1.234e12, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 PB', format_metric(1.234e15, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 EB', format_metric(1.234e18, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 ZB', format_metric(1.234e21, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 YB', format_metric(1.234e24, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 RB', format_metric(1.234e27, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('12 RB', format_metric(1.234e28, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('1.2 QB', format_metric(1.234e30, onlyIntegers: true, fixedWidth: true));
        self::assertEquals('12 QB', format_metric(1.234e31, onlyIntegers: true, fixedWidth: true));

        // below 1 is 0
        self::assertEquals('0 B', format_metric(0.1, onlyIntegers: true, fixedWidth: true));
        // max
        self::assertEquals('123 QB', format_metric(1.23e32, onlyIntegers: true, fixedWidth: true));
        // over max
        self::assertEquals('1230000 QB', format_metric(1.23e36, onlyIntegers: true, fixedWidth: true));
        // scale overflow
        self::assertEquals('12300000000 QB', format_metric(1.23e40, onlyIntegers: true, fixedWidth: true));
    }
}
