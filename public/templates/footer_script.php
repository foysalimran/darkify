<?php
if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.
$options = get_option('darkify');
$hide_on_desktop = $options["hide_on_desktop"];
$hide_on_mobile = $options["hide_on_mobile"];
$hide_dark_mode_on_mobile = isset($hide_on_mobile["hide_dark_mode_on_mobile"]) ? $hide_on_mobile["hide_dark_mode_on_mobile"] : 0;
$type_of_hide_by = isset($hide_on_mobile["type_of_hide_by"]) ? $hide_on_mobile["type_of_hide_by"] : 0;
?>
<?php if (!is_admin()) { ?>
    <?php if ($options["enable_dark_mode_switch"]) { ?>
        <?php if (!$this->utils->is_hidden_by_user_agent($hide_on_desktop, $hide_dark_mode_on_mobile, $type_of_hide_by)) { ?>
            <?php include DRK_LITE_PATH . "public/templates/views/switch.php"; ?>
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php if (is_admin()) { ?>
    <?php /* Check if block editor is on, then add the dark mode button there */ ?>
    <?php if ($options["enable_admin_panel_dark_mode"]) { 
        if (class_exists('WP_Block_Type_Registry')) {
        $current_screen = get_current_screen();
        if ($current_screen && 'post' === $current_screen->base && ('post' === $current_screen->post_type || 'page' === $current_screen->post_type)) {
            // Enqueue the script
            wp_enqueue_script( 'darkify-editor-script', plugin_dir_url( __FILE__ ) . 'darkify-editor-script.js', array( 'wp-dom-ready', 'wp-edit-post' ), null, true );
        }
    }
    } ?>
<?php } ?>