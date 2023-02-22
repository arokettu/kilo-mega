# KiloMega

[![Packagist](https://img.shields.io/packagist/v/arokettu/kilo-mega.svg?style=flat-square)](https://packagist.org/packages/arokettu/kilo-mega)
[![PHP](https://img.shields.io/packagist/php-v/arokettu/kilo-mega.svg?style=flat-square)](https://packagist.org/packages/arokettu/kilo-mega)
[![Packagist](https://img.shields.io/github/license/arokettu/kilo-mega.svg?style=flat-square)][MIT License]

A metric formatter for PHP.

## Installation

```bash
composer require 'arokettu/kilo-mega'
```

## Documentation 

### Formatting a metric value

```php
<?php
use function \Arokettu\KiloMega\format_metric;
echo format_metric(1000, suffix: 'W'); // 1.0 kW
```

### Formatting a byte or bit value

```php
<?php
use function \Arokettu\KiloMega\format_bytes;
echo format_bytes(1234); // 1.2 KiB
```

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/kilo-mega/-/issues>

Feel free to ask any questions in our room on Gitter: <https://gitter.im/arokettu/community>

## License

The library is available as open source under the terms of the [MIT License].

[MIT License]: LICENSE.md
