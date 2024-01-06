<?php

declare(strict_types=1);

namespace Arokettu\KiloMega\Tests;

use Arokettu\KiloMega as km;
use PHPUnit\Framework\TestCase;

class SettingsTest extends TestCase
{
    public function testPrefixes(): void
    {
        self::assertEquals('123 kB', km\format_metric(123456, prefixes: km\SHORT_PREFIXES));
        self::assertEquals('123 kiloB', km\format_metric(123456, prefixes: km\LONG_PREFIXES));
        self::assertEquals('123 kibiB', km\format_metric(123456, prefixes: km\LONG_BINARY_PREFIXES));
        self::assertEquals('123 KiB', km\format_metric(123456, prefixes: km\SHORT_BINARY_PREFIXES));
    }

    public function testSuffixes(): void
    {
        self::assertEquals('123 k', km\format_metric(123456, suffix: ''));
        self::assertEquals('123 kW', km\format_metric(123456, suffix: 'W'));
    }

    public function testSeparator(): void
    {
        self::assertEquals('123kB', km\format_metric(123456, separator: ''));
        self::assertEquals('123-kB', km\format_metric(123456, separator: '-'));
    }

    public function testTypes(): void
    {
        // int
        self::assertEquals('123 kB', km\format_metric(123456));
        // float
        self::assertEquals('123 B', km\format_metric(123.456));
        // int string
        self::assertEquals('123 kB', km\format_metric('123456'));
        // float string
        self::assertEquals('123 B', km\format_metric('123.456'));
    }

    public function testNonNumericString(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$number must be int, float, or numeric string');

        km\format_metric('zomg teh string');
    }

    public function testNegativeScaleBase(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$scaleBase must be an integer greater than 1');

        km\format_metric('123', scaleBase: -1);
    }

    public function testSign(): void
    {
        self::assertEquals('+123 B', km\format_metric(123.456, forceSign: true));
        self::assertEquals('-123 B', km\format_metric(-123.456, forceSign: true));
        self::assertEquals('0.00 B', km\format_metric(0, forceSign: true));
    }
}
