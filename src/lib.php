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

/**
 * @param int|float|numeric-string $number The number or numeric string being formatted
 * @param array $prefixes Array of prefixes, you can also redefine it for your localization
 * @param string $suffix Suffix
 * @param int $scaleBase Typically 1000 (SCALE_METRIC) or 1024 (SCALE_BINARY)
 * @param bool $onlyIntegers Do not expand into negative scales
 * @param bool $fixedWidth Output number will be 3 characters long (including dots)
 */
function format_metric(
    int|float|string $number,
    array $prefixes = SHORT_PREFIXES,
    string $suffix = 'B',
    string $separator = ' ',
    int $scaleBase = SCALE_METRIC,
    bool $onlyIntegers = false,
    bool $fixedWidth = false,
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
    } elseif ($scale < -10) {
        $scale = -10;
    }

    $value = $number / $scaleBase ** $scale;

    if ($fixedWidth && round($value) >= 1000 && $scale < 10) {
        $scale += 1;
        $value /= $scaleBase;
    }

    if ($onlyIntegers && $scale <= 0) {
        return sprintf("%.0f%s%s", $number, $separator, $suffix);
    }

    $prefix = $scale === 0 ? '' :
        $prefixes[$scale] ?? throw new \InvalidArgumentException('Missing prefix for scale ' . $scale);

    if ($fixedWidth && $value > 10) {
        return sprintf("%.0f%s%s%s", $value, $separator, $prefix, $suffix);
    }

    return sprintf("%.1f%s%s%s", $value, $separator, $prefix, $suffix);
}

/**
 * @param int|float|numeric-string $number The number or numeric string being formatted
 * @param array $prefixes Array of prefixes, you can also redefine it for your localization
 * @param string $suffix Suffix
 * @param bool $fixedWidth Output number will be 3 characters (including dots)
 */
function format_bytes(
    int|float|string $number,
    array $prefixes = SHORT_BINARY_PREFIXES,
    string $suffix = 'B',
    string $separator = ' ',
    bool $fixedWidth = false,
): string {
    return format_metric($number, $prefixes, $suffix, $separator, SCALE_BINARY, true, $fixedWidth);
}
