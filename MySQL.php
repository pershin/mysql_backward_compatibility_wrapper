<?php

/**
 * The MySQL connection.
 */
$mysql_global_link_identifier = null;

function mysql_get_link_identifier($link_identifier = null) {
    global $mysql_global_link_identifier;
    return null === $link_identifier ? $mysql_global_link_identifier : $link_identifier;
}

/**
 * MySQL client constants
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
 * MySQL fetch constants
 */
/**
 * <p>
 * Columns are returned into the array having the fieldname as the array index.
 * </p>
 * @link https://www.php.net/manual/en/mysql.constants.php
 */
define('MYSQL_ASSOC', MYSQLI_ASSOC);

/**
 * <p>
 * Columns are returned into the array having both a numerical index and the fieldname as the array index.
 * </p>
 * @link https://www.php.net/manual/en/mysql.constants.php
 */
define('MYSQL_BOTH', MYSQLI_BOTH);

/**
 * <p>
 * Columns are returned into the array having a numerical index to the fields. This index starts with 0, the first field in the result.
 * </p>
 * @link https://www.php.net/manual/en/mysql.constants.php
 */
define('MYSQL_NUM', MYSQLI_NUM);

/**
 * Get number of affected rows in previous MySQL operation
 *
 * @link https://www.php.net/manual/en/function.mysql-affected-rows.php
 * @param mysqli $link_identifier
 * @return int
 */
function mysql_affected_rows($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_affected_rows($link);
}

/**
 * Returns the name of the character set
 */
function mysql_client_encoding($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_character_set_name($link);
}

/**
 * Close MySQL connection
 *
 * @link https://www.php.net/manual/en/function.mysql-close.php
 * @param mysqli $link_identifier
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysql_close($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_close($link);
}

/**
 * Open a connection to a MySQL Server
 */
function mysql_connect($server, $username, $password, $new_link = false, $client_flags = 0) {
    global $mysql_global_link_identifier;
    $mysql_global_link_identifier = new mysqli($server, $username, $password);
    return $mysql_global_link_identifier;
}

/**
 * Create a MySQL database
 */
