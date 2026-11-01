<?php

namespace WPDataAccess\Query_Builder;

use WPDataAccess\Connection\WPDADB;
use WPDataAccess\Data_Dictionary\WPDA_Dictionary_Lists;
use WPDataAccess\WPDA;
class WPDA_Query_Builder {
    const QUERY_BUILDER_OPTIONS = 'wpda_query_builder';

    const QUERY_BUILDER_HINTS = 'wpda_sql_hints';

    const EXPLAIN_COMMANDS = array(
        'select',
        'delete',
        'insert',
        'replace',
        'update'
    );

    const EXPLAIN_PROTECTED = array(
        'delete',
        'insert',
        'replace',
        'update'
    );

    protected $databases = array();

    protected $default_database = '';

    protected $wpnonce = '';

    protected $sql_hints = 'off';

    private function wpdatmp_table(
        $wpdadb,
        $sql,
        $data,
        $table_name,
        $var_name
    ) {
        // Create temporary table
        $wpdadb->query( str_ireplace( array('CREATE TABLE', $table_name), array('CREATE TEMPORARY TABLE', $var_name), $sql['create_table'] ) );
        $wpdadb_created = clone $wpdadb;
        // Copy data to temporary table
        foreach ( $data as $resultset ) {
            $column_values = array();
            foreach ( $resultset as $key => $val ) {
                $column_values[$key] = $val;
            }
            $wpdadb->insert( $var_name, $column_values );
        }
        return $wpdadb_created;
    }

    private function wpdavar_table( $wpdadb, $query, $var_name ) {
        $wpdadb->query( "set sql_quote_show_create = 'ON'" );
        if ( null === $query['status'] ) {
            return null;
        }
        $explain = $wpdadb->get_results( "explain {$query['status']->last_query}", 'ARRAY_A' );
        if ( '' !== $wpdadb->last_error ) {
            return null;
        }
        $table_name = $explain[0]['table'];
        $create_table = $wpdadb->get_results( "show create table `{$table_name}`", 'ARRAY_N' );
        if ( '' !== $wpdadb->last_error ) {
            return null;
        }
        $sql = str_replace( "\n", '', $create_table[0][1] );
        $pos = stripos( $sql, ') ENGINE=' );
        $tbl = ( false === $pos ? $sql : substr( $sql, 0, $pos + 1 ) );
        return array(
            'table_name'   => $table_name,
            'create_table' => $tbl,
            'data'         => $query['status']->last_result,
        );
    }

    public function check_query( $wpda_protect, $wpda_schemaname, $wpda_sqlquery ) {
        $sql_parts = explode( ' ', trim( $wpda_sqlquery ) );
        // phpcs:ignore -- 8.1 proof
        if ( isset( $sql_parts[0] ) && isset( $sql_parts[2] ) && WPDA::is_wp_table( $sql_parts[2] ) && ('drop' === strtolower( $sql_parts[0] ) || 'alter' === strtolower( $sql_parts[0] ) || 'rename' === strtolower( $sql_parts[0] ) || 'truncate' === strtolower( $sql_parts[0] )) ) {
            return false;
        }
        if ( isset( $sql_parts[0] ) && isset( $sql_parts[1] ) && WPDA::is_wp_table( $sql_parts[1] ) && 'truncate' === strtolower( $sql_parts[0] ) ) {
            return false;
        }
        if ( 'false' !== $wpda_protect && isset( $sql_parts[0] ) && in_array( strtolower( $sql_parts[0] ), self::EXPLAIN_COMMANDS ) ) {
            $wpdadb = WPDADB::get_db_connection( $wpda_schemaname );
            $suppress = $wpdadb->suppress_errors( true );
            $explain = $wpdadb->get_results( "explain {$wpda_sqlquery}", 'ARRAY_A' );
            $wpdadb->suppress_errors( $suppress );
            foreach ( $explain as $check ) {
                if ( in_array( strtolower( $check['select_type'] ), self::EXPLAIN_PROTECTED ) && WPDA::is_wp_table( $check['table'] ) ) {
                    return false;
                }
            }
        }
        return true;
    }

