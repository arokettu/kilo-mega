<?php

declare(strict_types=1);

namespace Arokettu\KiloMega\Tests;

use Arokettu\KiloMega as km;
use PHPUnit\Framework\TestCase;

class SettingsTest extends TestCase
{
    public function testPrefixes(): void
    {
        self::assertEquals('123.5 kB', km\format_metric(123456, prefixes: km\SHORT_PREFIXES));
        self::assertEquals('123.5 kiloB', km\format_metric(123456, prefixes: km\LONG_PREFIXES));
        self::assertEquals('123.5 kibiB', km\format_metric(123456, prefixes: km\LONG_BINARY_PREFIXES));
        self::assertEquals('123.5 KiB', km\format_metric(123456, prefixes: km\SHORT_BINARY_PREFIXES));
    }

    public function testSuffixes(): void
    {
        self::assertEquals('123.5 k', km\format_metric(123456, suffix: ''));
        self::assertEquals('123.5 kW', km\format_metric(123456, suffix: 'W'));
    }

    public function testSeparator(): void
    {
        self::assertEquals('123.5kB', km\format_metric(123456, separator: ''));
        self::assertEquals('123.5-kB', km\format_metric(123456, separator: '-'));
    }

    public function testTypes(): void
    {
        // int
        self::assertEquals('123.5 kB', km\format_metric(123456));
        // float
        self::assertEquals('123.5 B', km\format_metric(123.456));
        // int string
        self::assertEquals('123.5 kB', km\format_metric('123456'));
        // float string
        self::assertEquals('123.5 B', km\format_metric('123.456'));
    }
}
