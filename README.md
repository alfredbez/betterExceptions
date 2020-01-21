# Better Exceptions

This package provides an alternative to the  `getTraceAsString` method which truncates arguments in stacktraces. The code was originally posted on [stackoverflow](https://stackoverflow.com/a/6076667/2123108). Here's an slightly adapted version with some unit-tests.

**PHP 7.4+ Note**: Please make sure to disable the new INI directive `zend.exception_ignore_args`.

## Usage

```php
$handler = new AlfredBez\BetterExceptions\ExceptionHandler();
$stacktrace = $handler->getTraceAsString($exception);
```

## Installation

The suggested installation method is via [composer](https://getcomposer.org/):

```sh
php composer.phar require abez/better-exceptions
```
