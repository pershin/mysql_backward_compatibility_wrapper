<?php

/*
 * The MIT License
 *
 * Copyright (c) 2019 Sergey Pershin <sergey dot pershin at hotmail dot com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Use compression protocol
 */
define('MYSQL_CLIENT_COMPRESS', 32);

/**
 * Allow space after function names
 */
define('MYSQL_CLIENT_IGNORE_SPACE', 256);

/**
 * Allow interactive_timeout seconds (instead of <b>wait_timeout</b>) of inactivity before closing the connection.
 */
define('MYSQL_CLIENT_INTERACTIVE', 1024);

/**
 * Use SSL encryption. This flag is only available with version 4.x of the MySQL client library or newer. Version 3.23.x is bundled both with PHP 4 and Windows binaries of PHP 5.
 */
define('MYSQL_CLIENT_SSL', 2048);

/**
 * Columns are returned into the array having the fieldname as the array index.
 */
define('MYSQL_ASSOC', 1);

/**
 * Columns are returned into the array having both a numerical index and the fieldname as the array index.
 */
define('MYSQL_BOTH', 3);

/**
 * Columns are returned into the array having a numerical index to the fields. This index starts with 0, the first field in the result.
 */
define('MYSQL_NUM', 2);
