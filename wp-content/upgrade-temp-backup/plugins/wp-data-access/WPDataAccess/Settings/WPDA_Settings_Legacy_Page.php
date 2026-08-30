<?php

namespace WPDataAccess\Settings {

    abstract class WPDA_Settings_Legacy_Page {

        protected $page;

        public function __construct() {

            if ( isset( $_REQUEST['page'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                $this->page = sanitize_text_field( wp_unslash( $_REQUEST['page'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            } else {
                wp_die( esc_attr__( 'ERROR: Wrong arguments [missing page argument]', 'wp-data-access' ) );
            }

        }

        abstract public function show();

    }

}