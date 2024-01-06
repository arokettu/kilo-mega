KiloMega
########

.. highlight:: php

|Packagist| |GitLab| |GitHub| |Bitbucket| |Gitea|

A metric formatter for PHP.

Installation
============

.. code-block:: bash

   composer require arokettu/kilo-mega

Documentation
=============

Formatting a metric value
-------------------------

::

    <?php
    use function \Arokettu\KiloMega\format_metric;
    echo format_metric(1000, suffix: 'W'); // 1.00 kW

Formatting a byte or bit value
------------------------------

::

    <?php
    use function \Arokettu\KiloMega\format_bytes;
    echo format_bytes(1234); // 1.23 KiB
    // equivalent to
    use function \Arokettu\KiloMega as km;
    echo format_metric(
        1234,
        prefixes: km\SHORT_BINARY_PREFIXES, // changed default
        scale: km\SCALE_BINARY, // hardcoded
        onlyIntegers: true, // hardcoded
    );

Parameters
----------

.. warning::
    Using named parameters is strongly recommended.
    Param ordering is not guaranteed.

``$prefixes``
    Unit preferences:

    * ``SHORT_PREFIXES``. 'k', 'M', 'G', ...
    * ``LONG_PREFIXES``. 'kilo', 'mega', 'giga', ...
    * ``SHORT_BINARY_PREFIXES`` (only int). 'Ki', 'Mi', 'Gi', ...
    * ``LONG_BINARY_PREFIXES`` (only int). 'kibi', 'mebi', 'gibi', ...
    * Custom prefixes: must be set for ranges 1-10 and, if not using onlyIntegers, also -1-10

    Default: ``SHORT_PREFIXES`` for metric, ``SHORT_BINARY_PREFIXES`` for bytes
``$suffix``
    Unit name, ``'B'`` by default
``$separator``
    Separator string between the number and the unit, ``' '`` by default.
    Override if you want non-breaking space there or no space at all.
``$scaleBase``
    Unit prefix scale.

    * ``SCALE_METRIC = 1000``
    * ``SCALE_BINARY = 1024``
    * Custom can be used but is not supported

    Default: ``SCALE_METRIC`` for metric. Hardcoded as ``SCALE_BINARY`` for bytes.
``$onlyIntegers``
    Value can only be integer, there won't be negative scale prefixes and prefix-less scale won't have a decimal point.
    Default: ``false`` for metric. Hardcoded as ``true`` for bytes.
``$fixedWidth``
    Format type:

    * ``false``. Optimized for variable width fonts, 3 digit precision will be used,
        with 4 possible for binary scale in range 1000-1023 (``1.23``, ``12.3``, ``112``, ``1012``).
    * ``true``. Optimized for fixed width fonts. 3 characters will be used including decimal (``1.2``, ``12``, ``123``)

    Default: ``false``.
``$forceSign``
    Force show ``+`` for positive values.
    Default: ``false``.

License
=======

The library is available as open source under the terms of the `MIT License`_.

.. _MIT License: https://opensource.org/license/mit/

.. |Packagist|  image:: https://img.shields.io/packagist/v/arokettu/kilo-mega.svg?style=flat-square
   :target:     https://packagist.org/packages/arokettu/kilo-mega
.. |GitHub|     image:: https://img.shields.io/badge/get%20on-GitHub-informational.svg?style=flat-square&logo=github
   :target:     https://github.com/arokettu/kilo-mega
.. |GitLab|     image:: https://img.shields.io/badge/get%20on-GitLab-informational.svg?style=flat-square&logo=gitlab
   :target:     https://gitlab.com/sandfox/kilo-mega
.. |Bitbucket|  image:: https://img.shields.io/badge/get%20on-Bitbucket-informational.svg?style=flat-square&logo=bitbucket
   :target:     https://bitbucket.org/sandfox/kilo-mega
.. |Gitea|      image:: https://img.shields.io/badge/get%20on-Gitea-informational.svg?style=flat-square&logo=gitea
   :target:     https://sandfox.org/sandfox/kilo-mega
