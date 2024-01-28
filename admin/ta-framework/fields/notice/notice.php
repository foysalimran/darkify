<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: notice
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'DRK_LITE_Field_notice' ) ) {
	class DRK_LITE_Field_notice extends DRK_LITE_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$style = ( ! empty( $this->field['style'] ) ) ? $this->field['style'] : 'normal';

			echo ( ! empty( $this->field['content'] ) ) ? '<div class="drk_lite-notice drk_lite-notice-' . esc_attr( $style ) . '">' . wp_kses_post($this->field['content']) . '</div>' : '';
		}
	}
}
