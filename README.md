# Cursor based pagination for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bitsnbolts/laravel-cursor-paginate.svg?style=flat-square)](https://packagist.org/packages/bitsnbolts/laravel-cursor-paginate)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/bitsnbolts/laravel-cursor-paginate/run-tests?label=tests)](https://github.com/bitsnbolts/laravel-cursor-paginate/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/bitsnbolts/laravel-cursor-paginate/Check%20&%20fix%20styling?label=code%20style)](https://github.com/bitsnbolts/laravel-cursor-paginate/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/bitsnbolts/laravel-cursor-paginate.svg?style=flat-square)](https://packagist.org/packages/bitsnbolts/laravel-cursor-paginate)

![](https://banners.beyondco.de/Laravel%20Cursor%20Paginate.png?theme=light&packageManager=composer+require&packageName=bitsnbolts%2Flaravel-cursor-paginate&pattern=anchorsAway&style=style_1&description=Cursor+based+pagination+for+Laravel&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

This package adds Cursor Based Pagination to Laravel.

## Installation

You can install the package via composer:

```bash
composer require bitsnbolts/laravel-cursor-paginate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Bitsnbolts\CursorPaginate\CursorPaginateServiceProvider" --tag="laravel-cursor-paginate-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$paginator = App\Models\ExampleModel::cursorPaginate(10, ['created_at' => 'desc', 'id' => 'desc']);
$items = $paginator->items();
$nextUrl = $paginator->nextCursorUrl();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Thijs van den Anker](https://github.com/ThijsvandenAnker)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
