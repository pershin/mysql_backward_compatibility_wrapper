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

    final class Resource {

        /**
         * Link to MySQL database (mysql link)
         */
        const TYPE_MYSQL_LINK = 1;

        /**
         * Persistent link to MySQL database (mysql link persistent)
         */
        const TYPE_MYSQL_LINK_PERSISTENT = 2;

        /**
         * MySQL result (mysql result)
         */
        const TYPE_MYSQL_RESULT = 3;

        /**
         * Resources
         *
         * @var array
         */
        private static $resources = [];

        /**
         * Create resource
         *
         * @param mixed $value
         * @param int $type
         *
         * @return resource
         */
        public static function create($value, int $type) {
            $resource = fopen('php://memory', 'r+');
            $key = (int) $resource;

            self::$resources[$key] = [
                $type,
                $value
            ];

            return $resource;
        }

        /**
         * Gets value of resource
         *
         * @param resource $resource
         *
         * @return mixed
         */
        public static function fetch($resource) {
            $key = (int) $resource;
            return self::$resources[$key][1] ?? null;
        }

        /**
         * Frees the memory associated with a resource
         *
         * @param resource $resource
         */
        public static function free($resource) {
            $key = (int) $resource;
            unset(self::$resources[$key]);
            fclose($resource);
        }

    }

}
