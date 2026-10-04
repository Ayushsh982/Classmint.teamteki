<?php

namespace WPDataAccess\Data_Apps;

use WPDataAccess\WPDA;
class WPDA_Query_Builder extends WPDA_Container {
    public function show() {
        if ( !WPDA::current_user_is_admin() ) {
            if ( !is_admin() && !$this->send_feedback() ) {
                return;
            }
            $this->show_feedback( __( 'Not authorized', 'wp-data-access' ) );
            return;
        }
        if ( is_admin() ) {
            $this->show_on_backend();
        } else {
            $this->show_on_frontend();
        }
        $this->add_client( 'qb' );
    }

    private function show_on_backend() {
        ?>

            <div class="wrap wpda-query-builder-backend">

                <h1 class="wp-heading-inline" style="margin-bottom: 18px">
                    <a href="javascript:void(0)"
                       onclick="ppActionOpenQueriesMenu(event)"
                       class="button qb-menu-button wpda_tooltip"
                       title="Query Builder Menu"
                    >
                        <i class="fas fa-bars qb-menu-icon"></i>
                    </a>

                    <span>
                        <?php 
        ?>
                        Query Builder
                    </span>

                    <a href="javascript:void(0)"
                       onclick="ppActionFullScreen()"
                       class="button qb-menu-button wpda_tooltip"
                       title="Toggle full-screen"
                    >
                        <i class="fas fa-expand qb-menu-icon"></i>
                    </a>
                </h1>

                <?php 
        $this->show_on_frontend();
        ?>

            </div>

            <?php 
    }

    private function show_on_frontend() {
        ?>

            <div class="wpda-pp-container">
                <div class="pp-container-query-builder"></div>
            </div>

            <?php 
    }

}
