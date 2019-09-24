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
         * Field flags
         *
         * @var array
         */
        private static $flags = [
            MYSQLI_NOT_NULL_FLAG => 'not_null',
            MYSQLI_PRI_KEY_FLAG => 'primary_key',
            MYSQLI_UNIQUE_KEY_FLAG => 'unique_key',
            MYSQLI_MULTIPLE_KEY_FLAG => 'multiple_key',
            MYSQLI_BLOB_FLAG => 'blob',
            MYSQLI_UNSIGNED_FLAG => 'unsigned',
            MYSQLI_ZEROFILL_FLAG => 'zerofill',
            MYSQLI_AUTO_INCREMENT_FLAG => 'auto_increment',
            MYSQLI_TIMESTAMP_FLAG => 'timestamp',
            MYSQLI_SET_FLAG => 'set',
            MYSQLI_NUM_FLAG => '',
            MYSQLI_PART_KEY_FLAG => '',
            MYSQLI_GROUP_FLAG => '',
            MYSQLI_ENUM_FLAG => 'enum',
            MYSQLI_BINARY_FLAG => 'binary',
            MYSQLI_NO_DEFAULT_VALUE_FLAG => '',
            MYSQLI_ON_UPDATE_NOW_FLAG => ''
        ];

        /**
         * Field types
         *
         * @var array
         */
        private static $types = [
            MYSQLI_TYPE_DECIMAL => 'real',
            MYSQLI_TYPE_TINY => 'int',
            MYSQLI_TYPE_SHORT => 'int',
            MYSQLI_TYPE_LONG => 'int',
            MYSQLI_TYPE_FLOAT => 'real',
            MYSQLI_TYPE_DOUBLE => 'real',
            MYSQLI_TYPE_NULL => 'null',
            MYSQLI_TYPE_TIMESTAMP => 'timestamp',
            MYSQLI_TYPE_LONGLONG => 'int',
            MYSQLI_TYPE_INT24 => 'int',
            MYSQLI_TYPE_DATE => 'date',
            MYSQLI_TYPE_TIME => 'time',
            MYSQLI_TYPE_DATETIME => 'datetime',
            MYSQLI_TYPE_YEAR => 'year',
            MYSQLI_TYPE_NEWDATE => 'date',
            MYSQLI_TYPE_ENUM => 'enum',
            MYSQLI_TYPE_SET => 'set',
            MYSQLI_TYPE_TINY_BLOB => 'blob',
            MYSQLI_TYPE_MEDIUM_BLOB => 'blob',
            MYSQLI_TYPE_LONG_BLOB => 'blob',
            MYSQLI_TYPE_BLOB => 'blob',
            MYSQLI_TYPE_VAR_STRING => 'string',
            MYSQLI_TYPE_STRING => 'string',
            //MYSQLI_TYPE_CHAR => '',
            //MYSQLI_TYPE_INTERVAL => '',
            MYSQLI_TYPE_GEOMETRY => 'geometry',
            //MYSQLI_TYPE_JSON => '',
            MYSQLI_TYPE_NEWDECIMAL => 'real',
            MYSQLI_TYPE_BIT => 'int'
        ];

        /**
         * Get the flags associated with the field
         *
         * @param int $flags
         *
         * @return string
         */
        public static function getFieldFlags(int $flags): string {
            $str = '';

            foreach (self::$flags as $key => $val) {
                if ($key & $flags) {
                    $str .= $val . ' ';
                }
            }

            return rtrim($str);
        }

        /**
         * Get the type of the field
         *
         * @param int $field_type
         *
         * @return string
         */
        public static function getFieldType(int $field_type): string {
            return self::$types[$field_type] ?? 'unknown';
        }

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
