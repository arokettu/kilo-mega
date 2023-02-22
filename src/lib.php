<?php

declare(strict_types=1);

namespace Arokettu\KiloMega;

const SHORT_PREFIXES = [
    10 => 'Q',
    9 => 'R',
    8 => 'Y',
    7 => 'Z',
    6 => 'E',
    5 => 'P',
    4 => 'T',
    3 => 'G',
    2 => 'M',
    1 => 'k',
    -1 => 'm',
    -2 => 'μ',
    -3 => 'n',
    -4 => 'p',
    -5 => 'f',
    -6 => 'a',
    -7 => 'z',
    -8 => 'y',
    -9 => 'r',
    -10 => 'q',
];

const LONG_PREFIXES = [
    10 => 'quetta',
    9 => 'ronna',
    8 => 'yotta',
    7 => 'zetta',
    6 => 'exa',
    5 => 'peta',
    4 => 'tera',
    3 => 'giga',
    2 => 'mega',
    1 => 'kilo',
    -1 => 'milli',
    -2 => 'micro',
    -3 => 'nano',
    -4 => 'pico',
    -5 => 'femto',
    -6 => 'atto',
    -7 => 'zepto',
    -8 => 'yocto',
    -9 => 'ronto',
    -10 => 'quecto',
];

const LONG_BINARY_PREFIXES = [
    10 => 'quebi', // nonstandard
    9 => 'robi', // nonstandard
    8 => 'yobi',
    7 => 'zebi',
    6 => 'exbi',
    5 => 'pebi',
    4 => 'tebi',
    3 => 'gibi',
    2 => 'mebi',
    1 => 'kibi',
];

const SHORT_BINARY_PREFIXES = [
    10 => 'Qi',
    9 => 'Ri',
    8 => 'Yi',
    7 => 'Zi',
    6 => 'Ei',
    5 => 'Pi',
    4 => 'Ti',
    3 => 'Gi',
    2 => 'Mi',
    1 => 'Ki',
];

const SCALE_METRIC = 1000;
const SCALE_BINARY = 1024;

function format_metric(
    int|float|string $number,
    array $prefixes = SHORT_PREFIXES,
    string $suffix = 'B',
    int $scaleBase = SCALE_METRIC,
    bool $onlyIntegers = false,
): string {
    if (\is_string($number)) {
        if (is_numeric($number) === false) {
            throw new \InvalidArgumentException('$number must be int, float, or numeric string');
        }

        $number = \floatval($number);
    }
    if ($scaleBase < 1) {
        throw new \InvalidArgumentException('$scaleBase must be an integer greater than 1');
    }

    $scale = \intval(floor(log($number, $scaleBase)));

    if ($scale > 10) {
        $scale = 10;
    } elseif ($onlyIntegers && $scale <= 0) {
        return sprintf("%.0f %s", $number, $suffix);
    } elseif ($scale < -10) {
        $scale = -10;
    }

    $prefix = $scale === 0 ? '' :
        $prefixes[$scale] ?? throw new \InvalidArgumentException('Missing prefix for scale ' . $scale);

    $value = $number / $scaleBase ** $scale;

    return sprintf("%.1f %s%s", $value, $prefix, $suffix);
}

function format_bytes(int|float|string $number, array $prefixes = SHORT_BINARY_PREFIXES, string $suffix = 'B'): string
{
    return format_metric($number, $prefixes, $suffix, SCALE_BINARY, true);
}
