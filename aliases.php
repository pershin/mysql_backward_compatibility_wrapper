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
 * Alias of mysql_db_query()
 *
 * @deprecated
 */
function mysql() {
    return call_user_func_array('mysql_db_query', func_get_args());
}

/**
 * Alias of mysql_field_name()
 *
 * @deprecated
 */
function mysql_fieldname() {
    return call_user_func_array('mysql_field_name', func_get_args());
}

/**
 * Alias of mysql_field_table()
 *
 * @deprecated
 */
function mysql_fieldtable() {
    return call_user_func_array('mysql_field_table', func_get_args());
}

/**
 * Alias of mysql_field_len()
 *
 * @deprecated
 */
function mysql_fieldlen() {
    return call_user_func_array('mysql_field_len', func_get_args());
}

/**
 * Alias of mysql_field_type()
 *
 * @deprecated
 */
function mysql_fieldtype() {
    return call_user_func_array('mysql_field_type', func_get_args());
}

/**
 * Alias of mysql_field_flags()
 *
 * @deprecated
 */
function mysql_fieldflags() {
    return call_user_func_array('mysql_field_flags', func_get_args());
}

/**
 * Alias of mysql_select_db()
 *
 * @deprecated
 */
function mysql_selectdb() {
    return call_user_func_array('mysql_select_db', func_get_args());
}

/**
 * Alias of mysql_create_db()
 *
 * @deprecated
 */
function mysql_createdb() {
    return call_user_func_array('mysql_create_db', func_get_args());
}

/**
 * Alias of mysql_drop_db()
 *
 * @deprecated
 */
function mysql_dropdb() {
    return call_user_func_array('mysql_drop_db', func_get_args());
}

/**
 * Alias of mysql_free_result()
 *
 * @deprecated
 */
function mysql_freeresult() {
    return call_user_func_array('mysql_free_result', func_get_args());
}

/**
 * Alias of mysql_num_fields()
 *
 * @deprecated
 */
function mysql_numfields() {
    return call_user_func_array('mysql_num_fields', func_get_args());
}

/**
 * Alias of mysql_num_rows()
 *
 * @deprecated
 */
function mysql_numrows() {
    return call_user_func_array('mysql_num_rows', func_get_args());
}

/**
 * Alias of mysql_list_dbs()
 *
 * @deprecated
 */
function mysql_listdbs() {
    return call_user_func_array('mysql_list_dbs', func_get_args());
}

/**
 * Alias of mysql_list_tables()
 *
 * @deprecated
 */
function mysql_listtables() {
    return call_user_func_array('mysql_list_tables', func_get_args());
}

/**
 * Alias of mysql_list_fields()
 *
 * @deprecated
 */
function mysql_listfields() {
    return call_user_func_array('mysql_list_fields', func_get_args());
}

/**
 * Alias of mysql_result()
 */
function mysql_db_name() {
    return call_user_func_array('mysql_result', func_get_args());
}

/**
 * Alias of mysql_result()
 *
 * @deprecated
 */
function mysql_dbname() {
    return call_user_func_array('mysql_result', func_get_args());
}

/**
 * Alias of mysql_result()
 */
function mysql_tablename() {
    return call_user_func_array('mysql_result', func_get_args());
}

/**
 * Alias of mysql_result()
 */
function mysql_table_name() {
    return call_user_func_array('mysql_result', func_get_args());
}
