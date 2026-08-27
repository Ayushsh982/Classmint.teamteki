<?php

namespace WPDataAccess\Data_Apps;

use WPDataAccess\API\WPDA_API_Core;
use WPDataAccess\WPDA;
class WPDA_Table_Container extends WPDA_Container {
    private $dbs = null;

    private $tbl = null;

    private $s;

    // Search string
    private $c;

    // Case sensitive ("true"|"false")
    public function __construct( $args = array() ) {
        parent::__construct( $args );
        if ( !WPDA::current_user_is_admin() ) {
            if ( !is_admin() && !$this->send_feedback() ) {
                return;
            }
            $this->show_feedback( __( 'Not authorized', 'wp-data-access' ) );
            return;
        }
        if ( isset( $args['dbs'], $args['tbl'] ) ) {
            $this->dbs = WPDA_API_Core::sanitize_db_identifier( $args['dbs'] );
            $this->tbl = WPDA_API_Core::sanitize_db_identifier( $args['tbl'] );
        } else {
            if ( isset( $args['feedback'] ) && false === $args['feedback'] ) {
                return;
            }
            throw new \Exception(esc_attr__( 'ERROR: Invalid usage', 'wp-data-access' ));
        }
        $this->s = ( isset( $args['s'] ) ? sanitize_text_field( $args['s'] ) : '' );
        // Not required
        $this->c = ( isset( $args['c'] ) ? sanitize_text_field( $args['c'] ) : '' );
        // Not required
    }

    public function show() {
        if ( !WPDA::current_user_is_admin() ) {
            if ( !is_admin() && !$this->send_feedback() ) {
                return;
            }
            $this->show_feedback( __( 'Not authorized', 'wp-data-access' ) );
            return;
        }
        ?>
            <div class="wrap wpda-explorer-backend">

                <h1 class="wp-heading-inline" style="margin-bottom: 18px">
                    <?php 
        ?>
                    Data Explorer
                </h1>

                <div class="wpda-pp-container">
                    <div
                        class="pp-container-explorer pp-container-admin"
                        data-source="{ 'dbs': '<?php 
        echo esc_attr( $this->dbs );
        ?>', 'tbl': '<?php 
        echo esc_attr( $this->tbl );
        ?>', 's': '<?php 
        echo esc_attr( $this->s );
        ?>', 'c': '<?php 
        echo esc_attr( $this->c );
        ?>' }"
                    ></div>
                </div>

            </div>
            <?php 
        $this->add_client( 'de' );
    }

}
