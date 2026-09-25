# Changelog

## 1.x

### 1.1.3

*Sep 26, 2026*

* Fixed PHP 8.6 deprecation

### 1.1.2

*Oct 5, 2025*

* Fixed infinite values handling (this also fixes PHP 8.5 deprecation)
* Changed all exceptions to `ValueError`

### 1.1.1

*Jul 28, 2024*

* Throws `BadFunctionCallException` instead of `InvalidArgumentException` if supplied with broken prefixes array

### 1.1.0

*Jan 7, 2023*

* Added new parameters:
  * $separator
  * $fixedWidth
  * $forceSign
* Fixed behavior for negative values

### 1.0.0

*Feb 22, 2023*

First release
