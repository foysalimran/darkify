<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: link
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'DRK_LITE_Field_link' ) ) {
	class DRK_LITE_Field_link extends DRK_LITE_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'add_title'    => esc_html__( 'Add Link', 'darkify' ),
					'edit_title'   => esc_html__( 'Edit Link', 'darkify' ),
					'remove_title' => esc_html__( 'Remove Link', 'darkify' ),
				)
			);

			$default_values = array(
				'url'    => '',
				'text'   => '',
				'target' => '',
			);

			$value = wp_parse_args( $this->value, $default_values );

			$hidden = ( ! empty( $value['url'] ) || ! empty( $value['url'] ) || ! empty( $value['url'] ) ) ? ' hidden' : '';

			$maybe_hidden = ( empty( $hidden ) ) ? ' hidden' : '';

			echo wp_kses_post( $this->field_before() );

			echo '<textarea readonly="readonly" class="drk_lite--link hidden"></textarea>';

			echo '<div class="' . esc_attr( $maybe_hidden ) . '"><div class="drk_lite--result">' . sprintf( '{url:"%s", text:"%s", target:"%s"}', esc_url($value['url']), esc_html($value['text']), esc_attr($value['target']) ) . '</div></div>';

			echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[url]' ) ) . '" value="' . esc_attr( $value['url'] ) . '"' . wp_kses_post($this->field_attributes( array( 'class' => 'drk_lite--url' ) )) . ' />';
			echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[text]' ) ) . '" value="' . esc_attr( $value['text'] ) . '" class="drk_lite--text" />';
			echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[target]' ) ) . '" value="' . esc_attr( $value['target'] ) . '" class="drk_lite--target" />';

			echo '<a href="#" class="button button-primary drk_lite--add' . esc_attr( $hidden ) . '">' . esc_html($args['add_title']) . '</a> ';
			echo '<a href="#" class="button drk_lite--edit' . esc_attr( $maybe_hidden ) . '">' . esc_html($args['edit_title']) . '</a> ';
			echo '<a href="#" class="button drk_lite-warning-primary drk_lite--remove' . esc_attr( $maybe_hidden ) . '">' . esc_html( $args['remove_title'] ) . '</a>';

			echo wp_kses_post( $this->field_after() );
		}

		public function enqueue() {

			if ( ! wp_script_is( 'wplink' ) ) {
				wp_enqueue_script( 'wplink' );
			}

			if ( ! wp_script_is( 'jquery-ui-autocomplete' ) ) {
				wp_enqueue_script( 'jquery-ui-autocomplete' );
			}

			add_action( 'admin_print_footer_scripts', array( $this, 'add_wp_link_dialog' ) );
		}

		public function add_wp_link_dialog() {

			if ( ! class_exists( '_WP_Editors' ) ) {
				require_once ABSPATH . WPINC . '/class-wp-editor.php';
			}

			wp_print_styles( 'editor-buttons' );

			_WP_Editors::wp_link_dialog();
		}
	}
}
