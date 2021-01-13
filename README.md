# A PHP Validator for the GTIN standard

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![PHP Version](https://img.shields.io/packagist/php-v/juststeveking/php-sdk.svg?style=flat-square)](https://php.net)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/juststeveking/gtin-php.svg?style=flat-square)](https://packagist.org/packages/juststeveking/gtin-php)
![Tests](https://github.com/JustSteveKing/gtin-php/workflows/Tests/badge.svg)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JustSteveKing/gtin-php/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/JustSteveKing/gtin-php/?branch=main)
[![Total Downloads](https://img.shields.io/packagist/dt/juststeveking/gtin-php.svg?style=flat-square)](https://packagist.org/packages/juststeveking/gtin-php)

A PHP package for validating GTIN codes for use in plain PHP and in Laravel.

## Installation

You can install the package via composer:

```bash
composer require juststeveking/gtin-php
```

## Usage PHP

If you are using a framework other than Laravel, or Laravel itself - you can use the `Gtin` class directly to validate aspects or the entire value passed in. You can check out the [specifications for gtin and GS1 here](https://www.gs1.org/docs/barcodes/GS1_General_Specifications.pdf).

## Validating correct length

A GTIN is between 8 and 14 characters long.

```php
use JustSteveKing\GtinPHP\Gtin;

$correct = 614141999996;
$valid = Gtin::length($correct); // returns true

$incorrect = 123456;
$failed = Gtin::length($incorrect); // returns false
```

## Validating that it is an integer

A GTIN must be an integer value, in php you can easily use `is_int()` however I have provided a method here to also do the same thing:

```php
use JustSteveKing\GtinPHP\Gtin;

$correct = 614141999996;
$valid = Gtin::integer($correct); // returns true

$incorrect = '614141999996';
$failed = Gtin::integer($incorrect); // returns false
```

## Inspecting the gtin and validating the check digit

The GTIN is formatted in a very specific way, this is documented fully in the specificas [document](https://www.gs1.org/docs/barcodes/GS1_General_Specifications.pdf)

```php
use JustSteveKing\GtinPHP\Gtin;

$correct = 614141999996;
$valid = Gtin::inspect($correct); // returns true

$incorrect = 123456789;
$failed = Gtin::inspect($incorrect); // returns false
```

## Validating all aspects in one go

```php
use JustSteveKing\GtinPHP\Gtin;

$correct = 614141999996;
$valid = Gtin::validate($correct); // returns true

$incorrect = 123456789;
$failed = Gtin::validate($incorrect); // returns false
```

## Validating in Laravel

There is a Laravel Rule as well as a validation macro that gets registered with this package, please use in one of the following ways:

```php
// using the class directly
public function rules()
{
    return [
        'gtin' => [
            'required',
            new JustSteveKing\GtinPHP\Rules\Gtin,
        ]
    ];
}
```

```php
// using the registered macro
public function rules()
{
    return [
        'gtin' => [
            'required',
            Rule::gtin(),
        ]
    ];
}
```

Feel free to use the `Gtin` class directly if that is more convinient.

## Testing
```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Steve McDougall](https://github.com/JustSteveKing)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
