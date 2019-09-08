<?php

/**
 * The MySQL connection.
 */
$mysql_global_link_identifier = null;

function mysql_get_link_identifier($link_identifier = null) {
    global $mysql_global_link_identifier;
    return null === $link_identifier ? $mysql_global_link_identifier : $link_identifier;
}

//MySQL client constants
//Constant	Description
//MYSQL_CLIENT_COMPRESS	Use compression protocol
//MYSQL_CLIENT_IGNORE_SPACE	Allow space after function names
//MYSQL_CLIENT_INTERACTIVE	Allow interactive_timeout seconds (instead of wait_timeout ) of inactivity before closing the connection.
//MYSQL_CLIENT_SSL	Use SSL encryption. This flag is only available with version 4.x of the MySQL client library or newer. Version 3.23.x is bundled both with PHP 4 and Windows binaries of PHP 5.

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
function mysql_affected_rows($link_identifier = null): int {
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
function mysql_close($link_identifier = null): bool {
    $link = mysql_get_link_identifier($link_identifier);
    return (bool) mysqli_close($link);
}

/**
 * Open a connection to a MySQL Server
 */
function mysql_connect(string $server, string $username, string $password, bool $new_link = false, int $client_flags = 0) {
    global $mysql_global_link_identifier;
    $mysql_global_link_identifier = new mysqli($server, $username, $password);
    return $mysql_global_link_identifier;
}

//mysql_create_db - Create a MySQL database

/**
 * Move internal result pointer
 */
function mysql_data_seek($result, $row_number) {
    return mysqli_data_seek($result, $row_number);
}

//mysql_db_name - Retrieves database name from the call to mysql_list_dbs
//mysql_db_query - Selects a database and executes a query on it
//mysql_drop_db - Drop (delete) a MySQL database

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
function mysql_fetch_array($result, int $result_type = MYSQL_BOTH) {
    return mysqli_fetch_array($result, $result_type);
}

/**
 * Fetch a result row as an associative array
 */
function mysql_fetch_assoc($result) {
    return mysql_fetch_array($result, MYSQL_ASSOC);
}

//mysql_fetch_field - Get column information from a result and return as an object
//mysql_fetch_lengths - Get the length of each output in a result

/**
 * Fetch a result row as an object
 */
function mysql_fetch_object($result, string $class_name = 'stdClass', array $params = []) {
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
//mysql_field_len - Returns the length of the specified field
//mysql_field_name - Get the name of the specified field in a result
//mysql_field_seek - Set result pointer to a specified field offset
//mysql_field_table - Get name of the table the specified field is in
//mysql_field_type - Get the type of the specified field in a result

/**
 * Free result memory
 */
function mysql_free_result($result): bool {
    mysqli_free_result($result);
    return true;
}

//mysql_get_client_info - Get MySQL client info
//mysql_get_host_info - Get MySQL host info
//mysql_get_proto_info - Get MySQL protocol info
//mysql_get_server_info - Get MySQL server info
//mysql_info - Get information about the most recent query

/**
 * Get the ID generated in the last query
 */
function mysql_insert_id($link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_insert_id($link);
}

//mysql_list_dbs - List databases available on a MySQL server
//mysql_list_fields - List MySQL table fields
//mysql_list_processes - List MySQL processes

/**
 * List tables in a MySQL database
 */
function mysql_list_tables($database, $link_identifier = null) {
    $link = mysql_get_link_identifier($link_identifier);
    $db_name = mysql_real_escape_string($database, $link);
    return mysql_query('SHOW TABLES FROM `' . $db_name . '`', $link);
}

//mysql_num_fields - Get number of fields in result

/**
 * Get number of rows in result
 */
function mysql_num_rows($result) {
    return mysqli_num_rows($result);
}

//mysql_pconnect - Open a persistent connection to a MySQL server
//mysql_ping - Ping a server connection or reconnect if there is no connection

/**
 * Send a MySQL query
 */
function mysql_query(string $query, mysqli $link_identifier = null) {
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

//mysql_result - Get result data

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
function mysql_select_db(string $database_name, mysqli $link_identifier = null) {
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
function mysql_set_charset(string $charset, mysqli $link_identifier = null): bool {
    $link = mysql_get_link_identifier($link_identifier);
    return mysqli_set_charset($link, $charset);
}

//mysql_stat - Get current system status
//mysql_tablename - Get table name of field
//mysql_thread_id - Return the current thread ID
//mysql_unbuffered_query - Send an SQL query to MySQL without fetching and buffering the result rows
