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

use vendor\pershin\mysql_backward_compatibility_wrapper\MySQL;

/**
 * Open a connection to a MySQL Server
 */
function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0) {
    if ($new_link) {
        // none
    }

    MySQL::$link = mysqli_init();
    MySQL::$link->real_connect($server, $username, $password, null, null, null, $client_flags);

    return MySQL::$link;
}

/**
 * Open a persistent connection to a MySQL server
 */
function mysql_pconnect($server = null, $username = null, $password = null, $client_flags = 0) {
    if (null === $server) {
        $server = 'p:localhost';
    } else {
        $server = 'p:' . $server;
    }

    return mysql_connect($server, $username, $password, false, $client_flags);
}

/**
 * Close MySQL connection
 */
function mysql_close($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_close($link);
}

/**
 * Select a MySQL database
 */
function mysql_select_db($database_name, $link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_select_db($link, $database_name);
}

/**
 * Create a MySQL database
 *
 * @deprecated
 */
function mysql_create_db($database_name, $link_identifier = null) {
    $db_name = mysql_real_escape_string($database_name, $link_identifier);
    return mysql_query('CREATE DATABASE `' . $db_name . '`', $link_identifier);
}

/**
 * Drop (delete) a MySQL database
 *
 * @deprecated
 */
function mysql_drop_db($database_name, $link_identifier = null) {
    $db_name = mysql_real_escape_string($database_name, $link_identifier);
    return mysql_query('DROP DATABASE `' . $db_name . '`', $link_identifier);
}

/**
 * Send a MySQL query
 */
function mysql_query($query, $link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return MySQL::query($query, $link);
}

/**
 * Send an SQL query to MySQL without fetching and buffering the result rows
 */
function mysql_unbuffered_query($query, $link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return MySQL::query($query, $link, true);
}

/**
 * Selects a database and executes a query on it
 *
 * @deprecated
 */
function mysql_db_query($database, $query, $link_identifier = null) {
    mysql_select_db($database, $link_identifier);
    return mysql_query($query, $link_identifier);
}

/**
 * List databases available on a MySQL server
 *
 * @deprecated
 */
function mysql_list_dbs($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysql_query('SHOW DATABASES', $link);
}

/**
 * List tables in a MySQL database
 *
 * @deprecated
 */
function mysql_list_tables($database, $link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    $db_name = mysql_real_escape_string($database, $link);
    return mysql_query('SHOW TABLES FROM `' . $db_name . '`', $link);
}

/**
 * List MySQL table fields
 */
function mysql_list_fields($database_name, $table_name, $link_identifier = null) {
    $db_name = mysql_real_escape_string($database_name, $link_identifier);
    $tbl_name = mysql_real_escape_string($table_name, $link_identifier);
    return mysql_query("SHOW COLUMNS FROM `{$db_name}`.`{$tbl_name}`", $link_identifier);
}

/**
 * List MySQL processes
 */
function mysql_list_processes($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysql_query('SHOW PROCESSLIST', $link);
}

/**
 * Returns the text of the error message from previous MySQL operation
 */
function mysql_error($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_error($link);
}

/**
 * Returns the numerical value of the error message from previous MySQL operation
 */
function mysql_errno($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_errno($link);
}

/**
 * Get number of affected rows in previous MySQL operation
 */
function mysql_affected_rows($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_affected_rows($link);
}

/**
 * Get the ID generated in the last query
 */
function mysql_insert_id($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_insert_id($link);
}

/**
 * Get result data
 */
function mysql_result($result, $row, $field = 0) {
    $data = [];

    if (mysql_data_seek($result, $row)) {
        $data = mysql_fetch_array($result);
    }

    return $data[$field] ?? false;
}

/**
 * Get number of rows in result
 */
function mysql_num_rows($result) {
    return mysqli_num_rows($result);
}

/**
 * Get number of fields in result
 */
function mysql_num_fields($result) {
    return mysqli_num_fields($result);
}

/**
 * Get a result row as an enumerated array
 */
function mysql_fetch_row($result) {
    return mysqli_fetch_row($result);
}

/**
 * Fetch a result row as an associative array, a numeric array, or both
 */
function mysql_fetch_array($result, $result_type = MYSQL_BOTH) {
    return mysqli_fetch_array($result, $result_type);
}

/**
 * Fetch a result row as an associative array
 */
function mysql_fetch_assoc($result) {
    return mysql_fetch_array($result, MYSQL_ASSOC);
}

/**
 * Fetch a result row as an object
 */
