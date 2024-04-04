<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: background
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'DRK_LITE_Field_background' ) ) {
	class DRK_LITE_Field_background extends DRK_LITE_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'background_color'              => true,
					'background_image'              => true,
					'background_position'           => true,
					'background_repeat'             => true,
					'background_attachment'         => true,
					'background_size'               => true,
					'background_origin'             => false,
					'background_clip'               => false,
					'background_blend_mode'         => false,
					'background_gradient'           => false,
					'background_gradient_color'     => true,
					'background_gradient_direction' => true,
					'background_image_preview'      => true,
					'background_auto_attributes'    => false,
					'compact'                       => false,
					'background_image_library'      => 'image',
					'background_image_placeholder'  => esc_html__( 'Not selected', 'darkify' ),
				)
			);

			if ( $args['compact'] ) {
				$args['background_color']           = false;
				$args['background_auto_attributes'] = true;
			}

			$default_value = array(
				'background-color'              => '',
				'background-image'              => '',
				'background-position'           => '',
				'background-repeat'             => '',
				'background-attachment'         => '',
				'background-size'               => '',
				'background-origin'             => '',
				'background-clip'               => '',
				'background-blend-mode'         => '',
				'background-gradient-color'     => '',
				'background-gradient-direction' => '',
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$this->value = wp_parse_args( $this->value, $default_value );

			echo wp_kses_post( $this->field_before() );

			echo '<div class="drk_lite--background-colors">';

			//
			// Background Color
			if ( ! empty( $args['background_color'] ) ) {

				echo '<div class="drk_lite--color">';

				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="drk_lite--title">' . esc_html__( 'From', 'darkify' ) . '</div>' : '';

				DRK_LITE::field(
					array(
						'id'      => 'background-color',
						'type'    => 'color',
						'default' => $default_value['background-color'],
					),
					$this->value['background-color'],
					$this->field_name(),
					'field/background'
				);

				echo '</div>';

			}

			//
			// Background Gradient Color
			if ( ! empty( $args['background_gradient_color'] ) && ! empty( $args['background_gradient'] ) ) {

				echo '<div class="drk_lite--color">';

				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="drk_lite--title">' . esc_html__( 'To', 'darkify' ) . '</div>' : '';

				DRK_LITE::field(
					array(
						'id'      => 'background-gradient-color',
						'type'    => 'color',
						'default' => $default_value['background-gradient-color'],
					),
					$this->value['background-gradient-color'],
					$this->field_name(),
					'field/background'
				);

				echo '</div>';

			}

			//
			// Background Gradient Direction
			if ( ! empty( $args['background_gradient_direction'] ) && ! empty( $args['background_gradient'] ) ) {

				echo '<div class="drk_lite--color">';

				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="drk_lite---title">' . esc_html__( 'Direction', 'darkify' ) . '</div>' : '';

				DRK_LITE::field(
					array(
						'id'      => 'background-gradient-direction',
						'type'    => 'select',
						'options' => array(
							''          => esc_html__( 'Gradient Direction', 'darkify' ),
							'to bottom' => esc_html__( '&#8659; top to bottom', 'darkify' ),
							'to right'  => esc_html__( '&#8658; left to right', 'darkify' ),
							'135deg'    => esc_html__( '&#8664; corner top to right', 'darkify' ),
							'-135deg'   => esc_html__( '&#8665; corner top to left', 'darkify' ),
						),
					),
					$this->value['background-gradient-direction'],
					$this->field_name(),
					'field/background'
				);

				echo '</div>';

			}

			echo '</div>';

			//
			// Background Image
			if ( ! empty( $args['background_image'] ) ) {

				echo '<div class="drk_lite--background-image">';

				DRK_LITE::field(
					array(
						'id'          => 'background-image',
						'type'        => 'media',
						'class'       => 'drk_lite-assign-field-background',
						'library'     => $args['background_image_library'],
						'preview'     => $args['background_image_preview'],
						'placeholder' => $args['background_image_placeholder'],
						'attributes'  => array( 'data-depend-id' => $this->field['id'] ),
					),
					$this->value['background-image'],
					$this->field_name(),
					'field/background'
				);

				echo '</div>';

			}

			$auto_class   = ( ! empty( $args['background_auto_attributes'] ) ) ? ' drk_lite--auto-attributes' : '';
			$hidden_class = ( ! empty( $args['background_auto_attributes'] ) && empty( $this->value['background-image']['url'] ) ) ? ' drk_lite--attributes-hidden' : '';

			echo '<div class="drk_lite--background-attributes' . esc_attr( $auto_class . $hidden_class ) . '">';

			//
			// Background Position
			if ( ! empty( $args['background_position'] ) ) {

				DRK_LITE::field(
					array(
						'id'      => 'background-position',
						'type'    => 'select',
						'options' => array(
							''              => esc_html__( 'Background Position', 'darkify' ),
							'left top'      => esc_html__( 'Left Top', 'darkify' ),
							'left center'   => esc_html__( 'Left Center', 'darkify' ),
							'left bottom'   => esc_html__( 'Left Bottom', 'darkify' ),
							'center top'    => esc_html__( 'Center Top', 'darkify' ),
							'center center' => esc_html__( 'Center Center', 'darkify' ),
							'center bottom' => esc_html__( 'Center Bottom', 'darkify' ),
							'right top'     => esc_html__( 'Right Top', 'darkify' ),
							'right center'  => esc_html__( 'Right Center', 'darkify' ),
							'right bottom'  => esc_html__( 'Right Bottom', 'darkify' ),
						),
					),
					$this->value['background-position'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Repeat
			if ( ! empty( $args['background_repeat'] ) ) {

				DRK_LITE::field(
					array(
						'id'      => 'background-repeat',
						'type'    => 'select',
						'options' => array(
							''          => esc_html__( 'Background Repeat', 'darkify' ),
							'repeat'    => esc_html__( 'Repeat', 'darkify' ),
							'no-repeat' => esc_html__( 'No Repeat', 'darkify' ),
							'repeat-x'  => esc_html__( 'Repeat Horizontally', 'darkify' ),
							'repeat-y'  => esc_html__( 'Repeat Vertically', 'darkify' ),
						),
					),
					$this->value['background-repeat'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Attachment
			if ( ! empty( $args['background_attachment'] ) ) {

				DRK_LITE::field(
					array(
						'id'      => 'background-attachment',
						'type'    => 'select',
						'options' => array(
							''       => esc_html__( 'Background Attachment', 'darkify' ),
							'scroll' => esc_html__( 'Scroll', 'darkify' ),
							'fixed'  => esc_html__( 'Fixed', 'darkify' ),
						),
					),
					$this->value['background-attachment'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Size
			if ( ! empty( $args['background_size'] ) ) {

				DRK_LITE::field(
					array(
						'id'      => 'background-size',
						'type'    => 'select',
						'options' => array(
							''        => esc_html__( 'Background Size', 'darkify' ),
							'cover'   => esc_html__( 'Cover', 'darkify' ),
							'contain' => esc_html__( 'Contain', 'darkify' ),
							'auto'    => esc_html__( 'Auto', 'darkify' ),
						),
					),
					$this->value['background-size'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Origin
			if ( ! empty( $args['background_origin'] ) ) {

				DRK_LITE::field(
					array(
						'id'      => 'background-origin',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Origin', 'darkify' ),
							'padding-box' => esc_html__( 'Padding Box', 'darkify' ),
							'border-box'  => esc_html__( 'Border Box', 'darkify' ),
							'content-box' => esc_html__( 'Content Box', 'darkify' ),
						),
					),
					$this->value['background-origin'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Clip
			if ( ! empty( $args['background_clip'] ) ) {

				DRK_LITE::field(
					array(
						'id'      => 'background-clip',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Clip', 'darkify' ),
							'border-box'  => esc_html__( 'Border Box', 'darkify' ),
							'padding-box' => esc_html__( 'Padding Box', 'darkify' ),
							'content-box' => esc_html__( 'Content Box', 'darkify' ),
						),
					),
					$this->value['background-clip'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Blend Mode
			if ( ! empty( $args['background_blend_mode'] ) ) {

				DRK_LITE::field(
					array(
						'id'      => 'background-blend-mode',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Blend Mode', 'darkify' ),
							'normal'      => esc_html__( 'Normal', 'darkify' ),
							'multiply'    => esc_html__( 'Multiply', 'darkify' ),
							'screen'      => esc_html__( 'Screen', 'darkify' ),
							'overlay'     => esc_html__( 'Overlay', 'darkify' ),
							'darken'      => esc_html__( 'Darken', 'darkify' ),
							'lighten'     => esc_html__( 'Lighten', 'darkify' ),
							'color-dodge' => esc_html__( 'Color Dodge', 'darkify' ),
							'saturation'  => esc_html__( 'Saturation', 'darkify' ),
							'color'       => esc_html__( 'Color', 'darkify' ),
							'luminosity'  => esc_html__( 'Luminosity', 'darkify' ),
						),
					),
					$this->value['background-blend-mode'],
					$this->field_name(),
					'field/background'
				);

			}

			echo '</div>';

			echo wp_kses_post( $this->field_after() );
		}

		public function output() {

			$output    = '';
			$bg_image  = array();
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

			// Background image and gradient
			$background_color        = ( ! empty( $this->value['background-color'] ) ) ? $this->value['background-color'] : '';
			$background_gd_color     = ( ! empty( $this->value['background-gradient-color'] ) ) ? $this->value['background-gradient-color'] : '';
			$background_gd_direction = ( ! empty( $this->value['background-gradient-direction'] ) ) ? $this->value['background-gradient-direction'] : '';
			$background_image        = ( ! empty( $this->value['background-image']['url'] ) ) ? $this->value['background-image']['url'] : '';

			if ( $background_color && $background_gd_color ) {
				$gd_direction = ( $background_gd_direction ) ? $background_gd_direction . ',' : '';
				$bg_image[]   = 'linear-gradient(' . $gd_direction . $background_color . ',' . $background_gd_color . ')';
				unset( $this->value['background-color'] );
			}

			if ( $background_image ) {
				$bg_image[] = 'url(' . $background_image . ')';
			}

			if ( ! empty( $bg_image ) ) {
				$output .= 'background-image:' . implode( ',', $bg_image ) . $important . ';';
			}

			// Common background properties
			$properties = array( 'color', 'position', 'repeat', 'attachment', 'size', 'origin', 'clip', 'blend-mode' );

			foreach ( $properties as $property ) {
				$property = 'background-' . $property;
				if ( ! empty( $this->value[ $property ] ) ) {
					$output .= $property . ':' . $this->value[ $property ] . $important . ';';
				}
			}

			if ( $output ) {
				$output = $element . '{' . $output . '}';
			}

			$this->parent->output_css .= $output;

			return $output;
		}
	}
}