    public function get_query_list( $exclude = '', $user_id = null ) {
        $wpda_query_builder_data = get_user_meta( ( null === $user_id ? WPDA::get_current_user_id() : $user_id ), self::QUERY_BUILDER_OPTIONS );
        if ( is_array( $wpda_query_builder_data ) && count( $wpda_query_builder_data ) > 0 ) {
            // phpcs:ignore -- 8.1 proof
            $queries = $wpda_query_builder_data[0];
            if ( null !== $exclude && '' !== $exclude ) {
                $exclude_array = explode( ',', $exclude );
                // phpcs:ignore -- 8.1 proof
                foreach ( $exclude_array as $exclude_item ) {
                    unset($queries[$exclude_item]);
                }
            }
            return $queries;
        } else {
            return array();
        }
    }

    public function get_query_list_global( $exclude = '' ) {
        $wpda_query_builder_data = get_option( self::QUERY_BUILDER_OPTIONS );
        if ( is_array( $wpda_query_builder_data ) && count( $wpda_query_builder_data ) > 0 ) {
            // phpcs:ignore -- 8.1 proof
            $queries = $wpda_query_builder_data;
            if ( null !== $exclude && '' !== $exclude ) {
                $exclude_array = explode( ',', $exclude );
                // phpcs:ignore -- 8.1 proof
                foreach ( $exclude_array as $exclude_item ) {
                    unset($queries[$exclude_item]);
                }
            }
            return $queries;
        } else {
            return array();
        }
    }

    protected function update_query_list( $wpda_query_builder_data ) {
        update_user_meta( WPDA::get_current_user_id(), self::QUERY_BUILDER_OPTIONS, $wpda_query_builder_data );
    }

    protected function update_query_list_global( $wpda_query_builder_data ) {
        update_option( self::QUERY_BUILDER_OPTIONS, $wpda_query_builder_data );
    }

    public function get_query( $query_name, $user_id = null ) {
        if ( null === $user_id ) {
            $wpda_query_builder_data = $this->get_query_list();
        } else {
            $wpda_query_builder_data = $this->get_query_list( '', $user_id );
        }
        if ( is_array( $wpda_query_builder_data ) && isset( $wpda_query_builder_data[$query_name] ) ) {
            return $wpda_query_builder_data[$query_name];
        } else {
            return array();
        }
    }

    public function get_query_global( $query_name ) {
        $wpda_query_builder_data = $this->get_query_list_global();
        if ( is_array( $wpda_query_builder_data ) && isset( $wpda_query_builder_data[$query_name] ) ) {
            return $wpda_query_builder_data[$query_name];
        } else {
            return array();
        }
    }

    public function update_query_old(
        $schema_name,
        $query_name,
        $query_sql,
        $query_name_old,
        $wpda_vqb = null,
        $params = null
    ) {
        $wpda_query_builder_data = $this->get_query_list();
        if ( '' !== $query_name_old && $query_name !== $query_name_old ) {
            unset($wpda_query_builder_data[$query_name_old]);
        }
        $wpda_query_builder_data[$query_name] = array(
            'schema_name' => $schema_name,
            'query'       => $query_sql,
            'is_visual'   => null !== $wpda_vqb,
            'params'      => $params,
        );
        $this->update_query_list( $wpda_query_builder_data );
    }

    public function update_query(
        $schema_name,
        $query_name,
        $query_sql,
        $query_name_old,
        $is_visual,
        $vqb,
        $params
    ) {
        $wpda_query_builder_data = $this->get_query_list();
        if ( '' !== $query_name_old && $query_name !== $query_name_old ) {
            unset($wpda_query_builder_data[$query_name_old]);
        }
        $wpda_query_builder_data[$query_name] = array(
            'schema_name' => $schema_name,
            'query'       => $query_sql,
            'is_visual'   => $is_visual,
            'params'      => $params,
        );
        if ( $vqb !== "" ) {
            $wpda_query_builder_data[$query_name]['vqb'] = $vqb;
        }
        $this->update_query_list( $wpda_query_builder_data );
    }

    public function update_query_global(
        $schema_name,
        $query_name,
        $query_sql,
        $query_name_old,
        $is_visual,
        $vqb,
        $params
    ) {
        $wpda_query_builder_data = $this->get_query_list_global();
        if ( '' !== $query_name_old && $query_name !== $query_name_old ) {
            unset($wpda_query_builder_data[$query_name_old]);
        }
        $wpda_query_builder_data[$query_name] = array(
            'schema_name' => $schema_name,
            'query'       => $query_sql,
            'is_visual'   => $is_visual,
            'params'      => $params,
        );
        if ( $vqb !== "" ) {
            $wpda_query_builder_data[$query_name]['vqb'] = $vqb;
        }
        $this->update_query_list_global( $wpda_query_builder_data );
    }

