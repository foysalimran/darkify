<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: repeater
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'DRK_LITE_Field_repeater' ) ) {
	class DRK_LITE_Field_repeater extends DRK_LITE_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'max'          => 0,
					'min'          => 0,
					'button_title' => '<i class="fas fa-plus-circle"></i>',
				)
			);

			if ( preg_match( '/' . preg_quote( '[' . $this->field['id'] . ']' ) . '/', $this->unique ) ) {

				echo '<div class="drk_lite-notice drk_lite-notice-danger">' . esc_html__( 'Error: Field ID conflict.', 'darkify' ) . '</div>';

			} else {

				echo wp_kses_post( $this->field_before() );

				echo '<div class="drk_lite-repeater-item drk_lite-repeater-hidden" data-depend-id="' . esc_attr( $this->field['id'] ) . '">';
				echo '<div class="drk_lite-repeater-content">';
				foreach ( $this->field['fields'] as $field ) {

					$field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
					$field_unique  = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . '][0]' : $this->field['id'] . '[0]';

					DRK_LITE::field( $field, $field_default, '___' . $field_unique, 'field/repeater' );

				}
				echo '</div>';
				echo '<div class="drk_lite-repeater-helper">';
				echo '<div class="drk_lite-repeater-helper-inner">';
				echo '<i class="drk_lite-repeater-sort fas fa-arrows-alt"></i>';
				echo '<i class="drk_lite-repeater-clone far fa-clone"></i>';
				echo '<i class="drk_lite-repeater-remove drk_lite-confirm fas fa-times" data-confirm="' . esc_html__( 'Are you sure to delete this item?', 'darkify' ) . '"></i>';
				echo '</div>';
				echo '</div>';
				echo '</div>';

				echo '<div class="drk_lite-repeater-wrapper drk_lite-data-wrapper" data-field-id="[' . esc_attr( $this->field['id'] ) . ']" data-max="' . esc_attr( $args['max'] ) . '" data-min="' . esc_attr( $args['min'] ) . '">';

				if ( ! empty( $this->value ) && is_array( $this->value ) ) {

					$num = 0;

					foreach ( $this->value as $key => $value ) {

						echo '<div class="drk_lite-repeater-item">';
						echo '<div class="drk_lite-repeater-content">';
						foreach ( $this->field['fields'] as $field ) {

								$field_unique = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . '][' . $num . ']' : $this->field['id'] . '[' . $num . ']';
								$field_value  = ( isset( $field['id'] ) && isset( $this->value[ $key ][ $field['id'] ] ) ) ? $this->value[ $key ][ $field['id'] ] : '';

								DRK_LITE::field( $field, $field_value, $field_unique, 'field/repeater' );

						}
						echo '</div>';
						echo '<div class="drk_lite-repeater-helper">';
						echo '<div class="drk_lite-repeater-helper-inner">';
						echo '<i class="drk_lite-repeater-sort fas fa-arrows-alt"></i>';
						echo '<i class="drk_lite-repeater-clone far fa-clone"></i>';
						echo '<i class="drk_lite-repeater-remove drk_lite-confirm fas fa-times" data-confirm="' . esc_html__( 'Are you sure to delete this item?', 'darkify' ) . '"></i>';
						echo '</div>';
						echo '</div>';
						echo '</div>';

						++$num;

					}
				}

				echo '</div>';

				echo '<div class="drk_lite-repeater-alert drk_lite-repeater-max">' . esc_html__( 'You cannot add more.', 'darkify' ) . '</div>';
				echo '<div class="drk_lite-repeater-alert drk_lite-repeater-min">' . esc_html__( 'You cannot remove more.', 'darkify' ) . '</div>';
				echo '<a href="#" class="button button-primary drk_lite-repeater-add">' . esc_html( $args['button_title'] ) . '</a>';

				echo wp_kses_post( $this->field_after() );

			}
		}

		public function enqueue() {

			if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
				wp_enqueue_script( 'jquery-ui-sortable' );
			}
		}
	}
}
