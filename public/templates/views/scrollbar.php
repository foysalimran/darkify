<?php
if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.
?>

<style type="text/css" class="darkify_inline_css">
    .darkify_dark_mode_enabled::-webkit-scrollbar-button {
        background-color: transparent !important;
        background-repeat: no-repeat !important;
        background-size: contain !important;
        background-position: center !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button:start {
        background-image: url(<?php echo esc_url(DRK_LITE_DIR_URL . "assets/img/others/scroll_arrow_up.svg"); ?>) !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button:end {
        background-image: url(<?php echo esc_url(DRK_LITE_DIR_URL . "assets/img/others/scroll_arrow_down.svg"); ?>) !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button:start:horizontal {
        background-image: url(<?php echo esc_url(DRK_LITE_DIR_URL . "assets/img/others/scroll_arrow_left.svg"); ?>) !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button:end:horizontal {
        background-image: url(<?php echo esc_url(DRK_LITE_DIR_URL . "assets/img/others/scroll_arrow_right.svg"); ?>) !important;
    }
</style>