function mysql_create_db($database_name, $link_identifier = null) {
    $db_name = mysql_real_escape_string($database_name, $link_identifier);
    return mysql_query('CREATE DATABASE `' . $db_name . '`', $link_identifier);
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_createdb()</b>
 */
function mysql_createdb($database_name, $link_identifier = null) {
    return mysql_create_db($database_name, $link_identifier);
}

/**
 * Move internal result pointer
 */
function mysql_data_seek($result, $row_number) {
    return mysqli_data_seek($result, $row_number);
}

/**
 * Retrieves database name from the call to mysql_list_dbs
 */
function mysql_db_name($result, $row, $field = null) {
    if (!$field) {
        $field = 0;
    }

    return mysql_result($result, $row, $field);
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_dbname()</b>
 */
function mysql_dbname($result, $row, $field = null) {
    return mysql_db_name($result, $row, $field);
}

/**
 * Selects a database and executes a query on it
 */
function mysql_db_query($database, $query, $link_identifier = null) {
    mysql_select_db($database, $link_identifier);
    return mysql_query($query, $link_identifier);
}

/**
 * Drop (delete) a MySQL database
 */
function mysql_drop_db($database_name, $link_identifier = null) {
    $db_name = mysql_real_escape_string($database_name, $link_identifier);
    return mysql_query('DROP DATABASE `' . $db_name . '`', $link_identifier);
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_dropdb()</b>
 */
function mysql_dropdb($database_name, $link_identifier = null) {
    return mysql_drop_db($database_name, $link_identifier);
}

/**
 * Returns the numerical value of the error message from previous MySQL operation
 */
function mysql_errno($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_errno($link);
}

/**
 * Returns the text of the error message from previous MySQL operation
 */
function mysql_error($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_error($link);
}

/**
 * Escapes a string for use in a mysql_query
 */
function mysql_escape_string($unescaped_string) {
    return mysql_real_escape_string($unescaped_string);
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

//mysql_fetch_field - Get column information from a result and return as an object

/**
 * Get the length of each output in a result
 */
function mysql_fetch_lengths($result) {
    return mysqli_fetch_lengths($result);
}

/**
 * Fetch a result row as an object
 */
function mysql_fetch_object($result, $class_name = 'stdClass', $params = []) {
    if (empty($params)) {
        return mysqli_fetch_object($result, $class_name);
    }

    return mysqli_fetch_object($result, $class_name, $params);
}

/**
 * Get a result row as an enumerated array
 */
function mysql_fetch_row($result) {
    return mysqli_fetch_row($result);
}

//mysql_field_flags - Get the flags associated with the specified field in a result

/**
 * Returns the length of the specified field
 */
function mysql_field_len($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    return $object ? $object->length : false;
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_fieldlen()</b>
 */
function mysql_fieldlen($result, $field_offset) {
    return mysql_field_len($result, $field_offset);
}

/**
 * Get the name of the specified field in a result
 */
function mysql_field_name($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    return $object ? $object->name : false;
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_fieldname()</b>
 */
function mysql_fieldname($result, $field_offset) {
    return mysql_field_name($result, $field_offset);
}

//mysql_field_seek - Set result pointer to a specified field offset

/**
 * Get name of the table the specified field is in
 */
function mysql_field_table($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    return $object ? $object->table : false;
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_fieldtable()</b>
 */
function mysql_fieldtable($result, $field_offset) {
    return mysql_field_table($result, $field_offset);
}

/**
 * Get the type of the specified field in a result
 */
function mysql_field_type($result, $field_offset) {
    $object = mysqli_fetch_field_direct($result, $field_offset);
    $type = $object ? $object->type : false;

    $types = [
        MYSQLI_TYPE_DECIMAL,
        MYSQLI_TYPE_TINY => 'int',
        MYSQLI_TYPE_SHORT => 'int',
        MYSQLI_TYPE_LONG => 'int',
        MYSQLI_TYPE_FLOAT => 'real',
        MYSQLI_TYPE_DOUBLE,
        MYSQLI_TYPE_NULL,
        MYSQLI_TYPE_TIMESTAMP => 'timestamp',
        MYSQLI_TYPE_LONGLONG,
        MYSQLI_TYPE_INT24 => 'int',
        MYSQLI_TYPE_DATE,
        MYSQLI_TYPE_TIME => 'time',
        MYSQLI_TYPE_DATETIME => 'datetime',
        MYSQLI_TYPE_YEAR,
        MYSQLI_TYPE_NEWDATE,
        MYSQLI_TYPE_ENUM,
        MYSQLI_TYPE_SET,
        MYSQLI_TYPE_TINY_BLOB,
        MYSQLI_TYPE_MEDIUM_BLOB,
        MYSQLI_TYPE_LONG_BLOB,
        MYSQLI_TYPE_BLOB => 'blob',
        MYSQLI_TYPE_VAR_STRING => 'string',
        MYSQLI_TYPE_STRING => 'string',
        MYSQLI_TYPE_CHAR,
        MYSQLI_TYPE_INTERVAL,
        MYSQLI_TYPE_GEOMETRY,
        MYSQLI_TYPE_JSON,
        MYSQLI_TYPE_NEWDECIMAL,
        MYSQLI_TYPE_BIT
    ];

    return $types[$type] ?? false;
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_fieldtype()</b>
 */
function mysql_fieldtype($result, $field_offset) {
    return mysql_field_type($result, $field_offset);
}

/**
 * Free result memory
 */
function mysql_free_result($result) {
    mysqli_free_result($result);
    return true;
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
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_get_host_info($link);
}

/**
 * Get MySQL protocol info
 */
function mysql_get_proto_info($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_get_proto_info($link);
}

/**
 * Get MySQL server info
 */
function mysql_get_server_info($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_get_server_info($link);
}

//mysql_info - Get information about the most recent query

/**
 * Get the ID generated in the last query
 */
function mysql_insert_id($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_insert_id($link);
}

/**
 * List databases available on a MySQL server
 */
function mysql_list_dbs($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysql_query('SHOW DATABASES', $link);
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_listdbs()</b>
 */
function mysql_listdbs($link_identifier = null) {
    return mysql_list_dbs($link_identifier);
}

//mysql_list_fields - List MySQL table fields

/**
 * List MySQL processes
 */
function mysql_list_processes($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysql_query('SHOW PROCESSLIST', $link);
}

/**
 * List tables in a MySQL database
 */
function mysql_list_tables($database, $link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    $db_name = mysql_real_escape_string($database, $link);
    return mysql_query('SHOW TABLES FROM `' . $db_name . '`', $link);
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_listtables()</b>
 */
function mysql_listtables($database, $link_identifier = null) {
    return mysql_list_tables($database, $link_identifier);
}

/**
 * Get number of fields in result
 */
function mysql_num_fields($result) {
    return mysqli_num_fields($result);
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_numfields()</b>
 */
function mysql_numfields($result) {
    return mysql_num_fields($result);
}

/**
 * Get number of rows in result
 */
function mysql_num_rows($result) {
    return mysqli_num_rows($result);
}

/**
 * For backward compatibility, the following deprecated alias may be used: <b>mysql_numrows()</b>
 */
function mysql_numrows($result) {
    return mysql_num_rows($result);
}

//mysql_pconnect - Open a persistent connection to a MySQL server

/**
 * Ping a server connection or reconnect if there is no connection
 */
function mysql_ping($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_ping($link);
}

/**
 * Send a MySQL query
 */
function mysql_query($query, $link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_query($link, $query);
}

/**
 * Escapes special characters in a string for use in an SQL statement
 */
function mysql_real_escape_string($unescaped_string, $link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_real_escape_string($link, $unescaped_string);
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
 * (PHP 7)<br/>
 * Select a MySQL database
 *
 * Sets the current active database on the server that's associated with the specified link identifier. Every subsequent call to mysql_query() will be made on the active database.
 *
 * @link https://www.php.net/manual/en/function.mysql-select-db.php
 * @param string $database_name The name of the database that is to be selected.
 * @param mysqli $link_identifier The MySQL connection. If the link identifier is not specified, the last link opened by mysql_connect() is assumed. If no such link is found, it will try to create one as if mysql_connect() had been called with no arguments. If no connection is found or established, an <b>E_WARNING</b> level error is generated.
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysql_select_db($database_name, $link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_select_db($link, $database_name);
}

/**
 * Sets the client character set
 *
 * Sets the default character set for the current connection.
 *
 * @link https://www.php.net/manual/en/function.mysql-set-charset.php
 * @param string $charset A valid character set name.
 * @param mysqli $link_identifier
 * @return bool Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysql_set_charset($charset, $link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_set_charset($link, $charset);
}

/**
 * Get current system status
 */
function mysql_stat($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_stat($link);
}

/**
 * Get table name of field
 */
function mysql_tablename($result, $i) {
    return mysql_result($result, $i);
}

/**
 * Return the current thread ID
 */
function mysql_thread_id($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_thread_id($link);
}

/**
 * Send an SQL query to MySQL without fetching and buffering the result rows
 */
function mysql_unbuffered_query($query, $link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_query($link, $query, MYSQLI_USE_RESULT);
}
