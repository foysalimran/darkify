<?php ob_start();
$options            = get_option('darkify');
$allowed_elements   = isset($options["allowed_elements"]) ? $options["allowed_elements"] : "";
$disallowed_elements                    = isset($options["disallowed_elements"]) ? $options["disallowed_elements"] : "";
$disallowed_elements_force_to_correct   = isset($options["disallowed_elements_force_to_correct"]) ? $options["disallowed_elements_force_to_correct"] : "";
$enable_default_dark_mode               = $options['enable_default_dark_mode'];
$enable_time                            = isset($options['enable_time']) ? $options['enable_time'] : "";
$enable_time_based_dark                 = isset($enable_time['enable_time_based_dark']) ? $enable_time['enable_time_based_dark'] : "";
$time_based_dark_start                  = isset($enable_time['time_based_dark_start']['from']) ? $enable_time['time_based_dark_start']['from'] : "";
$time_based_dark_stop                   =  isset($enable_time['time_based_dark_start']['to'])  ?  $enable_time['time_based_dark_start']['to'] : "";
$grayscale                              =  isset($options['brightness']) ? $options['brightness'] : "";
$enable_low_image_brightness            =  isset($grayscale['enable_low_image_brightness']) ? $grayscale['enable_low_image_brightness'] : "";
$low_image_brightness_label             =  isset($grayscale['low_image_brightness_label']) ? $grayscale['low_image_brightness_label'] : "";
$disallowed_low_brightness_images       =  isset($grayscale['disallowed_low_brightness_images']) ? $grayscale['disallowed_low_brightness_images'] : "[]";
$grayscale                              =  isset($options['grayscale']) ? $options['grayscale'] : "";
$enable_image_grayscale                 =  isset($grayscale['enable_image_grayscale']) ? $grayscale['enable_image_grayscale'] : "";
$image_grayscale_label                  =  isset($grayscale['image_grayscale_label']) ? $grayscale['image_grayscale_label'] : "";
$disallowed_low_grayscale_images        =  isset($grayscale['disallowed_low_grayscale_images']) ? $grayscale['disallowed_low_grayscale_images'] : "";
$darken_background              =  isset($options['darken_background']) ? $options['darken_background'] : "";
$enable_low_image_darken        =  isset($darken_background['enable_low_image_darken']) ? $darken_background['enable_low_image_darken'] : "";
$low_image_darken_label         =  isset($darken_background['low_image_darken_label']) ? $darken_background['low_image_darken_label'] : "";
$video_brightness               =  isset($options['video_brightness']) ? $options['video_brightness'] : "";
$enable_low_video_brightness    =  isset($video_brightness['enable_low_video_brightness']) ? $video_brightness['enable_low_video_brightness'] : "";
$low_video_brightness_label     =  isset($video_brightness['low_video_brightness_label']) ? $enable_video_brightness['low_video_brightness_label'] : "";
$video_grayscale                =  isset($options['video_grayscale']);
$enable_video_grayscale         =  isset($video_grayscale['enable_video_grayscale']) ? $video_grayscale['enable_video_grayscale'] : "";
$video_grayscale_label          =  isset($video_grayscale['video_grayscale_label']) ? $video_grayscale['video_grayscale_label']  : "";
$invert                         =  isset($options['invert']) ? $options['invert'] : "";
$enable_invert_images           =  isset($invert['enable_invert_images']) ? $invert['enable_invert_images'] : "";
$invert_images_allowed_urls     =  isset($invert['invert_images_allowed_urls']) ? $invert['invert_images_allowed_urls'] : "[]";
if ($invert_images_allowed_urls !== "") {
    $invert_images_allowed_urls_explode = explode(',', $invert_images_allowed_urls);
    $invert_images_allowed_urls_arr  =  json_encode($invert_images_allowed_urls_explode);
}

?>

