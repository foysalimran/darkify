<style type="text/css" class="darkify_inline_css">
    .darkify_dark_mode_enabled::-webkit-scrollbar {
        background: <?php echo esc_attr(isset($options["dark_mode_scrollbar_track_bg"]) ? $options["dark_mode_scrollbar_track_bg"] : "#29292a"); ?> !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-track {
        background: <?php echo esc_attr(isset($options["dark_mode_scrollbar_track_bg"]) ? $options["dark_mode_scrollbar_track_bg"] : "##29292a"); ?> !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-thumb {
        background-color: <?php echo esc_attr(isset($options["dark_mode_scrollbar_thumb_bg"]) ? $options["dark_mode_scrollbar_thumb_bg"] : "#52565a"); ?> !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-corner {
        background-color: <?php echo esc_attr(isset($options["dark_mode_scrollbar_thumb_bg"]) ? $options["dark_mode_scrollbar_thumb_bg"] : "#52565a"); ?> !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button {
        background-color: transparent !important;
        background-repeat: no-repeat !important;
        background-size: contain !important;
        background-position: center !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button:start {
        background-image: url(<?php echo esc_url(DRK_PLUGIN_DIR_URL . "assets/img/others/scroll_arrow_up.svg"); ?>) !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button:end {
        background-image: url(<?php echo esc_url(DRK_PLUGIN_DIR_URL . "assets/img/others/scroll_arrow_down.svg"); ?>) !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button:start:horizontal {
        background-image: url(<?php echo esc_url(DRK_PLUGIN_DIR_URL . "assets/img/others/scroll_arrow_left.svg"); ?>) !important;
    }
    .darkify_dark_mode_enabled::-webkit-scrollbar-button:end:horizontal {
        background-image: url(<?php echo esc_url(DRK_PLUGIN_DIR_URL . "assets/img/others/scroll_arrow_right.svg"); ?>) !important;
    }
</style>