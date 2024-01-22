<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Field: number
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'DRK_LITE_Field_number' ) ) {
	class DRK_LITE_Field_number extends DRK_LITE_Fields {


		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {

			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'min'  => 'any',
					'max'  => 'any',
					'step' => 'any',
					'unit' => '',
				)
			);

			echo wp_kses_post( $this->field_before() );
			echo '<div class="drk_lite--wrap">';
			echo '<input type="number" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '"' . wp_kses_data($this->field_attributes()) . ' min="' . esc_attr( $args['min'] ) . '" max="' . esc_attr( $args['max'] ) . '" step="' . esc_attr( $args['step'] ) . '"/>';
			echo ( ! empty( $args['unit'] ) ) ? '<span class="drk_lite--unit">' . esc_attr( $args['unit'] ) . '</span>' : '';
			echo '</div>';
			echo wp_kses_post( $this->field_after() );
		}

		public function output() {

			$output    = '';
			$elements  = ( is_array( $this->field['output'] ) ) ? $this->field['output'] : array_filter( (array) $this->field['output'] );
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$mode      = ( ! empty( $this->field['output_mode'] ) ) ? $this->field['output_mode'] : 'width';
			$unit      = ( ! empty( $this->field['unit'] ) ) ? $this->field['unit'] : 'px';

			if ( ! empty( $elements ) && isset( $this->value ) && $this->value !== '' ) {
				foreach ( $elements as $key_property => $element ) {
					if ( is_numeric( $key_property ) ) {
						if ( $mode ) {
								$output = implode( ',', $elements ) . '{' . $mode . ':' . esc_attr( $this->value ) . $unit . $important . ';}';
						}
						break;
					} else {
						$output .= $element . '{' . $key_property . ':' . esc_attr( $this->value ) . $unit . $important . '}';
					}
				}
			}

			$this->parent->output_css .= $output;

			return $output;
		}
	}
}