<?php if (!is_admin()) { ?>
    <style type="text/css" class="darkify_inline_css">
        :root {
            <?php if ($options["color_pallets"] == 'set1') : ?>--darkify_dark_mode_bg: <?php echo esc_attr($options["dark_mode_color_set1"]['background']); ?>;
            --darkify_dark_mode_secondary_bg: <?php echo esc_attr($options["dark_mode_color_set1"]['secondary_background']); ?>;
            --darkify_dark_mode_text_color: <?php echo esc_attr($options["dark_mode_link_color_set1"]['text']); ?>;
            --darkify_dark_mode_link_color: <?php echo esc_attr($options["dark_mode_link_color_set1"]['color']); ?>;
            --darkify_dark_mode_link_hover_color: <?php echo esc_attr($options["dark_mode_link_color_set1"]['hover']); ?>;
            --darkify_dark_mode_input_bg: <?php echo esc_attr($options["dark_mode_input_color_set1"]['background']); ?>;
            --darkify_dark_mode_input_text_color: <?php echo esc_attr($options["dark_mode_input_color_set1"]['color']); ?>;
            --darkify_dark_mode_input_placeholder_color: <?php echo esc_attr($options["dark_mode_input_color_set1"]['placeholder']); ?>;
            --darkify_dark_mode_border_color: <?php echo esc_attr($options["dark_mode_border_color_set1"]); ?>;
            --darkify_dark_mode_btn_text_color: <?php echo esc_attr($options["dark_mode_btn_color_set1"]['color']); ?>;
            --darkify_dark_mode_btn_bg: <?php echo esc_attr($options["dark_mode_btn_color_set1"]['background']); ?>;
            <?php elseif ($options["color_pallets"] == 'set2') : ?>--darkify_dark_mode_bg: <?php echo esc_attr($options["dark_mode_color_set2"]['background']); ?>;
            --darkify_dark_mode_secondary_bg: <?php echo esc_attr($options["dark_mode_color_set2"]['secondary_background']); ?>;
            --darkify_dark_mode_text_color: <?php echo esc_attr($options["dark_mode_link_color_set2"]['text']); ?>;
            --darkify_dark_mode_link_color: <?php echo esc_attr($options["dark_mode_link_color_set2"]['color']); ?>;
            --darkify_dark_mode_link_hover_color: <?php echo esc_attr($options["dark_mode_link_color_set2"]['hover']); ?>;
            --darkify_dark_mode_input_bg: <?php echo esc_attr($options["dark_mode_input_color_set2"]['background']); ?>;
            --darkify_dark_mode_input_text_color: <?php echo esc_attr($options["dark_mode_input_color_set2"]['color']); ?>;
            --darkify_dark_mode_input_placeholder_color: <?php echo esc_attr($options["dark_mode_input_color_set2"]['placeholder']); ?>;
            --darkify_dark_mode_border_color: <?php echo esc_attr($options["dark_mode_border_color_set2"]); ?>;
            --darkify_dark_mode_btn_text_color: <?php echo esc_attr($options["dark_mode_btn_color_set2"]['color']); ?>;
            --darkify_dark_mode_btn_bg: <?php echo esc_attr($options["dark_mode_btn_color_set2"]['background']); ?>;
            <?php elseif ($options["color_pallets"] == 'set4') : ?>--darkify_dark_mode_bg: <?php echo esc_attr($options["dark_mode_color_set4"]['background']); ?>;
            --darkify_dark_mode_secondary_bg: <?php echo esc_attr($options["dark_mode_color_set4"]['secondary_background']); ?>;
            --darkify_dark_mode_text_color: <?php echo esc_attr($options["dark_mode_link_color_set4"]['text']); ?>;
            --darkify_dark_mode_link_color: <?php echo esc_attr($options["dark_mode_link_color_set4"]['color']); ?>;
            --darkify_dark_mode_link_hover_color: <?php echo esc_attr($options["dark_mode_link_color_set4"]['hover']); ?>;
            --darkify_dark_mode_input_bg: <?php echo esc_attr($options["dark_mode_input_color_set4"]['background']); ?>;
            --darkify_dark_mode_input_text_color: <?php echo esc_attr($options["dark_mode_input_color_set4"]['color']); ?>;
            --darkify_dark_mode_input_placeholder_color: <?php echo esc_attr($options["dark_mode_input_color_set4"]['placeholder']); ?>;
            --darkify_dark_mode_border_color: <?php echo esc_attr($options["dark_mode_border_color_set4"]); ?>;
            --darkify_dark_mode_btn_text_color: <?php echo esc_attr($options["dark_mode_btn_color_set4"]['color']); ?>;
            --darkify_dark_mode_btn_bg: <?php echo esc_attr($options["dark_mode_btn_color_set4"]['background']); ?>;
            <?php elseif ($options["color_pallets"] == 'set5') : ?>--darkify_dark_mode_bg: <?php echo esc_attr($options["dark_mode_color_set5"]['background']); ?>;
            --darkify_dark_mode_secondary_bg: <?php echo esc_attr($options["dark_mode_color_set5"]['secondary_background']); ?>;
            --darkify_dark_mode_text_color: <?php echo esc_attr($options["dark_mode_link_color_set5"]['text']); ?>;
            --darkify_dark_mode_link_color: <?php echo esc_attr($options["dark_mode_link_color_set5"]['color']); ?>;
            --darkify_dark_mode_link_hover_color: <?php echo esc_attr($options["dark_mode_link_color_set5"]['hover']); ?>;
            --darkify_dark_mode_input_bg: <?php echo esc_attr($options["dark_mode_input_color_set5"]['background']); ?>;
            --darkify_dark_mode_input_text_color: <?php echo esc_attr($options["dark_mode_input_color_set5"]['color']); ?>;
            --darkify_dark_mode_input_placeholder_color: <?php echo esc_attr($options["dark_mode_input_color_set5"]['placeholder']); ?>;
            --darkify_dark_mode_border_color: <?php echo esc_attr($options["dark_mode_border_color_set5"]); ?>;
            --darkify_dark_mode_btn_text_color: <?php echo esc_attr($options["dark_mode_btn_color_set5"]['color']); ?>;
            --darkify_dark_mode_btn_bg: <?php echo esc_attr($options["dark_mode_btn_color_set5"]['background']); ?>;
            <?php elseif ($options["color_pallets"] == 'set6') : ?>--darkify_dark_mode_bg: <?php echo esc_attr($options["dark_mode_color_set6"]['background']); ?>;
            --darkify_dark_mode_secondary_bg: <?php echo esc_attr($options["dark_mode_color_set6"]['secondary_background']); ?>;
            --darkify_dark_mode_text_color: <?php echo esc_attr($options["dark_mode_link_color_set6"]['text']); ?>;
            --darkify_dark_mode_link_color: <?php echo esc_attr($options["dark_mode_link_color_set6"]['color']); ?>;
            --darkify_dark_mode_link_hover_color: <?php echo esc_attr($options["dark_mode_link_color_set6"]['hover']); ?>;
            --darkify_dark_mode_input_bg: <?php echo esc_attr($options["dark_mode_input_color_set6"]['background']); ?>;
            --darkify_dark_mode_input_text_color: <?php echo esc_attr($options["dark_mode_input_color_set6"]['color']); ?>;
            --darkify_dark_mode_input_placeholder_color: <?php echo esc_attr($options["dark_mode_input_color_set6"]['placeholder']); ?>;
            --darkify_dark_mode_border_color: <?php echo esc_attr($options["dark_mode_border_color_set6"]); ?>;
            --darkify_dark_mode_btn_text_color: <?php echo esc_attr($options["dark_mode_btn_color_set6"]['color']); ?>;
            --darkify_dark_mode_btn_bg: <?php echo esc_attr($options["dark_mode_btn_color_set6"]['background']); ?>;
            <?php elseif ($options["color_pallets"] == 'set9') : ?>--darkify_dark_mode_bg: <?php echo esc_attr($options["dark_mode_color_set9"]['background']); ?>;
            --darkify_dark_mode_secondary_bg: <?php echo esc_attr($options["dark_mode_color_set9"]['secondary_background']); ?>;
            --darkify_dark_mode_text_color: <?php echo esc_attr($options["dark_mode_link_color_set9"]['text']); ?>;
            --darkify_dark_mode_link_color: <?php echo esc_attr($options["dark_mode_link_color_set9"]['color']); ?>;
            --darkify_dark_mode_link_hover_color: <?php echo esc_attr($options["dark_mode_link_color_set9"]['hover']); ?>;
            --darkify_dark_mode_input_bg: <?php echo esc_attr($options["dark_mode_input_color_set9"]['background']); ?>;
            --darkify_dark_mode_input_text_color: <?php echo esc_attr($options["dark_mode_input_color_set9"]['color']); ?>;
            --darkify_dark_mode_input_placeholder_color: <?php echo esc_attr($options["dark_mode_input_color_set9"]['placeholder']); ?>;
            --darkify_dark_mode_border_color: <?php echo esc_attr($options["dark_mode_border_color_set9"]); ?>;
            --darkify_dark_mode_btn_text_color: <?php echo esc_attr($options["dark_mode_btn_color_set9"]['color']); ?>;
            --darkify_dark_mode_btn_bg: <?php echo esc_attr($options["dark_mode_btn_color_set9"]['background']); ?>;
            <?php elseif ($options["color_pallets"] == 'set10') : ?>--darkify_dark_mode_bg: <?php echo esc_attr($options["dark_mode_color_set10"]['background']); ?>;
            --darkify_dark_mode_secondary_bg: <?php echo esc_attr($options["dark_mode_color_set10"]['secondary_background']); ?>;
            --darkify_dark_mode_text_color: <?php echo esc_attr($options["dark_mode_link_color_set10"]['text']); ?>;
            --darkify_dark_mode_link_color: <?php echo esc_attr($options["dark_mode_link_color_set10"]['color']); ?>;
            --darkify_dark_mode_link_hover_color: <?php echo esc_attr($options["dark_mode_link_color_set10"]['hover']); ?>;
            --darkify_dark_mode_input_bg: <?php echo esc_attr($options["dark_mode_input_color_set10"]['background']); ?>;
            --darkify_dark_mode_input_text_color: <?php echo esc_attr($options["dark_mode_input_color_set10"]['color']); ?>;
            --darkify_dark_mode_input_placeholder_color: <?php echo esc_attr($options["dark_mode_input_color_set10"]['placeholder']); ?>;
            --darkify_dark_mode_border_color: <?php echo esc_attr($options["dark_mode_border_color_set10"]); ?>;
            --darkify_dark_mode_btn_text_color: <?php echo esc_attr($options["dark_mode_btn_color_set10"]['color']); ?>;
            --darkify_dark_mode_btn_bg: <?php echo esc_attr($options["dark_mode_btn_color_set10"]['background']); ?>;
            <?php elseif ($options["color_pallets"] == 'set11') : ?>--darkify_dark_mode_bg: <?php echo esc_attr($options["dark_mode_color_set11"]['background']); ?>;
            --darkify_dark_mode_secondary_bg: <?php echo esc_attr($options["dark_mode_color_set11"]['secondary_background']); ?>;
            --darkify_dark_mode_text_color: <?php echo esc_attr($options["dark_mode_link_color_set11"]['text']); ?>;
            --darkify_dark_mode_link_color: <?php echo esc_attr($options["dark_mode_link_color_set11"]['color']); ?>;
            --darkify_dark_mode_link_hover_color: <?php echo esc_attr($options["dark_mode_link_color_set11"]['hover']); ?>;
            --darkify_dark_mode_input_bg: <?php echo esc_attr($options["dark_mode_input_color_set11"]['background']); ?>;
            --darkify_dark_mode_input_text_color: <?php echo esc_attr($options["dark_mode_input_color_set11"]['color']); ?>;
            --darkify_dark_mode_input_placeholder_color: <?php echo esc_attr($options["dark_mode_input_color_set11"]['placeholder']); ?>;
            --darkify_dark_mode_border_color: <?php echo esc_attr($options["dark_mode_border_color_set11"]); ?>;
            --darkify_dark_mode_btn_text_color: <?php echo esc_attr($options["dark_mode_btn_color_set11"]['color']); ?>;
            --darkify_dark_mode_btn_bg: <?php echo esc_attr($options["dark_mode_btn_color_set11"]['background']); ?>;
            <?php endif; ?>
        }
    </style>
<?php } else { ?>
    <style type="text/css" class="darkify_inline_css">
        :root {
            --darkify_dark_mode_bg: #181a1b;
            --darkify_dark_mode_secondary_bg: #202324;
            --darkify_dark_mode_text_color: #c8c4bd;
            --darkify_dark_mode_link_color: #6aafe2;
            --darkify_dark_mode_link_hover_color: #4f94c3;
            --darkify_dark_mode_input_bg: #2D2D2D;
            --darkify_dark_mode_input_text_color: #BEBEBE;
            --darkify_dark_mode_input_placeholder_color: #989898;
            --darkify_dark_mode_border_color: #4A4A4A;
            --darkify_dark_mode_btn_bg: #2D2D2D;
            --darkify_dark_mode_btn_text_color: #BEBEBE;
        }
    </style>
<?php } ?>

