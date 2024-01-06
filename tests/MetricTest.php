<?php

declare(strict_types=1);

namespace Arokettu\KiloMega\Tests;

use PHPUnit\Framework\TestCase;

use function Arokettu\KiloMega\format_metric;

class MetricTest extends TestCase
{
    public function testMetricPositiveScale(): void
    {
        self::assertEquals('1.0 B', format_metric(1));
        self::assertEquals('12.0 B', format_metric(12));
        self::assertEquals('123.0 B', format_metric(123));
        self::assertEquals('1.2 kB', format_metric(1234));
        self::assertEquals('12.3 kB', format_metric(12345));
        self::assertEquals('123.5 kB', format_metric(123456));
        self::assertEquals('1.2 MB', format_metric(1234567));
        self::assertEquals('12.3 MB', format_metric(12345678));
        self::assertEquals('123.5 MB', format_metric(123456789));
        self::assertEquals('1.2 GB', format_metric(1234567890));

        // all other prefixes
        self::assertEquals('1.2 TB', format_metric(1.234e12));
        self::assertEquals('1.2 PB', format_metric(1.234e15));
        self::assertEquals('1.2 EB', format_metric(1.234e18));
        self::assertEquals('1.2 ZB', format_metric(1.234e21));
        self::assertEquals('1.2 YB', format_metric(1.234e24));
        self::assertEquals('1.2 RB', format_metric(1.234e27)); // < 1024
        self::assertEquals('12.3 RB', format_metric(1.234e28));
        self::assertEquals('1.2 QB', format_metric(1.234e30)); // < 1024
        self::assertEquals('12.3 QB', format_metric(1.234e31));

        // max
        self::assertEquals('123.0 QB', format_metric(1.23e32));
        // over max
        self::assertEquals('1230000.0 QB', format_metric(1.23e36));
        self::assertEquals('12300000000.0 QB', format_metric(1.23e40)); // scale overflow
    }

    public function testMetricPositiveScaleFixed(): void
    {
        self::assertEquals('1.0 B', format_metric(1, fixedWidth: true));
        self::assertEquals('12 B', format_metric(12, fixedWidth: true));
        self::assertEquals('123 B', format_metric(123, fixedWidth: true));
        self::assertEquals('1.2 kB', format_metric(1234, fixedWidth: true));
        self::assertEquals('12 kB', format_metric(12345, fixedWidth: true));
        self::assertEquals('123 kB', format_metric(123456, fixedWidth: true));
        self::assertEquals('1.2 MB', format_metric(1234567, fixedWidth: true));
        self::assertEquals('12 MB', format_metric(12345678, fixedWidth: true));
        self::assertEquals('123 MB', format_metric(123456789, fixedWidth: true));
        self::assertEquals('1.2 GB', format_metric(1234567890, fixedWidth: true));

        // all other prefixes
        self::assertEquals('1.2 TB', format_metric(1.234e12, fixedWidth: true));
        self::assertEquals('1.2 PB', format_metric(1.234e15, fixedWidth: true));
        self::assertEquals('1.2 EB', format_metric(1.234e18, fixedWidth: true));
        self::assertEquals('1.2 ZB', format_metric(1.234e21, fixedWidth: true));
        self::assertEquals('1.2 YB', format_metric(1.234e24, fixedWidth: true));
        self::assertEquals('1.2 RB', format_metric(1.234e27, fixedWidth: true));
        self::assertEquals('12 RB', format_metric(1.234e28, fixedWidth: true));
        self::assertEquals('1.2 QB', format_metric(1.234e30, fixedWidth: true));
        self::assertEquals('12 QB', format_metric(1.234e31, fixedWidth: true));

        // max
        self::assertEquals('123 QB', format_metric(1.23e32, fixedWidth: true));
        // over max
        self::assertEquals('1230000 QB', format_metric(1.23e36, fixedWidth: true));
        // scale overflow
        self::assertEquals('12300000000 QB', format_metric(1.23e40, fixedWidth: true));
    }
}
