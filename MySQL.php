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

namespace vendor\pershin\mysql_backward_compatibility_wrapper {

    final class MySQL {

        /**
         * Debug mode
         *
         * @var bool
         */
        public static $debugging = false;

        /**
         * The MySQL connection.
         *
         * @var null|\mysqli
         */
        public static $link = null;

        /**
         * SQL queries (debug mode)
         *
         * @var array
         */
        public static $queries = [];

        /**
         * Gets a link identifier
         *
         * @param mixed $link_identifier
         *
         * @return null|\mysqli
         */
        public static function getLinkIdentifier($link_identifier = null) {
            return null === $link_identifier ? self::$link : $link_identifier;
        }

        /**
         * Performs a query on the database
         *
         * @param string $query The query string.
         * @param \mysqli $link A link identifier returned
         * by mysqli_connect() or mysqli_init()
         * @param bool $unbuffered If <b>TRUE</b> all subsequent
         * calls will return error Commands out of sync unless
         * you call <b>mysqli_free_result</b>
         *
         * @return mixed Returns <b>FALSE</b> on failure.
         * For successful <i>SELECT</i>, <i>SHOW</i>, <i>DESCRIBE</i>
         * or <i>EXPLAIN</i> queries <b>mysqli_query()</b> will return
         * a mysqli_result object. For other successful queries
         * <b>mysqli_query()</b> will return <b>TRUE</b>.
         */
        public static function query($query, $link, bool $unbuffered = false) {
            if (self::$debugging) {
                $start = microtime(true);
            }

            if ($unbuffered) {
                $result = mysqli_query($link, $query, MYSQLI_USE_RESULT);
            } else {
                $result = mysqli_query($link, $query);
            }

            if (self::$debugging) {
                $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
                self::$queries[] = [
                    'query' => $query,
                    'time' => microtime(true) - $start,
                    'file' => "{$backtrace[1]['file']}:{$backtrace[1]['line']}",
                    'error' => mysqli_error($link),
                    'errno' => mysqli_errno($link)
                ];
            }

            return $result;
        }

    }

}