<?php if ($options["enable_scrollbar_dark"]) { ?>
    <?php include DRK_PATH . "public/templates/views/scrollbar.php"; ?>
<?php } ?>

<script type="text/javascript" class="darkify_inline_js">
    var darkify_switch_unique_id = "<?php echo esc_attr($this->unique_id); ?>";
    var darkify_is_this_admin_panel = "<?php echo esc_attr(is_admin() ? "1" : "0"); ?>";
    var darkify_enable_default_dark_mode = "<?php echo esc_attr($enable_default_dark_mode); ?>";
    var darkify_enable_os_aware = "<?php echo esc_attr($options["enable_os_aware"]); ?>";
    var darkify_enable_keyboard_shortcut = "<?php echo esc_attr($options["enable_keyboard_shortcut"]); ?>";
    var darkify_enable_time_based_dark = "<?php echo esc_attr($enable_time_based_dark); ?>";
    var darkify_time_based_dark_start = "<?php echo esc_attr($time_based_dark_start ? $time_based_dark_start : "19:00"); ?>";
    var darkify_time_based_dark_stop = "<?php echo esc_attr($time_based_dark_stop ? $time_based_dark_stop : "07:00"); ?>";

    var darkify_alternative_dark_mode_switch = "<?php echo esc_attr($options["alternative_dark_mode_switcher"]); ?>";
    var darkify_enable_low_image_brightness = "<?php echo esc_attr($enable_low_image_brightness); ?>";
    var darkify_image_brightness_to = "<?php echo esc_attr($low_image_brightness_label); ?>";
    var darkify_disallowed_low_brightness_images = "<?php echo esc_attr($disallowed_low_brightness_images); ?>";
    var darkify_enable_image_grayscale = "<?php echo esc_attr($enable_image_grayscale); ?>";
    var darkify_image_grayscale_to = "<?php echo esc_attr($image_grayscale_label); ?>";
    var darkify_disallowed_grayscale_images = "<?php echo esc_attr($disallowed_low_grayscale_images); ?>";
    var darkify_enable_bg_image_darken = "<?php echo esc_attr($enable_low_image_darken); ?>";
    var darkify_bg_image_darken_to = "<?php echo esc_attr($low_image_darken_label); ?>";
    var darkify_enable_invert_inline_svg = "<?php echo esc_attr($options["enable_invert_inline_svg"]); ?>";
    var darkify_enable_invert_images = "<?php echo esc_attr($enable_invert_images); ?>";
    var darkify_invert_images_allowed_urls = "<?php echo esc_attr($invert_images_allowed_urls ? $invert_images_allowed_urls_arr : "[]"); ?>";

    var darkify_enable_low_video_brightness = "<?php echo esc_attr($enable_low_video_brightness); ?>";
    var darkify_video_brightness_to = "<?php echo esc_attr($low_video_brightness_label); ?>";
    var darkify_enable_video_grayscale = "<?php echo esc_attr($enable_video_grayscale); ?>";
    var darkify_video_grayscale_to = "<?php echo esc_attr($video_grayscale_label); ?>";

    var darkify_allowed_elements = "<?php echo esc_attr($this->utils->generateAllowedElementsStr($options)); ?>";
    var darkify_allowed_elements_raw = "<?php echo esc_attr($allowed_elements); ?>";
    var darkify_allowed_elements_force_to_correct = "<?php echo esc_attr($allowed_elements_force_to_correct); ?>";
    var darkify_disallowed_elements = "<?php echo esc_attr($this->utils->generateDisallowedElementsStr($options, $this->external_support)); ?>";
    var darkify_disallowed_elements_raw = "<?php echo esc_attr($disallowed_elements); ?>";
    var darkify_disallowed_elements_force_to_correct = "<?php echo esc_attr($disallowed_elements_force_to_correct); ?>";
</script>
<?php
$output = ob_get_clean();
$tags_allowed_in_output = array(
    'style' => array('type' => array(), 'class' => array()),
    'script' => array('type' => array(), 'class' => array())
);
echo wp_kses($this->utils->minify_string($output), $tags_allowed_in_output);
?>