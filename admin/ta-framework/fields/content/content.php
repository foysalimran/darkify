<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Field: content
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'DRK_LITE_Field_content' ) ) {
	class DRK_LITE_Field_content extends DRK_LITE_Fields {


		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {

			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			if ( ! empty( $this->field['content'] ) ) {

				echo wp_kses_post( $this->field['content'] );

			}
		}
	}
}
