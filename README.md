# MySQL Backward Compatibility Wrapper

All mysql_* functions in PHP 7 with debug mode

REQUIREMENTS
------------

The minimum requirement by this library that your server supports PHP 7.0.0.

### Install via Composer

You can then install this library using the following command:

```sh
composer require pershin/mysql_backward_compatibility_wrapper
```

## Usage

In your PHP script (without Composer):

```php
include 'vendor/pershin/mysql_backward_compatibility_wrapper/autoload.php';
```

## Debug mode

Example (test.php):

```php
<?php

include 'vendor/autoload.php';

use vendor\pershin\mysql_backward_compatibility_wrapper\MySQL;

MySQL::$debugging = true;

mysql_connect('localhost', 'mysql_user', 'mysql_password');
mysql_query('SELECT 2 + 2');

print_r(MySQL::$queries);

```

Output:

```txt
Array
(
    [0] => Array
        (
            [query] => SELECT 2 + 2
            [time] => 0.00019216537475586
            [file] => test.php:10
            [error] => 
            [errno] => 0
        )

)

```