    public function delete_query( $query_name ) {
        $wpda_query_builder_data = $this->get_query_list();
        unset($wpda_query_builder_data[$query_name]);
        $this->update_query_list( $wpda_query_builder_data );
        $this->del_visual_query( $query_name );
    }

    public function delete_query_global( $query_name ) {
        $wpda_query_builder_data = $this->get_query_list_global();
        unset($wpda_query_builder_data[$query_name]);
        $this->update_query_list_global( $wpda_query_builder_data );
        $this->del_visual_query_global( $query_name );
    }

    public function get_visual_query( $query_name ) {
        return get_user_meta( WPDA::get_current_user_id(), 'wpda_query_builder_' . $this->rewrite_query_name( $query_name ), true );
    }

    public function get_visual_query_global( $query_name ) {
        return get_option( 'wpda_query_builder_' . $this->rewrite_query_name( $query_name ), true );
    }

    public function upd_visual_query( $query_name, $wpda_vqb ) {
        update_user_meta( WPDA::get_current_user_id(), 'wpda_query_builder_' . $this->rewrite_query_name( $query_name ), $wpda_vqb );
    }

    public function upd_visual_query_global( $query_name, $wpda_vqb ) {
        update_option( 'wpda_query_builder_' . $this->rewrite_query_name( $query_name ), $wpda_vqb );
    }

    protected function del_visual_query( $query_name ) {
        delete_user_meta( WPDA::get_current_user_id(), 'wpda_query_builder_' . $this->rewrite_query_name( $query_name ) );
    }

    protected function del_visual_query_global( $query_name ) {
        delete_option( 'wpda_query_builder_' . $this->rewrite_query_name( $query_name ) );
    }

    protected function rewrite_query_name( $query_name ) {
        return str_replace( ' ', '_', $query_name );
    }

    private function substitute_sql_params( $wpdadb, $query, $params ) {
    }

