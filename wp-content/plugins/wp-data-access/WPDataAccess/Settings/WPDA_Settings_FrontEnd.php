<?php

namespace WPDataAccess\Settings {

	use WPDataAccess\Utilities\WPDA_Message_Box;
	use WPDataAccess\WPDA;

	class WPDA_Settings_FrontEnd extends WPDA_Settings {

		/**
		 * Add front-end tab content
		 *
		 * See class documentation for flow explanation.
		 *
		 * @since   1.0.0
		 */
		protected function add_content() {
			global $wpdb;

			if ( isset( $_REQUEST['action'] ) ) {
				$action = sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ); // input var okay.

				// Security check.
				$wp_nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ) : ''; // input var okay.
				if ( ! wp_verify_nonce( $wp_nonce, 'wpda-front-end-settings-' . WPDA::get_current_user_login() ) ) {
					wp_die( esc_attr__( 'ERROR: Not authorized', 'wp-data-access' ) );
				}

				if ( 'save' === $action ) {
					WPDA::set_option(
						WPDA::OPTION_FE_ADD_PROJECTS_TO_TOOLBAR,
						isset( $_REQUEST['add_projects_to_toolbar'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['add_projects_to_toolbar'] ) ) : 'off' // input var okay.
					);
				} elseif ( 'setdefaults' === $action ) {
					// Set all front-end settings back to default
					WPDA::set_option( WPDA::OPTION_FE_ADD_PROJECTS_TO_TOOLBAR );
				}

				$msg = new WPDA_Message_Box(
					array(
						'message_text' => __( 'Settings saved', 'wp-data-access' ),
					)
				);
				$msg->box();

			}

			// Get options
			$add_projects_to_toolbar = WPDA::get_option( WPDA::OPTION_FE_ADD_PROJECTS_TO_TOOLBAR );
			?>
			<form id="wpda_settings_frontend" method="post"
				  action="?page=<?php echo esc_attr( $this->page ); ?>&tab=frontend">
				<table class="wpda-table-settings">
					<tr>
						<th><?php esc_html_e( 'Admin toolbar', 'wp-data-access' ); ?></th>
						<td>
							<label>
								<input type="checkbox" name="add_projects_to_toolbar"
									<?php echo 'on' === $add_projects_to_toolbar ? 'checked' : ''; ?>
								/>
								<?php esc_html_e( 'Add projects to toolbar', 'wp-data-access' ); ?>
							</label>
						</td>
					</tr>
				</table>

				<div class="wpda-table-settings-button">
					<input type="hidden" name="action" value="save"/>
					<button type="submit" class="button button-primary">
						<i class="fas fa-check wpda_icon_on_button"></i>
						<?php esc_html_e( 'Save Front-end Settings', 'wp-data-access' ); ?>
					</button>
					<a href="javascript:void(0)"
					   onclick="if (confirm('<?php esc_html_e( 'Reset to defaults?', 'wp-data-access' ); ?>')) {
						   jQuery('input[name=&quot;action&quot;]').val('setdefaults');
						   jQuery('#wpda_settings_frontend').trigger('submit')
						   }"
					   class="button">
						<i class="fas fa-times-circle wpda_icon_on_button"></i>
						<?php esc_html_e( 'Reset Front-end Settings To Defaults', 'wp-data-access' ); ?>
					</a>
				</div>
				<?php wp_nonce_field( 'wpda-front-end-settings-' . WPDA::get_current_user_login(), '_wpnonce', false ); ?>
			</form>

			<?php

		}

	}

}