function mysql_fetch_object($result, $class_name = 'stdClass', $params = []) {
    if (empty($params)) {
        $obj = mysqli_fetch_object($result, $class_name);
    } else {
        $obj = mysqli_fetch_object($result, $class_name, $params);
    }

    return null !== $obj ? $obj : false;
}

/**
 * Move internal result pointer
 */
function mysql_data_seek($result, $row_number) {
    return mysqli_data_seek($result, $row_number);
}

/**
 * Get the length of each output in a result
 */
function mysql_fetch_lengths($result) {
    return mysqli_fetch_lengths($result);
}

/**
 * Get column information from a result and return as an object
 */
function mysql_fetch_field($result, $field_offset = 0) {
    if (0 < $field_offset) {
        mysql_field_seek($result, $field_offset);
    }

    return mysqli_fetch_field($result);
}

/**
 * Set result pointer to a specified field offset
 */
function mysql_field_seek($result, $field_offset) {
    return mysqli_field_seek($result, $field_offset);
}

/**
 * Free result memory
 */
function mysql_free_result($result) {
    mysqli_free_result($result);
    return true;
}

/**
 * Get the name of the specified field in a result
 */
function mysql_field_name($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    return $object ? $object->name : false;
}

/**
 * Get name of the table the specified field is in
 */
function mysql_field_table($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    return $object ? $object->table : false;
}

/**
 * Returns the length of the specified field
 */
function mysql_field_len($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    return $object ? $object->length : false;
}

/**
 * Get the type of the specified field in a result
 */
function mysql_field_type($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    $type = $object ? $object->type : false;

    $types = [
        MYSQLI_TYPE_DECIMAL,
        MYSQLI_TYPE_TINY => 'int', MYSQLI_TYPE_SHORT => 'int',
        MYSQLI_TYPE_LONG => 'int', MYSQLI_TYPE_FLOAT => 'real',
        MYSQLI_TYPE_DOUBLE, MYSQLI_TYPE_NULL,
        MYSQLI_TYPE_TIMESTAMP => 'timestamp', MYSQLI_TYPE_LONGLONG,
        MYSQLI_TYPE_INT24 => 'int', MYSQLI_TYPE_DATE,
        MYSQLI_TYPE_TIME => 'time', MYSQLI_TYPE_DATETIME => 'datetime',
        MYSQLI_TYPE_YEAR, MYSQLI_TYPE_NEWDATE,
        MYSQLI_TYPE_ENUM, MYSQLI_TYPE_SET,
        MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_MEDIUM_BLOB,
        MYSQLI_TYPE_LONG_BLOB, MYSQLI_TYPE_BLOB => 'blob',
        MYSQLI_TYPE_VAR_STRING => 'string', MYSQLI_TYPE_STRING => 'string',
        MYSQLI_TYPE_CHAR, MYSQLI_TYPE_INTERVAL,
        MYSQLI_TYPE_GEOMETRY, MYSQLI_TYPE_JSON,
        MYSQLI_TYPE_NEWDECIMAL, MYSQLI_TYPE_BIT
    ];

    return $types[$type] ?? false;
}

/**
 * Get the flags associated with the specified field in a result
 */
function mysql_field_flags($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    return $object ? $object->flags : false;
}

/**
 * Escapes a string for use in a mysql_query
 */
function mysql_escape_string($unescaped_string) {
    return mysql_real_escape_string($unescaped_string);
}

/**
 * Escapes special characters in a string for use in an SQL statement
 */
function mysql_real_escape_string($unescaped_string, $link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_real_escape_string($link, $unescaped_string);
}

/**
 * Get current system status
 */
function mysql_stat($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_stat($link);
}

/**
 * Return the current thread ID
 */
function mysql_thread_id($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_thread_id($link);
}

/**
 * Returns the name of the character set
 */
function mysql_client_encoding($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_character_set_name($link);
}

/**
 * Ping a server connection or reconnect if there is no connection
 */
function mysql_ping($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_ping($link);
}

/**
 * Get MySQL client info
 */
function mysql_get_client_info() {
    return mysqli_get_client_info();
}

/**
 * Get MySQL host info
 */
function mysql_get_host_info($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_get_host_info($link);
}

/**
 * Get MySQL protocol info
 */
function mysql_get_proto_info($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_get_proto_info($link);
}

/**
 * Get MySQL server info
 */
function mysql_get_server_info($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_get_server_info($link);
}

/**
 * Get information about the most recent query
 */
function mysql_info($link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_info($link);
}

/**
 * Sets the client character set
 */
function mysql_set_charset($charset, $link_identifier = null) {
    $link = MySQL::getLinkIdentifier($link_identifier);
    return mysqli_set_charset($link, $charset);
}