    public function execute_query(
        $dbs,
        $query,
        $limit,
        $protect,
        $params
    ) {
        $response = array(
            'tabs'   => array(),
            'status' => null,
        );
        if ( $this->check_query( $protect, $dbs, $query ) ) {
            // Execute query
            $wpdadb = WPDADB::get_db_connection( $dbs );
            if ( null !== $wpdadb ) {
                $wpdadb->suppress_errors( true );
            }
            $sqllines = explode( "\n", $query );
            // phpcs:ignore -- 8.1 proof
            $sqlcmds = array();
            $start_i = 0;
            for ($i = 0; $i < count( $sqllines ); $i++) {
                // phpcs:ignore -- 8.1 proof
                if ( '/' === trim( $sqllines[$i] ) ) {
                    $sql = '';
                    for ($j = $start_i; $j < $i; $j++) {
                        if ( '' !== trim( $sqllines[$j] ) ) {
                            $sql .= "{$sqllines[$j]} ";
                        }
                    }
                    $sqlcmds[] = $sql;
                    $start_i = $i + 1;
                }
            }
            if ( count( $sqlcmds ) > 0 ) {
                // phpcs:ignore -- 8.1 proof
                $tabs = array();
                $vars = array();
                $tmps = array();
                // Process multiple SQL commands
                for ($i = 0; $i < count( $sqlcmds ); $i++) {
                    // phpcs:ignore -- 8.1 proof
                    if ( '' !== $limit && 'select' === strtolower( substr( $sqlcmds[$i], 0, 6 ) ) ) {
                        $sqlcmds[$i] .= " limit {$limit} ";
                    }
                    $columns = WPDA::get_columns_from_query( $dbs, $sqlcmds[$i] );
                    // Need to reconnect when switching from local to remote and vice versa
                    $reconnected = false;
                    if ( 'use' === substr( strtolower( trim( $sqlcmds[$i] ) ), 0, 3 ) ) {
                        $use_cmd = explode( ' ', trim( $sqlcmds[$i] ) );
                        // phpcs:ignore -- 8.1 proof
                        if ( 2 === count( $use_cmd ) && (strtolower( trim( $use_cmd[1] ) ) !== strtolower( trim( $dbs ) ) && 'rdb:' === substr( strtolower( trim( $use_cmd[1] ) ), 0, 4 ) || 'rdb:' === substr( strtolower( trim( $dbs ) ), 0, 4 )) ) {
                            $dbs = $use_cmd[1];
                            $wpdadb = WPDADB::get_db_connection( $dbs );
                            if ( null !== $wpdadb ) {
                                $wpdadb->suppress_errors( true );
                            }
                            $reconnected = true;
                        }
                    }
                    $exequery = true;
                    $var_name = null;
                    $wpdadb_saved = null;
                    switch ( strtolower( substr( trim( $sqlcmds[$i] ), 0, 7 ) ) ) {
                        case 'wpdavar':
                            $use_cmd = explode( ' ', trim( $sqlcmds[$i] ) );
                            // phpcs:ignore -- 8.1 proof
                            $var_name = ( isset( $use_cmd[1] ) ? $use_cmd[1] : null );
                            if ( $var_name !== null ) {
                                $vars[$var_name] = $tabs;
                                $tmps[$var_name] = $this->wpdavar_table( $wpdadb, $tabs[$i - 1], $var_name );
                                $exequery = false;
                            }
                            break;
                        case 'wpdatmp':
                            $use_cmd = explode( ' ', trim( $sqlcmds[$i] ) );
                            $var_name = ( isset( $use_cmd[1] ) ? $use_cmd[1] : null );
                            if ( $var_name !== null ) {
                                $wpdadb_saved = $this->wpdatmp_table(
                                    $wpdadb,
                                    $tmps[$var_name],
                                    $tmps[$var_name]['data'],
                                    $tmps[$var_name]['table_name'],
                                    $var_name
                                );
                                $exequery = false;
                            }
                            $var_name = null;
                            // reset
                            break;
                    }
                    if ( !$reconnected && $exequery && null !== $wpdadb ) {
                        $wpdadb->query( $sqlcmds[$i] );
                    }
                    if ( null === $var_name ) {
                        $status = ( null !== $wpdadb_saved ? $wpdadb_saved : (( null !== $wpdadb ? clone $wpdadb : null )) );
                        $tabs[] = array(
                            'cmd'     => $sqlcmds[$i],
                            'status'  => $status,
                            'columns' => $columns,
                        );
                    } else {
                        $tabs[] = array(
                            'cmd'     => $sqlcmds[$i],
                            'status'  => ( isset( $vars[$var_name]['status'] ) ? $vars[$var_name]['status'] : null ),
                            'wpdavar' => ( isset( $tmps[$var_name] ) ? $tmps[$var_name] : null ),
                            'columns' => null,
                        );
                    }
                    if ( null === $wpdadb || '' !== $wpdadb->last_error ) {
                        break;
                    }
                }
                $response['tabs'] = $tabs;
            } else {
                $response['columns'] = WPDA::get_columns_from_query( $dbs, $query );
                // Process single SQL command
                if ( '' !== $limit && 'select' === strtolower( substr( $query, 0, 6 ) ) ) {
                    $query .= " limit {$limit} ";
                }
                if ( null !== $wpdadb ) {
                    $wpdadb->query( $query );
                }
                $response['cmd'] = $query;
                $response['status'] = clone $wpdadb;
            }
        } else {
            $response['status'] = '<strong>WP Data Access error:</strong> Query not allowed - WordPress tables are protected';
        }
        return $response;
    }

    public function add_query( $query_name, $query ) {
        $wpda_query_builder_data = $this->get_query_list();
        $wpda_query_builder_data[$query_name] = $query;
        $this->update_query_list( $wpda_query_builder_data );
    }

    public function add_query_global( $query_name, $query ) {
        $wpda_query_builder_data = $this->get_query_list_global();
        $wpda_query_builder_data[$query_name] = $query;
        $this->update_query_list_global( $wpda_query_builder_data );
    }

    public function get_hints( $dbs ) {
        $tables = WPDA_Dictionary_Lists::get_tables( true, $dbs );
        $hints = array();
        foreach ( $tables as $table ) {
            $columns = WPDA_Dictionary_Lists::get_table_columns( $table['table_name'], $dbs );
            $hint_cols = array();
            foreach ( $columns as $column ) {
                $hint_cols[] = $column['column_name'];
            }
            $hints[$table['table_name']] = $hint_cols;
        }
        return $hints;
    }

}
