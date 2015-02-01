Booster
=======

[![Build Status](https://travis-ci.org/driebit/booster.svg?branch=master)](https://travis-ci.org/driebit/booster)

Introduction
------------

Booster is a set of tools that will make your PHP and/or Symfony tests run
faster and use less memory.

Installation
------------

The recommended way to install this library is through [Composer](http://getcomposer.org):

```bash
$ composer require driebit/booster
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Usage
-----

### Null properties on tear down

Nulling class properties on test tear down helps reduce memory footprint and
test runtime. For instance when using PHPUnit:

```php
use Driebit\Booster\Cleaner;

class MyTest extends \PHPUnit_Framework_TestCase
{
    // tests here...

    protected function tearDown()
    {
        // tear down actions here...

        $cleaner = new Cleaner();
        $cleaner->nullProperties($this);
    }
}
```

Or using the trait:

```php
use Driebit\Booster\Phpunit\NullOnTearDownTrait;

class MyTest extends \PHPUnit_Framework_TestCase
{
    use NullOnTearDownTrait;
}
```

### Disable debug mode after first kernel initialization

When running functional Symfony tests, you will probably be creating the service
container many times. If debug mode is enabled, Symfony will check whether any
resources have changed during each container initialization. By disabling
debug mode, you wil be using a cached container in your tests.

Use the trait from your AppKernel:

```php
use Driebit\Booster\Symfony\NoDebugTrait;

class AppKernel extends Kernel
{
    use NoDebugTrait;

    // ...
}
