<?php

/**
 * Suppress "error - 0 - No summary was found for this file" on phpdoc generation
 *
 * @package WPDataAccess\Simple_Form
 */

namespace WPDataAccess\Simple_Form {

	/**
	 * Class WPDA_Simple_Form_Item_Dynamic_Hyperlink
	 *
	 * Add dynamic (read-only) hyperlink to form (taken from table settings: dynamic hyperlinks).
	 * Allows substitution of column values.
	 *
	 * @author  Peter Schulz
	 * @since   3.0.3
	 */
	class WPDA_Simple_Form_Item_Dynamic_Hyperlink extends WPDA_Simple_Form_Item {

		protected $hyperlink_label  = '';
		protected $hyperlink_target = '';
		protected $hyperlink_html   = '';

		/**
		 * WPDA_Simple_Form_Item_Dynamic_Hyperlink constructor.
		 *
		 * @param array $args
		 */
		public function __construct( $args = array() ) {
			parent::__construct( $args );

			$this->hyperlink_label  = isset( $args['hyperlink_label'] ) ? $args['hyperlink_label'] : '';
			$this->hyperlink_target = isset( $args['hyperlink_target'] ) ? $args['hyperlink_target'] : false;
			$this->hyperlink_html   = isset( $args['hyperlink_html'] ) ? $args['hyperlink_html'] : '';

			$this->set_label( $this->hyperlink_label );

			$this->item_hide_icon = true;
		}

		/**
		 * Overwrite method
		 */
		protected function show_item() {
			if ( false !== strpos( (string) $this->hyperlink_html, '&lt;' ) ) {
				echo wp_kses_post( html_entity_decode( $this->hyperlink_html ) );
			} else {
				echo '<a href="' . esc_url( $this->hyperlink_html ) . '" ' .
				     (true === $this->hyperlink_target ? 'target="_blank"' : '') .
				     '>' . esc_attr( $this->hyperlink_label ) . '</a>';
			}
		}

	}

}