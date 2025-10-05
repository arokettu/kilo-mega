<?php

/**
 * @copyright 2023 Anton Smirnov
 * @license MIT https://spdx.org/licenses/MIT.html
 */

declare(strict_types=1);

namespace Arokettu\KiloMega\Tests;

use PHPUnit\Framework\TestCase;
use ValueError;

use function Arokettu\KiloMega\format_metric;

final class SpecialFloatsTest extends TestCase
{
    public function testNaN(): void
    {
        $this->expectException(ValueError::class);
        $this->expectExceptionMessage('$number must be a finite value');

        format_metric(NAN);
    }

    public function testInf(): void
    {
        $this->expectException(ValueError::class);
        $this->expectExceptionMessage('$number must be a finite value');

        format_metric(INF);
    }

    public function testNegInf(): void
    {
        $this->expectException(ValueError::class);
        $this->expectExceptionMessage('$number must be a finite value');

        format_metric(-INF);
    }

    public function testZero(): void
    {
        self::assertEquals('0.00 B', format_metric(0)); // int
        self::assertEquals('0.00 B', format_metric(0.0)); // float
        self::assertEquals('0.00 B', format_metric(-0.0)); // negative float
        self::assertEquals('0.00 B', format_metric('0')); // string int
        self::assertEquals('0.00 B', format_metric('0.0')); // string float
        self::assertEquals('0.00 B', format_metric('-0.0')); // negative string float
    }
}
