# mysql_backward_compatibility_wrapper
All mysql_* functions in PHP 7

REQUIREMENTS
------------

The minimum requirement by this library that your server supports PHP 7.0.0.

### Install via Composer

You can then install this library using the following command:

```sh
composer require pershin/mysql_backward_compatibility_wrapper
```

## Usage

In your PHP script:

```php
if (!function_exists('mysql_connect')) {
    include 'vendor/pershin/mysql_backward_compatibility_wrapper/MySQL.php';
}
```
