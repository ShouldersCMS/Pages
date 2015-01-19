# Shoulderscms/Pages
Currently a very early version of a Pages module for Shoulderscms

## Getting Started
This is not production ready...so use at your own risk. This is a very early release.

* Follow the instructions on Shoulderscms/Shoulderscms first.
* Add the following to the require block in your composer.json file
```php
"shoulderscms/pages": "dev-master"
```
* Do composer update in terminal
* Add the following to your `app/app.php` under service providers:
```php
'providers' => [
    'Shoulderscms\Shoulderscms\PagesServiceProvider',
]
```
* Run package migrations by running the following in terminal:
	`php artisan migrate --package=shoulderscms/pages`