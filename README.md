# Mobizon notifications channel for Laravel 5.3+

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laraketai/mobizon.svg?style=flat-square)](https://packagist.org/packages/laraketai/mobizon)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laraketai/mobizon/master.svg?style=flat-square)](https://travis-ci.org/laraketai/mobizon)
[![StyleCI](https://styleci.io/repos/163931117/shield)](https://styleci.io/repos/163931117)
[![Total Downloads](https://img.shields.io/packagist/dt/laraketai/mobizon.svg?style=flat-square)](https://packagist.org/packages/laraketai/mobizon)


This package makes it easy to send SMS notifications using [Mobizon](https://mobizon.kz) with Laravel 5.3.

## Contents

- [Installation](#installation)
	- [Setting up the Mobizon service](#setting-up-the-Mobizon-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install this package via composer:
```
composer require laraketai/mobizon
```

Laravel 5.5 < Add the service provider to  `config/app.php`:

```php
// config/app.php
'providers' => [
    ...
    Laraketai\Mobizon\MobizonServiceProvider::class,
],
```

Publish Config File `config/mobizon.php`:
```
php artisan vendor:publish --provider="Laraketai\Mobizon\MobizonServiceProvider"
```


### Setting up your Mobizon service
Log in to your [Mobizon](https://mobizon.kz/help/api-docs/sms-api) and grab your Api, Api Secret Key. Add them to `config/services.php`.  

```php
// config/mobizon.php
...
'mobizon' => [
    'server' => env('MOBIZON_SERVER'),
    'secret' => env('MOBIZON_SECRET'),
],
```

## Usage

Follow Laravel's documentation to add the channel your Notification class:

```php
use Illuminate\Notifications\Notification;
use Laraketai\Mobizon\MobizonChannel;
use Laraketai\Mobizon\MobizonMessage;

public function via($notifiable)
{
    return [MobizonChannel::class];
}

public function toMobizon($notifiable)
{
    return (new MobizonMessage)
                    ->content('This is a test SMS via Mobizon using Laravel Notifications!');
}
```  

Add a `routeNotificationForMobizon` method to your Notifiable model to return the phone number:  

```php
public function routeNotificationForMobizon()
{
    //Phone Number without symbols or spaces
    return $this->phone_number;
}
```    

### Available methods

* `content()` - (string), SMS notification body
* `from()` - (integer) Override default from number

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email sanzhar@aketai.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Laraketai](https://github.com/laraketai)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
