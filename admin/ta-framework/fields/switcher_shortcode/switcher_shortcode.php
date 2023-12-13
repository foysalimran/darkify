<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.
/**
 *
 * Field: switcher_shortcode
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!class_exists('DRK_Field_switcher_shortcode')) {
  class DRK_Field_switcher_shortcode extends DRK_Fields
  {

    public function __construct($field, $value = '', $unique = '', $where = '', $parent = '')
    {
      parent::__construct($field, $value, $unique, $where, $parent);
    }

    public function render()
    {

      echo $this->field_before();

?>
      <textarea type='text' id='switcher_shortcode' class='switcher_shortcode_input' id='switcher_shortcode_after_copy' onClick='this.select();' readonly='readonly'>[darkify switch="1" width_height="60px" border_radius="7px" icon_size="40px" light_mode_bg="#121116" dark_mode_bg="#ffffff" light_mode_color="#ffffff" dark_mode_color="#121116"]</textarea>

      <button id="switcher_shortcode_copy" class="button button-primary"><?php echo esc_html('Copy Shortcode', 'darkify') ?></button>

      <div class='switcher_shortcode_after_copy'><i class='fa fa-check-circle'></i><?php echo esc_html('Shortcode Copied to Clipboard!', 'darkify') ?></div>
<?php


      echo (!empty($this->field['label'])) ? '<span class="drk--label">' . esc_attr($this->field['label']) . '</span>' : '';

      echo $this->field_after();
    }
  }
}
