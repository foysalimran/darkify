<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'DRK_LITE_Field_icon' ) ) {
	class DRK_LITE_Field_icon extends DRK_LITE_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'button_title' => esc_html__( 'Add Icon', 'darkify' ),
					'remove_title' => esc_html__( 'Remove Icon', 'darkify' ),
				)
			);

			echo wp_kses_post( $this->field_before() );

			$nonce  = wp_create_nonce( 'drk_lite_icon_nonce' );
			$hidden = ( empty( $this->value ) ) ? ' hidden' : '';

			echo '<div class="drk_lite-icon-select">';
			echo '<span class="drk_lite-icon-preview' . esc_attr( $hidden ) . '"><i class="' . esc_attr( $this->value ) . '"></i></span>';
			echo '<a href="#" class="button button-primary drk_lite-icon-add" data-nonce="' . esc_attr( $nonce ) . '">' . esc_html( $args['button_title'] ) . '</a>';
			echo '<a href="#" class="button drk_lite-warning-primary drk_lite-icon-remove' . esc_attr( $hidden ) . '">' . esc_html( $args['remove_title'] ) . '</a>';
			echo '<input type="hidden" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '" class="drk_lite-icon-value"' . wp_kses_post( $this->field_attributes() ) . ' />';
			echo '</div>';

			echo wp_kses_post( $this->field_after() );
		}

		public function enqueue() {
			add_action( 'admin_footer', array( 'DRK_LITE_Field_icon', 'add_footer_modal_icon' ) );
			add_action( 'customize_controls_print_footer_scripts', array( 'DRK_LITE_Field_icon', 'add_footer_modal_icon' ) );
		}

		public static function add_footer_modal_icon() {
			?>
		<div id="drk_lite-modal-icon" class="drk_lite-modal drk_lite-modal-icon hidden">
		<div class="drk_lite-modal-table">
			<div class="drk_lite-modal-table-cell">
			<div class="drk_lite-modal-overlay"></div>
			<div class="drk_lite-modal-inner">
				<div class="drk_lite-modal-title">
				<?php esc_html_e( 'Add Icon', 'darkify' ); ?>
				<div class="drk_lite-modal-close drk_lite-icon-close"></div>
				</div>
				<div class="drk_lite-modal-header">
				<input type="text" placeholder="<?php esc_html_e( 'Search...', 'darkify' ); ?>" class="drk_lite-icon-search" />
				</div>
				<div class="drk_lite-modal-content">
				<div class="drk_lite-modal-loading"><div class="drk_lite-loading"></div></div>
				<div class="drk_lite-modal-load"></div>
				</div>
			</div>
			</div>
		</div>
		</div>
			<?php
		}
	}
}
