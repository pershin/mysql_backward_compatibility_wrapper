# MySQL Backward Compatibility Wrapper

All mysql_* functions in PHP 7 with debug mode.

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

Example:

```php
<?php

include 'vendor/autoload.php';

$username = 'mysql_user';
$password = 'mysql_password';
$database_name = 'information_schema';

$link = mysql_connect('localhost', $username, $password);

if (!is_resource($link)) {
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db($database_name, $link);

if (!$db_selected) {
    die('Can\'t use ' . $database_name . ': ' . mysql_error() . PHP_EOL);
}

$query = 'SELECT * FROM `TABLES` ORDER BY `DATA_LENGTH` DESC';
$result = mysql_query($query, $link);

if (is_resource($result)) {
    $num_rows = mysql_num_rows($result);

    for ($i = 0; $num_rows > $i; $i++) {
        $row = mysql_fetch_assoc($result);
        echo $row['TABLE_SCHEMA'], '.', $row['TABLE_NAME'], ' (',
        number_format($row['DATA_LENGTH']), ' bytes)', PHP_EOL;
    }

    mysql_free_result($result);
}

mysql_close($link);

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
