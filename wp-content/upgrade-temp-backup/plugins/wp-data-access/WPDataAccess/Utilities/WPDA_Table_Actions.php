<?php

/**
 * Suppress "error - 0 - No summary was found for this file" on phpdoc generation
 *
 * @package WPDataAccess\Utilities
 */
namespace WPDataAccess\Utilities;

use WPDataAccess\API\WPDA_API;
use WPDataAccess\Connection\WPDADB;
use WPDataAccess\Data_Dictionary\WPDA_Dictionary_Lists;
use WPDataAccess\Plugin_Table_Models\WPDA_Media_Model;
use WPDataAccess\Plugin_Table_Models\WPDA_Table_Settings_Model;
use WPDataAccess\Plugin_Table_Models\WPDA_User_Menus_Model;
use WPDataAccess\WPDA;
use WPDataAccess\Data_Dictionary\WPDA_Dictionary_Exist;
use WPDataAccess\Data_Dictionary\WPDA_List_Columns_Cache;
use WPDataAccess\Data_Dictionary\WPDA_List_Columns;
/**
 * Class WPDA_Table_Actions
 *
 * @author  Peter Schulz
 * @since   2.0.13
 */
class WPDA_Table_Actions {
    /**
     * Database schema name
     *
     * @var string
     */
    protected $schema_name;

    /**
     * Database table name
     *
     * @var string
     */
    protected $table_name;

    /**
     * Database table structure
     *
     * @var array
     */
    protected $table_structure;

    /**
     * Handle to instance of WPDA_List_Columns
     *
     * @var WPDA_List_Columns
     */
    protected $wpda_list_columns;

    /**
     * Engine
     *
     * @var string
     */
    protected $engine;

    /**
     * Configure table or view settings
     *
     * @since   2.0.13
     */
    public function show( $schema_name = '', $table_name = '' ) {
        $this->schema_name = $schema_name;
        $this->table_name = $table_name;
        $wpda_data_dictionary = new WPDA_Dictionary_Exist($this->schema_name, $this->table_name);
        if ( !$wpda_data_dictionary->table_exists() ) {
            echo '<div>' . esc_attr__( 'ERROR: Invalid table name or not authorized', 'wp-data-access' ) . '</div>';
            return;
        }
        $this->engine = WPDA_Dictionary_Lists::get_engine( $this->schema_name, $this->table_name );
        $wpdadb = WPDADB::get_db_connection( $this->schema_name );
        if ( null === $wpdadb ) {
            /* translators: %s = database name */
            wp_die( sprintf( esc_attr__( 'ERROR - Remote database %s not available', 'wp-data-access' ), esc_attr( $this->schema_name ) ) );
        }
        $query = "show full columns from `{$wpdadb->dbname}`.`{$this->table_name}`";
        $this->table_structure = $wpdadb->get_results( $query, 'ARRAY_A' );
        $this->wpda_list_columns = WPDA_List_Columns_Cache::get_list_columns( $this->schema_name, $this->table_name );
        ?>
			<div id="legacy-tabs">
				<div class="nav-tab-wrapper" style="padding-top: 0 !important;">
                    <a class="nav-tab wpda-manage-nav-tab" href="javascript:void(0)" style="font-size:inherit;">
                        <span class="dashicons dashicons-admin-generic wpda_settings_icon"></span>
                        <span class="wpda_settings_label" style="font-weight: 900;">Settings for `<?php 
        echo esc_attr( $schema_name );
        ?>`.`<?php 
        echo esc_attr( $table_name );
        ?>`</span>
                    </a>
				</div>
				<div id="legacy-tab-1" style="padding:3px;">
					<?php 
        $this->tab_settings();
        ?>
				</div>
			</div>
			<?php 
    }

