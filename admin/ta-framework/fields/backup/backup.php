<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'DRK_Field_backup' ) ) {
  class DRK_Field_backup extends DRK_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'drk_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'drk-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo wp_kses_post($this->field_before());

      echo '<textarea name="drk_import_data" class="drk-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary drk-confirm drk-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'darkify' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="drk-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary drk-export" target="_blank">'. esc_html__( 'Export & Download', 'darkify' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="drk_transient[reset]" value="reset" class="button drk-warning-primary drk-confirm drk-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'darkify' ) .'</button>';

      echo wp_kses_post($this->field_after());

    }

  }
}
