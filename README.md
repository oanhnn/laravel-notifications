# Laravel Notifications

[![Latest Version](https://img.shields.io/packagist/v/oanhnn/laravel-notifications.svg)](https://packagist.org/packages/oanhnn/laravel-notifications)
[![Software License](https://img.shields.io/github/license/oanhnn/laravel-notifications.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/oanhnn/laravel-notifications/master.svg)](https://travis-ci.org/oanhnn/laravel-notifications)
[![Coverage Status](https://img.shields.io/coveralls/github/oanhnn/laravel-notifications/master.svg)](https://coveralls.io/github/oanhnn/laravel-notifications?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/oanhnn/laravel-notifications.svg)](https://packagist.org/packages/oanhnn/laravel-notifications)
[![Requires PHP](https://img.shields.io/travis/php-v/oanhnn/laravel-notifications.svg)](https://travis-ci.org/oanhnn/laravel-notifications)

Improve notifications feature in Laravel 5.5+

## Requirements

* php >=7.1.3
* Laravel 5.5+

> Laravel 6.0+ requires php 7.2+

## Installation

Begin by pulling in the package through Composer.

```bash
$ composer require oanhnn/laravel-notifications
```

### Laravel

After that, publish vendor's resources:

```bash
$ php artisan vendor:publish --tag=laravel-notifications-config
```

### Lumen

After that, copy the config file from the vendor directory:

```bash
$ cp vendor/oanhnn/laravel-notifications/config/notifications.php config/notifications.php
```

Update base handler class to your class in `config/notifications.php`.   
Register the config file and the service provider in `bootstrap/app.php`:

```php
$app->configure('notifications');

$app->register(Laravel\Notifications\ServiceProvider::class);
```

## Usage


## Changelog

See all change logs in [CHANGELOG](CHANGELOG.md)

## Testing

```bash
$ git clone git@github.com/oanhnn/laravel-notifications.git /path
$ cd /path
$ composer install
$ composer phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email to [Oanh Nguyen](mailto:oanhnn.bk@gmail.com) instead of 
using the issue tracker.

## Credits

- [Oanh Nguyen](https://github.com/oanhnn)
- [All Contributors](../../contributors)

## License

This project is released under the MIT License.   
Copyright © [Oanh Nguyen](https://oanhnn.github.io/).
