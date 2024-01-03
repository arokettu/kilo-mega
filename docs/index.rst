KiloMega
########

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

.. code-block:: php

    <?php
    use function \Arokettu\KiloMega\format_metric;
    echo format_metric(1000, suffix: 'W'); // 1.0 kW

Formatting a byte or bit value
------------------------------

.. code-block:: php

    <?php
    use function \Arokettu\KiloMega\format_bytes;
    echo format_bytes(1234); // 1.2 KiB

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
