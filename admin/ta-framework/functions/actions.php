<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'drk_lite_get_icons' ) ) {
	function drk_lite_get_icons() {

		$nonce = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'drk_lite_icon_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Invalid nonce verification.', 'darkify' ) ) );
		}

		ob_start();

		$icon_library = ( apply_filters( 'drk_lite_fa4', false ) ) ? 'fa4' : 'fa5';

		DRK_LITE::include_plugin_file( 'fields/icon/' . $icon_library . '-icons.php' );

		$icon_lists = apply_filters( 'drk_lite_field_icon_add_icons', drk_lite_get_default_icons() );

		if ( ! empty( $icon_lists ) ) {

			foreach ( $icon_lists as $list ) {

				echo ( count( $icon_lists ) >= 2 ) ? '<div class="drk_lite-icon-title">' . esc_attr( $list['title'] ) . '</div>' : '';

				foreach ( $list['icons'] as $icon ) {
					echo '<i title="' . esc_attr( $icon ) . '" class="' . esc_attr( $icon ) . '"></i>';
				}
			}
		} else {

				echo '<div class="drk_lite-error-text">' . esc_html__( 'No data available.', 'darkify' ) . '</div>';

		}

		$content = ob_get_clean();

		wp_send_json_success( array( 'content' => $content ) );
	}
	add_action( 'wp_ajax_drk_lite-get-icons', 'drk_lite_get_icons' );
}

/**
 *
 * Export
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'drk_lite_export' ) ) {
	function drk_lite_export() {

		$nonce  = ( ! empty( $_GET['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';
		$unique = ( ! empty( $_GET['unique'] ) ) ? sanitize_text_field( wp_unslash( $_GET['unique'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'drk_lite_backup_nonce' ) ) {
			die( esc_html__( 'Error: Invalid nonce verification.', 'darkify' ) );
		}

		if ( empty( $unique ) ) {
			die( esc_html__( 'Error: Invalid key.', 'darkify' ) );
		}

		// Export
		header( 'Content-Type: application/json' );
		header( 'Content-disposition: attachment; filename=backup-' . gmdate( 'd-m-Y' ) . '.json' );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );

		echo esc_html(wp_json_encode( get_option( $unique ) ));

		die();
	}
	add_action( 'wp_ajax_drk_lite-export', 'drk_lite_export' );
}

/**
 *
 * Import Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'drk_lite_import_ajax' ) ) {
	function drk_lite_import_ajax() {
		if(!current_user_can('manage_options')){
			return;
		}
		if(isset($_POST['_ajax_nonce']) && !wp_verify_nonce($_POST['_ajax_nonce'], 'save_options')){
			return wp_send_json(['error' => 'Nonce is invalid']);
		}

		$nonce  = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		$unique = ( ! empty( $_POST['unique'] ) ) ? sanitize_text_field( wp_unslash( $_POST['unique'] ) ) : '';
		$data   = ( ! empty( $_POST['data'] ) ) ? wp_kses_post_deep( json_decode( wp_unslash( trim( wp_kses_post($_POST['data']) ) ), true ) ) : wp_kses_post_deep(array());

		if ( ! wp_verify_nonce( $nonce, 'drk_lite_backup_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Invalid nonce verification.', 'darkify' ) ) );
		}

		if ( empty( $unique ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Invalid key.', 'darkify' ) ) );
		}

		if ( empty( $data ) || ! is_array( $data ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: The response is not a valid JSON response.', 'darkify' ) ) );
		}

		// Success
		update_option( $unique, $data );

		wp_send_json_success();
	}
	add_action( 'wp_ajax_drk_lite-import', 'drk_lite_import_ajax' );
}

/**
 *
 * Reset Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'drk_lite_reset_ajax' ) ) {
	function drk_lite_reset_ajax() {

		$nonce  = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		$unique = ( ! empty( $_POST['unique'] ) ) ? sanitize_text_field( wp_unslash( $_POST['unique'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'drk_lite_backup_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Invalid nonce verification.', 'darkify' ) ) );
		}

		// Success
		delete_option( $unique );

		wp_send_json_success();
	}
	add_action( 'wp_ajax_drk_lite-reset', 'drk_lite_reset_ajax' );
}

/**
 *
 * Chosen Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'drk_lite_chosen_ajax' ) ) {
	function drk_lite_chosen_ajax() {

		if(!current_user_can('manage_options')){
			return;
		}

		if(isset($_POST['_ajax_nonce']) && !wp_verify_nonce($_POST['_ajax_nonce'], 'save_options')){
			return wp_send_json(['error' => 'Nonce is invalid']);
		}

		$nonce = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		$type  = ( ! empty( $_POST['type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '';
		$term  = ( ! empty( $_POST['term'] ) ) ? sanitize_text_field( wp_unslash( $_POST['term'] ) ) : '';
		$query = ( ! empty( $_POST['query_args'] ) ) ? wp_kses_post_deep( $_POST['query_args'] ) : wp_kses_post_deep(array());

		if ( ! wp_verify_nonce( $nonce, 'drk_lite_chosen_ajax_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Invalid nonce verification.', 'darkify' ) ) );
		}

		if ( empty( $type ) || empty( $term ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Invalid term ID.', 'darkify' ) ) );
		}

		$capability = apply_filters( 'drk_lite_chosen_ajax_capability', 'manage_options' );

		if ( ! current_user_can( $capability ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: You do not have permission to do that.', 'darkify' ) ) );
		}

		// Success
		$options = DRK_LITE_Fields::field_data( $type, $term, $query );

		wp_send_json_success( $options );
	}
	add_action( 'wp_ajax_drk_lite-chosen', 'drk_lite_chosen_ajax' );
}