    /**
     * Provides content for table settings
     */
    public function tab_settings() {
        $settings_db = WPDA_Table_Settings_Model::query( $this->table_name, $this->schema_name );
        if ( isset( $settings_db[0]['wpda_table_settings'] ) ) {
            $settings_db_custom = json_decode( $settings_db[0]['wpda_table_settings'] );
            $sql_dml = 'UPDATE';
        } else {
            $settings_db_custom = (object) null;
            $sql_dml = 'INSERT';
        }
        if ( has_filter( 'wpda_add_column_settings' ) ) {
            // Use filter
            $column_settings_add_column = apply_filters( 'wpda_add_column_settings', null );
        }
        if ( isset( $column_settings_add_column ) && is_array( $column_settings_add_column ) ) {
            $array_valid = true;
            foreach ( $column_settings_add_column as $add_column ) {
                if ( !isset( $add_column['label'] ) || !isset( $add_column['hint'] ) || !isset( $add_column['name_prefix'] ) || !isset( $add_column['type'] ) || !isset( $add_column['default'] ) || !isset( $add_column['disable'] ) ) {
                    $array_valid = false;
                    break;
                }
            }
            if ( !$array_valid ) {
                $column_settings_add_column = array();
            }
        } else {
            $column_settings_add_column = array();
        }
        $row_count_is_configurable = 'innodb' === strtolower( $this->engine ) || 'federated' === strtolower( $this->engine ) || 'connect' === strtolower( $this->engine ) || $this->engine === null;
        ?>
			<style>
				.wpda_table_settings_nested {
					padding-top: 5px;
					padding-left: 20px;
					padding-bottom: 20px;
					display: none;
                    margin-right: 20px;
                }

                .wpda_table_settings_nested table {
					width: 100%;
				}

				.wpda_table_settings {
					border-collapse: collapse;
				}

                .wpda_table_settings thead {
					background-color: white;
					border-bottom: 1px solid #c3c4c7;
				}

				.wpda_table_settings thead th {
					text-align: left;
					font-weight: bold;
					padding: 16px 12px;
				}

                .wpda_table_settings thead th span {
					vertical-align: middle;
                }

				.wpda_table_settings td {
					vertical-align: top;
					padding: 8px 12px;
					margin: 0;
				}

				.wpda_table_settings tr:nth-child(even) {
					background: #fff;
				}

				.wpda_table_settings_menu {
					display: grid;
					grid-template-columns: min(30%, 290px) auto;
					padding: 10px;
				}

				.wpda_table_settings_panel {
                    border: 1px solid #c3c4c7;
                    margin: 9px 5px 10px 0;
                    padding: 10px;
				}

				.wpda_table_settings_nav_vertical {
					display: grid;
                    grid-template-columns: auto;
                    margin-left: 5px;
                    margin-right: 3px;
                    padding-top: 0;
				}

                .wpda_table_settings_nav_vertical a {
					margin: 0;
                    display: grid;
                    grid-template-columns: 24px auto;
                    align-items: center;
                    padding: 8px 12px;
				}

                .wpda_table_settings_nav_vertical a.nav-tab-active {
					border-right: none;
					background-color: transparent;
                }

                .wpda_table_settings_nav_vertical a.nav-tab:focus {
                    box-shadow: none;
				}

				ul.wpda_table_settings_panel h4 {
					margin-top: 2em;
				}

				.wpda_table_settings_menu_content {
					display: flex;
					flex-direction: column;
					align-items: stretch;
				}

				.wpda_table_settings_menu_content .wpda_table_settings_vertical_border {
                    height: 10px;
                    border-right: 1px solid #c3c4c7;
                    padding: 0;
                    margin: 9px 3px 0 0;
				}

                .wpda_table_settings_menu_content .wpda_table_settings_vertical_border.wpda_table_settings_vertical_border_end {
                    flex: 2;
                    margin-top: 0;
					margin-bottom: 10px;
                }

                .nav-tab-active {
                    background-color: transparent;
                }

                .nav-tab-active:focus {
                    box-shadow: none;
                    background-color: transparent;
                }

                ul.wpda_geolocation_settings .wpda_fieldset {
					background-color: #efefef;
				}

				.wpda_table_setting_item {
					width: 100%;
				}
			</style>
			<script>
				function settingsNav(elem, className, setActive = true) {
					if (setActive) {
						jQuery(elem).closest(".wpda_table_settings_menu").find("a.nav-tab").removeClass("nav-tab-active");
						jQuery(elem).addClass("nav-tab-active");
					}

					jQuery(elem).closest(".wpda_table_settings_menu").find("ul.wpda_table_settings_nested").hide();
					jQuery(elem).closest(".wpda_table_settings_menu").find("ul.wpda_table_settings_nested." + className).show();
				}
			</script>
			<table class="widefat striped rows wpda-structure-table">
				<tr>
					<td>
						<div id="wpda_table_settings_legacy" class="wpda_table_settings_menu">
							<div class="wpda_table_settings_menu_content">
								<div class="wpda_table_settings_vertical_border"></div>
								<nav class="nav-tab-wrapper wpda_table_settings_nav_vertical">
									<a href="javascript:void(0)" onclick="settingsNav(this, 'wpda_table_table_settings')" class="nav-tab">
										<i class="fa-solid fa-table wpda_settings_icon"></i>
										<span>
											Table Settings
										</span>
									</a>
									<a href="javascript:void(0)" onclick="settingsNav(this, 'wpda_table_column_settings')" class="nav-tab">
										<i class="fa-solid fa-table-columns wpda_settings_icon"></i>
										<span>
											Column Settings
										</span>
									</a>
									<?php 
        ?>
									<a href="javascript:void(0)" onclick="settingsNav(this, 'wpda_table_dynamic_hyperlinks_settings')" class="nav-tab">
										<i class="fa-solid fa-link wpda_settings_icon"></i>
										<span>
											Dynamic Hyperlinks
										</span>
									</a>
								</nav>
								<div class="wpda_table_settings_vertical_border wpda_table_settings_vertical_border_end"></div>
							</div>
							<ul class="wpda_table_settings_panel">
								<?php 
        do_action(
            'wpda_prepend_table_settings',
            $this->schema_name,
            $this->table_name,
            $this->table_structure
        );
        ?>
								<li>
									<ul class="wpda_table_settings_nested wpda_table_table_settings">
										<h2>
											<?php 
        esc_html_e( 'Table Settings', 'wp-data-access' );
        ?>
											<a href="https://docs.legacy.wpdataaccess.com/docs/manage-table-settings/" target="_blank">
												<span class="dashicons dashicons-editor-help wpda_tooltip"
													  title="<?php 
        esc_html_e( 'Help opens in a new tab or window', 'wp-data-access' );
        ?>"
													  style="cursor:pointer"></span>
											</a>
										</h2>

										<h4>
											<?php 
        esc_html_e( 'Row count (configurable for InnoDB tables, federated tables and views only)', 'wp-data-access' );
        ?>
										</h4>

										<div style="font-size:90%;">
											<label class="wpda_action_font">
												<input type="radio"
													   name="<?php 
        echo esc_attr( $this->table_name );
        ?>_row_count_estimate"
													   value="true"
													   <?php 
        echo ( !$row_count_is_configurable ? ' disabled ' : '' );
        if ( isset( $settings_db_custom->table_settings->row_count_estimate ) && $settings_db_custom->table_settings->row_count_estimate ) {
            echo ' checked ';
        }
        ?>
												>
												Show estimated row count (faster but less accurate)
											</label>
											<?php 
        $row_count_estimate_value = 'plugin';
        if ( isset( $settings_db_custom->table_settings->row_count_estimate_value ) ) {
            $row_count_estimate_value = $settings_db_custom->table_settings->row_count_estimate_value;
        }
        ?>
											<div style="padding: 5px 0 5px 25px">
												<label class="wpda_action_font">
													<input type="radio"
														   name="<?php 
        echo esc_attr( $this->table_name );
        ?>_row_count_estimated_value"
														   value="plugin"
															<?php 
        echo ( 'plugin' === $row_count_estimate_value ? 'checked' : '' );
        echo ( !$row_count_is_configurable ? ' disabled ' : '' );
        ?>
													/>
													Use plugin estimate calculation
												</label>
												<br/>
												<label class="wpda_action_font">
													<?php 
        $row_count = 0;
        if ( isset( $settings_db_custom->table_settings->row_count_estimate_value_hard ) ) {
            $row_count = $settings_db_custom->table_settings->row_count_estimate_value_hard;
        } else {
            if ( 'connect' === strtolower( $this->engine ) ) {
                $row_count = '';
            } else {
                $wpdadb = WPDADB::get_db_connection( $this->schema_name );
                $explain = $wpdadb->get_results( 'explain select count(*) from `' . str_replace( '`', '', $this->table_name ) . '`', 'ARRAY_A' );
                if ( isset( $explain[0]['rows'] ) ) {
                    $row_count = $explain[0]['rows'];
                } elseif ( isset( $explain[0]['ROWS'] ) ) {
                    $row_count = $explain[0]['ROWS'];
                }
            }
        }
        ?>
													<input type="radio"
														   name="<?php 
        echo esc_attr( $this->table_name );
        ?>_row_count_estimated_value"
														   value="hard"
															<?php 
        echo ( 'hard' === $row_count_estimate_value ? 'checked' : '' );
        echo ( !$row_count_is_configurable ? ' disabled ' : '' );
        ?>
													/>
													Use hard estimate:
													<input type="number"
														   id="<?php 
        echo esc_attr( $this->table_name );
        ?>_row_count_estimated_value_hard"
														   value="<?php 
        echo esc_attr( $row_count );
        ?>"
														   echo ! $row_count_is_configurable ? 'disabled ' : '';
												   />
													<a href="javascript:void(0)"
													   onclick="get_table_row_count('<?php 
        echo esc_attr( wp_create_nonce( "wpda-get-row-count-{$this->table_name}" ) );
        ?>', '<?php 
        echo esc_attr( $this->schema_name );
        ?>', '<?php 
        echo esc_attr( $this->table_name );
        ?>')"
													   title="Get real row count"
													   class="wpda_tooltip"
													   style="font-weight: bold; font-size: 140%;"
													>Σ</a>
												</label>
											</div>
											<label class="wpda_action_font">
												<input type="radio"
													   name="<?php 
        echo esc_attr( $this->table_name );
        ?>_row_count_estimate"
													   value="false"
													   <?php 
        echo ( !$row_count_is_configurable ? ' disabled ' : '' );
        if ( isset( $settings_db_custom->table_settings->row_count_estimate ) && !$settings_db_custom->table_settings->row_count_estimate ) {
            echo ' checked ';
        } else {
            if ( !$row_count_is_configurable ) {
                echo ' checked ';
            }
        }
        ?>
												>
												Show real row count
											</label>
											<br/>
											<label class="wpda_action_font" style="display: inline-block; margin-top: 10px">
												<input type="radio"
													   name="<?php 
        echo esc_attr( $this->table_name );
        ?>_row_count_estimate"
													   value=""
													   <?php 
        echo ( !$row_count_is_configurable ? ' disabled ' : '' );
        if ( isset( $settings_db_custom->table_settings->row_count_estimate ) ) {
            if ( null === $settings_db_custom->table_settings->row_count_estimate ) {
                echo ' checked ';
            }
        } else {
            if ( $row_count_is_configurable ) {
                echo ' checked ';
            }
        }
        ?>
												>
												Use plugin default (current value=<?php 
        echo esc_attr( WPDA::get_option( WPDA::OPTION_BE_INNODB_COUNT ) );
        ?>)
												[<a href="<?php 
        echo esc_url( admin_url( 'options-general.php' ) );
        ?>?page=wpdataaccess&tab=backend">change plugin default</a>]
											</label>
											<div style="margin-top: 5px; padding-left: 24px">
												Performs real row count if estimate <= <?php 
        echo esc_attr( WPDA::get_option( WPDA::OPTION_BE_INNODB_COUNT ) );
        ?>.
												Uses estimated row count if estimate > <?php 
        echo esc_attr( WPDA::get_option( WPDA::OPTION_BE_INNODB_COUNT ) );
        ?>.
											</div>
										</div>
										<h4>
											<?php 
        esc_html_e( 'Query buffer size', 'wp-data-access' );
        ?>
										</h4>
										<div style="font-size:90%;">
											<label class="wpda_action_font">
												<?php 
        esc_html_e( 'Max rows per fetch', 'wp-data-access' );
        ?>
											</label>
											<input type="text"
												   id="<?php 
        echo esc_attr( $this->table_name );
        ?>_query_buffer_size"
												<?php 
        if ( isset( $settings_db_custom->table_settings->query_buffer_size ) ) {
            echo 'value="' . esc_attr( $settings_db_custom->table_settings->query_buffer_size ) . '"';
        }
        ?>
											/>
											<span class="dashicons dashicons-editor-help wpda_tooltip" title="Large exports to other databases can result in an 'allowed memory size exhausted' error. Reduce the query buffer size to prevent this fatal error.

Start with high values and work down until the error disappears." style="cursor:pointer;vertical-align:middle"></span>
										</div>
										<h4>
											<?php 
        esc_html_e( 'Access control', 'wp-data-access' );
        ?>
										</h4>
										<div style="font-size:90%;">
											<label class="wpda_action_font">
												<input type="checkbox"
													   id="<?php 
        echo esc_attr( $this->table_name );
        ?>_row_level_security"
													<?php 
        if ( isset( $settings_db_custom->table_settings->row_level_security ) ) {
            echo ( 'true' === $settings_db_custom->table_settings->row_level_security ? 'checked' : '' );
        }
        ?>
												/>
												<?php 
        esc_html_e( 'Enable row level access control (adds token to row actions)', 'wp-data-access' );
        ?>
											</label>
										</div>
										<h4>
											<?php 
        esc_html_e( 'Process hyperlink columns as', 'wp-data-access' );
        ?>
										</h4>
										<div style="font-size:90%;">
											<label for="<?php 
        echo esc_attr( $this->table_name );
        ?>table_top_setting_hyperlink_definition_json">
												<input type="radio"
													   id="<?php 
        echo esc_attr( $this->table_name );
        ?>table_top_setting_hyperlink_definition_json"
													   name="<?php 
        echo esc_attr( $this->table_name );
        ?>table_top_setting_hyperlink_definition"
													   value="json"
													   class="wpda_table_top_setting_item wpda_action_font"
													   <?php 
        if ( isset( $settings_db_custom->table_settings->hyperlink_definition ) ) {
            echo ( 'json' === $settings_db_custom->table_settings->hyperlink_definition ? 'checked' : '' );
        } else {
            echo 'checked';
        }
        ?>
												/>
												<?php 
        esc_html_e( 'Preformatted JSON (allows individual label and target setting)', 'wp-data-access' );
        ?>
											</label>
											<br/>
											<label for="<?php 
        echo esc_attr( $this->table_name );
        ?>table_top_setting_hyperlink_definition_text" style="display: inline-block; margin-top: 10px">
												<input type="radio"
													   id="<?php 
        echo esc_attr( $this->table_name );
        ?>table_top_setting_hyperlink_definition_text"
													   name="<?php 
        echo esc_attr( $this->table_name );
        ?>table_top_setting_hyperlink_definition"
													   value="text"
													   class="wpda_table_top_setting_item wpda_action_font"
													   <?php 
        if ( isset( $settings_db_custom->table_settings->hyperlink_definition ) ) {
            echo ( 'text' === $settings_db_custom->table_settings->hyperlink_definition ? 'checked' : '' );
        }
        ?>
												/>
												<?php 
        esc_html_e( 'Plain text (column name used as link, opens a new tab or window)', 'wp-data-access' );
        ?>
											</label>
										</div>
										<br/>
										<div>
											<button type="button"
												   id="wpda_legacy_save_table_settings"
												   class="button button-primary"
											>
												<i class="fas fa-check wpda_icon_on_button"></i>
												<?php 
        esc_html_e( 'Save Table Settings', 'wp-data-access' );
        ?>
											</button>
										</div>
									</ul>
								</li>
								<li>
									<ul class="wpda_table_settings_nested wpda_table_column_settings">
										<h2>
											<?php 
        esc_html_e( 'Column Settings', 'wp-data-access' );
        ?>
											<a href="https://docs.legacy.wpdataaccess.com/docs/column-settings/" target="_blank">
												<span class="dashicons dashicons-editor-help wpda_tooltip"
													  title="<?php 
        esc_html_e( 'Help opens in a new tab or window', 'wp-data-access' );
        ?>"
													  style="cursor:pointer"></span>
											</a>
										</h2>
										<table class="wpda_table_settings">
											<thead>
											<tr>
												<th>
													<span>
														<?php 
        esc_html_e( 'Column', 'wp-data-access' );
        ?>
													</span>
												</th>
												<th>
													<span>
														<?php 
        esc_html_e( 'Label on List Table', 'wp-data-access' );
        ?>
													</span>
													<span
														class="dashicons dashicons-editor-help wpda_tooltip"
														title="<?php 
        esc_html_e( 'Define column labels for list tables', 'wp-data-access' );
        ?>"
													></span>
												</th>
												<th>
													<span>
														<?php 
        esc_html_e( 'Label on Data Entry Form', 'wp-data-access' );
        ?>
													</span>
													<span class="dashicons dashicons-editor-help wpda_tooltip"
														  title="<?php 
        esc_html_e( 'Define column labels for data entry forms', 'wp-data-access' );
        ?>"
													></span>
												</th>
												<th>
													<span>
														<?php 
        esc_html_e( 'Column Type', 'wp-data-access' );
        ?>
													</span>
													<span class="dashicons dashicons-editor-help wpda_tooltip"
														  title="<?php 
        esc_html_e( 'Featured plugin column types', 'wp-data-access' );
        ?>"
													></span>
												</th>
												<?php 
        foreach ( $column_settings_add_column as $add_column ) {
            ?>
													<th>
														<span>
															<?php 
            echo esc_attr( $add_column['label'] );
            ?>
														</span>
														<span class="dashicons dashicons-editor-help wpda_tooltip"
															  title="<?php 
            echo esc_attr( $add_column['hint'] );
            ?>"
														></span>
													</th>
												<?php 
        }
        ?>
												</tr>
											</thead>
											<tbody>
											<?php 
        $columns = $this->wpda_list_columns->get_table_column_headers();
        $media_pool = WPDA_Media_Model::get_pool();
        $media_cols = array();
        if ( isset( $media_pool[$this->schema_name][$this->table_name] ) ) {
            $media_cols = $media_pool[$this->schema_name][$this->table_name];
        }
        foreach ( $this->table_structure as $column ) {
            $label_list_table = $this->wpda_list_columns->get_column_label( $column['Field'] );
            $label_data_entry = ( isset( $columns[$column['Field']] ) ? $columns[$column['Field']] : '' );
            $option = ( isset( $media_cols[$column['Field']] ) ? $media_cols[$column['Field']] : '' );
            ?>
												<tr>
													<td>
														<?php 
            echo esc_attr( $column['Field'] );
            ?>
													</td>
													<td>
														<input
																id="list_label_<?php 
            echo esc_attr( $column['Field'] );
            ?>"
																class="wpda_table_setting_item wpda_action_font"
																type="text"
																value="<?php 
            echo esc_attr( $label_list_table );
            ?>"
																style="font-size: 90%;"
														>
													</td>
													<td>
														<input
																id="form_label_<?php 
            echo esc_attr( $column['Field'] );
            ?>"
																class="wpda_table_setting_item wpda_action_font"
																type="text"
																value="<?php 
            echo esc_attr( $label_data_entry );
            ?>"
																style="font-size: 90%;"
														>
													</td>
													<td style="text-align:center;">
														<select id="column_media_<?php 
            echo esc_attr( $column['Field'] );
            ?>"
																class="wpda_table_setting_item wpda_action_font"
																style="font-size: 90%; height: 30px;"
														>
															<option value="" <?php 
            echo ( '' === $option ? 'selected' : '' );
            ?>>
															</option>
															<option value="Attachment" <?php 
            echo ( 'Attachment' === $option ? 'selected' : '' );
            ?>>
																Attachment
															</option>
															<option value="Audio" <?php 
            echo ( 'Audio' === $option ? 'selected' : '' );
            ?>>
																Audio
															</option>
															<option value="Hyperlink" <?php 
            echo ( 'Hyperlink' === $option ? 'selected' : '' );
            ?>>
																Hyperlink
															</option>
															<option value="Image" <?php 
            echo ( 'Image' === $option ? 'selected' : '' );
            ?>>
																Image
															</option>
															<option value="ImageURL" <?php 
            echo ( 'ImageURL' === $option ? 'selected' : '' );
            ?>>
																Image URL
															</option>
															<option value="Video" <?php 
            echo ( 'Video' === $option ? 'selected' : '' );
            ?>>
																Video
															</option>
														</select>
														<input type="hidden"
															   id="column_media_<?php 
            echo esc_attr( $column['Field'] );
            ?>_dml"
															   value="<?php 
            echo ( isset( $media_cols[$column['Field']] ) ? 'UPDATE' : 'INSERT' );
            ?>"
														/>
														<input type="hidden"
															   id="column_media_<?php 
            echo esc_attr( $column['Field'] );
            ?>_old"
															   value="<?php 
            echo esc_attr( $option );
            ?>"
														/>
													</td>
													<?php 
            foreach ( $column_settings_add_column as $add_column ) {
                ?>
														<td>
															<?php 
                if ( 'Edit' === $add_column['label'] ) {
                    echo '<label>';
                }
                ?>
															<input
																type="<?php 
                echo esc_attr( $add_column['type'] );
                ?>"
																id="<?php 
                echo esc_attr( $add_column['name_prefix'] ) . esc_attr( $column['Field'] );
                ?>"
																class="wpda_table_setting_item wpda_action_font wpda_tooltip"
																<?php 
                if ( 'keys' === $add_column['disable'] ) {
                    $primary_key = $this->wpda_list_columns->get_table_primary_key();
                    if ( in_array( $column['Field'], $primary_key ) ) {
                        // phpcs:ignore -- 8.1 proof
                        echo 'disabled="disabled" title="Not available for key columns"';
                    }
                }
                if ( 'checkbox' === $add_column['type'] ) {
                    $column_name = $add_column['name_prefix'] . esc_attr( $column['Field'] );
                    if ( isset( $settings_db_custom->custom_settings->{$column_name} ) ) {
                        echo ( $settings_db_custom->custom_settings->{$column_name} ? 'checked' : '' );
                    } else {
                        echo esc_attr( $add_column['default'] );
                    }
                }
                ?>
															><?php 
                if ( 'Edit' === $add_column['label'] ) {
                    echo '</label>';
                }
                ?>
														</td>
													<?php 
            }
            ?>
												</tr>
												<?php 
        }
        ?>
											</tbody></table>
										<br/>
										<div>
											<button type="button"
												   id="wpda_legacy_save_column_settings"
												   class="button button-primary"
											>
												<i class="fas fa-check wpda_icon_on_button"></i>
												<?php 
        esc_html_e( 'Save Column Settings', 'wp-data-access' );
        ?>
											</button>
										</div>
									</ul>
								</li>
								<?php 
        $this->settings_tab_dynamic_hyperlinks( $settings_db_custom );
        do_action( 'wpda_append_table_settings' );
        ?>
							</ul>
							<input class="wpda_table_setting_item" type="hidden" id="wpda_legacy_sql_dml"
								   value="<?php 
        echo esc_attr( $sql_dml );
        ?>"
							/>
						</div>
					</td>
				</tr>
			</table>
			<script type='text/javascript'>
				jQuery(function () {
					// Show table settings menu on startup
					settingsNav("#wpda_table_settings_legacy", "wpda_table_table_settings", false);
					jQuery("#wpda_table_settings_legacy").find("a.nav-tab").removeClass("nav-tab-active");
					jQuery("#wpda_table_settings_legacy").find("a.nav-tab:first-child").addClass("nav-tab-active");

					// Table settings
					jQuery('#wpda_legacy_save_table_settings').click( function() {
						return submit_table_settings(
							'legacy',
							'<?php 
        echo esc_attr( $this->schema_name );
        ?>',
							'<?php 
        echo esc_attr( $this->table_name );
        ?>'
						);
					});
					jQuery('#wpda_legacy_cancel_table_settings').click( function() {
						jQuery('#wpda_admin_menu_actions_legacy').toggle();
						wpda_toggle_row_actions('legacy');
					});

					// Column settings
					jQuery('#wpda_legacy_save_column_settings').click( function() {
						return submit_column_settings(
							'legacy',
							'<?php 
        echo esc_attr( $this->schema_name );
        ?>',
							'<?php 
        echo esc_attr( $this->table_name );
        ?>'
						);
					});
					jQuery('#wpda_legacy_cancel_column_settings').click( function() {
						jQuery('#wpda_admin_menu_actions_legacy').toggle();
						wpda_toggle_row_actions('legacy');
					});

					jQuery('.wpda_tooltip').tooltip();
				});

				var custom_column_settings = [];
				<?php 
        foreach ( $column_settings_add_column as $add_column ) {
            // phpcs:disable WordPress.Security.EscapeOutput
            echo 'custom_column_settings.push("' . $add_column['name_prefix'] . '");';
            // phpcs:enable WordPress.Security.EscapeOutput
        }
        ?>
			</script>
			<?php 
    }

    private function settings_tab_dynamic_hyperlinks( $settings_db_custom ) {
        ?>
			<li>
				<ul class="wpda_table_settings_nested wpda_table_dynamic_hyperlinks_settings">
					<h2>
						<?php 
        esc_html_e( 'Dynamic Hyperlinks', 'wp-data-access' );
        ?>
						<a href="https://docs.legacy.wpdataaccess.com/docs/dynamic-hyperlinks/" target="_blank">
							<span class="dashicons dashicons-editor-help wpda_tooltip"
								  title="<?php 
        echo sprintf( esc_attr__( 'Help opens in a new tab or window', 'wp-data-access' ), esc_attr( $this->table_name ) );
        ?>"
								  style="cursor:pointer"></span>
						</a>
					</h2>
					<table class="wpda_table_settings">
						<thead>
							<tr>
								<th>
									<span>
										<?php 
        esc_html_e( 'Hyperlink Label', 'wp-data-access' );
        ?>
									</span>
								</th>
								<th style="text-align:center">
									<span>
										<?php 
        esc_html_e( '+List?', 'wp-data-access' );
        ?>
									</span>
									<span class="dashicons dashicons-editor-help wpda_tooltip"
										  title="<?php 
        esc_html_e( 'Add hyperlink to list', 'wp-data-access' );
        ?>"
										  style="cursor:pointer;"></span>
								</th>
								<th style="text-align:center">
									<span>
										<?php 
        esc_html_e( '+Form?', 'wp-data-access' );
        ?>
									</span>
									<span class="dashicons dashicons-editor-help wpda_tooltip"
										  title="<?php 
        esc_html_e( 'Add hyperlink to form', 'wp-data-access' );
        ?>"
										  style="cursor:pointer;"></span>
								</th>
								<th style="text-align:center">
									<span>
										<?php 
        esc_html_e( '+Window?', 'wp-data-access' );
        ?>
									</span>
									<span class="dashicons dashicons-editor-help wpda_tooltip"
										  title="<?php 
        esc_html_e( 'Opens URL in a new tab or window', 'wp-data-access' );
        ?>"
										  style="cursor:pointer;"></span>
								</th>
								<th>
									<span>
										<?php 
        // phpcs:disable WordPress.Security.EscapeOutput
        esc_html_e( 'HTML', 'wp-data-access' );
        ?>
									</span>
									<span class="dashicons dashicons-editor-help wpda_tooltip"
										  title="<?php 
        esc_html_e( 'Just the URL! For example:

	https://yoursite.com/services.php?name=$$column_name$$

	Variable $$column_name$$ will be replaced with the value of column $$column_name$$ in table `', 'wp-data-access' ) . esc_attr( $this->table_name ) . '`.';
        // phpcs:enable WordPress.Security.EscapeOutput
        ?>"
										  style="cursor:pointer;"></span>
								</th>
								<th></th>
							</tr>
						<thead>
						<tbody id="wpda_legacy_add_hyperlink_body">
						<?php 
        if ( isset( $settings_db_custom->hyperlinks ) && is_array( $settings_db_custom->hyperlinks ) ) {
            foreach ( $settings_db_custom->hyperlinks as $hyperlink ) {
                $hyperlink_label = ( isset( $hyperlink->hyperlink_label ) ? $hyperlink->hyperlink_label : '' );
                $hyperlink_list = ( isset( $hyperlink->hyperlink_list ) && true === $hyperlink->hyperlink_list ? 'checked' : '' );
                $hyperlink_form = ( isset( $hyperlink->hyperlink_form ) && true === $hyperlink->hyperlink_form ? 'checked' : '' );
                $hyperlink_target = ( isset( $hyperlink->hyperlink_target ) && true === $hyperlink->hyperlink_target ? 'checked' : '' );
                $hyperlink_html = ( isset( $hyperlink->hyperlink_html ) ? $hyperlink->hyperlink_html : '' );
                ?>
								<tr>
									<td>
										<input data-id="hyperlink_label"
											   class="wpda_action_font"
											   type="text"
											   value="<?php 
                echo esc_attr( $hyperlink_label );
                ?>"
											   style="width:100%"
										/>
									</td>
									<td style="text-align:center">
										<input data-id="hyperlink_list"
											   class="wpda_action_font"
											   type="checkbox"
											   style="margin-top:7px;"
											<?php 
                echo esc_attr( $hyperlink_list );
                ?>
										/>
									</td>
									<td style="text-align:center">
										<input data-id="hyperlink_form"
											   class="wpda_action_font"
											   type="checkbox"
											   style="margin-top:7px;"
											<?php 
                echo esc_attr( $hyperlink_form );
                ?>
										/>
									</td>
									<td style="text-align:center">
										<input data-id="hyperlink_target"
											   class="wpda_action_font"
											   type="checkbox"
											   style="margin-top:7px;"
											<?php 
                echo esc_attr( $hyperlink_target );
                ?>
										/>
									</td>
									<td>
										<textarea data-id="hyperlink_html"
												  rows="5"
												  class="wpda_action_font"
												  style="width:100%;resize:both;"
										><?php 
                // phpcs:disable WordPress.Security.EscapeOutput
                echo urldecode( $hyperlink_html );
                // phpcs:enable WordPress.Security.EscapeOutput
                ?></textarea>
									</td>
									<td>
										<a href="javascript:void(0)"
										   class="dashicons dashicons-trash"
										   style="margin-top:4px;"
										   onclick="if (confirm('<?php 
                esc_html_e( 'Delete hyperlink?', 'wp-data-access' );
                ?>')) { jQuery(this).closest('tr').remove() }"
										></a>
									</td>
								</tr>
								<?php 
            }
        }
        ?>
						</tbody>
					</table>
					<br/>
					<div>
						<button type="button"
								id="wpda_legacy_save_hyperlinks"
								class="button button-primary"
						>
							<i class="fas fa-check wpda_icon_on_button"></i>
							<?php 
        esc_html_e( 'Save Dynamic Hyperlinks', 'wp-data-access' );
        ?>
						</button>
						<button type="button"
								id="wpda_legacy_add_hyperlink_link"
								class="button button-secondary"
						>
							<i class="fas fa-add wpda_icon_on_button"></i>
							Add Hyperlink
						</button>
						<script>
							jQuery(function() {
								jQuery('#wpda_legacy_save_hyperlinks').click( function() {
									return submit_hyperlinks(
										'legacy',
										'<?php 
        echo esc_attr( $this->schema_name );
        ?>',
										'<?php 
        echo esc_attr( $this->table_name );
        ?>'
									);
								});

								jQuery('#wpda_legacy_add_hyperlink_link').click( function() {
									// Add new row to table
									jQuery("#wpda_legacy_add_hyperlink_body").append(`
										<tr>
											<td>
												<input data-id="hyperlink_label"
													   class="wpda_action_font"
													   type="text"
													   value=""
													   style="width:100%"
												/>
											</td>
											<td style="text-align:center">
												<input data-id="hyperlink_link"
													   class="wpda_action_font"
													   type="checkbox"
													   style="margin-top:7px;"
												/>
											</td>
											<td style="text-align:center">
												<input data-id="hyperlink_form"
													   class="wpda_action_font"
													   type="checkbox"
													   style="margin-top:7px;"
												/>
											</td>
											<td style="text-align:center">
												<input data-id="hyperlink_target"
													   class="wpda_action_font"
													   type="checkbox"
													   style="margin-top:7px;"
												/>
											</td>
											<td>
												<textarea data-id="hyperlink_html"
														  rows="5"
														  class="wpda_action_font"
														  style="width:100%;resize:both;"
												></textarea>
											</td>
											<td>
												<a href="javascript:void(0)"
												   class="dashicons dashicons-trash"
												   style="margin-top:4px;"
												   onclick="if (confirm('<?php 
        /* translators: %s = row containing the hyperlink */
        esc_html_e( 'Delete hyperlink %s?', 'wp-data-access' );
        ?>')) { jQuery(this).closest('tr').remove() }"
												></a>
											</td>
										</tr>
									`);
								});
							});
						</script>
					</div>
				</ul>
			</li>
			<?php 
    }

}
