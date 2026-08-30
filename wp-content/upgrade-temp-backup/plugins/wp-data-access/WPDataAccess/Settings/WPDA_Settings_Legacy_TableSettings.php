<?php

namespace WPDataAccess\Settings {

    use WPDataAccess\API\WPDA_API_Core;
    use WPDataAccess\Data_Dictionary\WPDA_Dictionary_Lists;
    use WPDataAccess\Utilities\WPDA_Table_Actions;

    class WPDA_Settings_Legacy_TableSettings extends WPDA_Settings_Legacy_Page {

		/**
		 * Legacy table settings
		 *
		 * @since   2.7.0
		 */
		public function show() {
            global $wpdb;
            // phpcs:disable WordPress.Security.NonceVerification.Recommended -- already verified
            $dbs = isset( $_REQUEST['dbs'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['dbs'] ) ) : $wpdb->dbname; // input var okay.
            $tbl  = isset( $_REQUEST['tbl'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['tbl'] ) ) : ''; // input var okay.
            // phpcs:enable WordPress.Security.NonceVerification.Recommended
            ?>
            <div>
                <form method="post" id="form_settings">
                    <fieldset style="border: 1px solid #c3c4c7; padding: 30px; border-radius: 4px; margin-bottom: 20px;">
                        <legend>
                            Legacy Table Settings
                        </legend>

                        <div style="display: grid; gap: 10px;">
                            <div style="font-size: 85%;">
                                <div>
                                    Use this page to access table and view settings from the old Data Explorer.
                                    Select a database and a table or view, then press the <strong>SETTINGS</strong> button to access legacy table settings.
                                </div>
                                <div>
                                    ✔ Dashboard menu settings are no longer available here. Use the App Builder to replace old dashboard menus.
                                </div>
                                <div>
                                    ✔ The REST API menu is also no longer available here. Use the new Data Explorer to manage REST API settings.
                                </div>
                            </div>

                            <div>
                                <div>
                                    <label><strong>Select Database</strong></label>
                                </div>
                                <div>
                                    <select name="dbs" onchange="on_dbs_change()">
                                        <?php
                                        $schemas = WPDA_Dictionary_Lists::get_db_schemas();
                                        foreach ( $schemas as $schema ) {
                                            $selected = $dbs === $schema['schema_name'] ? ' selected' : '';
                                            echo "<option value='{$schema['schema_name']}'$selected>{$schema['schema_name']}</option>"; // phpcs:ignore WordPress.Security.EscapeOutput
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div>
                                    <label><strong>Select Table</strong></label>
                                </div>
                                <div>
                                    <select name="tbl" id="tbl">
                                        <?php
                                        $tables = WPDA_Dictionary_Lists::get_tables(true, $dbs);
                                        foreach ( $tables as $table ) {
                                            $selected = $tbl === $table['table_name'] ? ' selected' : '';
                                            echo "<option value='{$table['table_name']}'$selected>{$table['table_name']}</option>"; // phpcs:ignore WordPress.Security.EscapeOutput
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-top: 10px;">
                                <button type="submit" class="button button-primary">SETTINGS</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <div>
                    <?php
                    if ($tbl !== '') {
                        $plugin_table_actions = new WPDA_Table_Actions();
                        $plugin_table_actions->show( WPDA_API_Core::sanitize_db_identifier( $dbs ), WPDA_API_Core::sanitize_db_identifier( $tbl ) );
                    }
                    ?>
                </div>
            </div>

            <script>
                function on_dbs_change() {
                    if ("<?php echo esc_attr( $tbl); ?>" !== "") {
                        jQuery("#tbl").val("");
                        jQuery("#form_settings").submit();
                    }
                }
            </script>
            <?php

		}

	}

}
