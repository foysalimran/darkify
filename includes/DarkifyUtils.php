<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('DarkifyUtils')) {
    class DarkifyUtils
    {

        public $base_admin;
        public function __construct($base_admin)
        {
            $this->base_admin = $base_admin;
        }


        public function isMobile()
        {
            if (function_exists("wp_is_mobile")) {
                return wp_is_mobile();
            } else {
                $user_agent = $_SERVER["HTTP_USER_AGENT"];
                $pattern = "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i";
                $escaped_pattern = preg_quote($pattern, '/');
                return preg_match(esc_attr($escaped_pattern), esc_attr($user_agent));
            }
        }
        public function is_hidden_by_user_agent($hide_on_desktop, $hide_dark_mode_on_mobile, $type_of_hide_by)
        {
            if ($this->isMobile()) {
                if ($hide_dark_mode_on_mobile) {
                    if ($type_of_hide_by == "user_agent" || $type_of_hide_by == "both") {
                        return True;
                    }
                }
            } else {
                if ($hide_on_desktop) {
                    return True;
                }
            }
            return False;
        }

        public function generateSwitchStyles($options)
        {
            $switch_border_radius = $options["switch_border_radius"];
            $styles = array(

                "--darkify_switch_width_height" => $options["switch_width_height"]["width"] . "px",
                "--darkify_switch_icon_size" => $options["switch_icon_size"]["width"] . "px",
                "--darkify_switch_border_radius" => $switch_border_radius['all'] . "px",
                "--darkify_switch_light_mode_bg" => $options["switch_light_mode_bg"],
                "--darkify_switch_dark_mode_bg" => $options["switch_dark_mode_bg"],
                "--darkify_switch_light_mode_color" => $options["switch_light_mode_color"],
                "--darkify_switch_dark_mode_color" => $options["switch_dark_mode_color"],
            );
            return $styles;
        }


        public function generateSwitchStylesForShortcode($atts)
        {
            $styles = array();
            foreach ($atts as $key => $value) {
                if ($key == "switch") {
                    continue;
                }
                $styles["--darkify_switch_" . $key] = $value;
            }
            return $styles;
        }

        public function minify_string($buffer)
        {
            $search = array(
                '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
                '/[^\S ]+\</s',     // strip whitespaces before tags, except space
                '/(\s)+/s',         // shorten multiple whitespace sequences
                '/<!--(.|\s)*?-->/' // Remove HTML comments
            );
            $replace = array(
                '>',
                '<',
                '\\1',
                ''
            );
            $buffer = preg_replace($search, $replace, $buffer);
            return $buffer;
        }

        public function isRestrictedByDisallowedAdminPages($disallowed_admin_pages)
        {
            if (strlen(trim($disallowed_admin_pages)) > 0) {
                if (function_exists("get_current_screen")) {
                    $current_screen = get_current_screen();
                    $parts = explode('_page_', $current_screen->id);
                    if (count($parts) !== 2) {
                        return False;
                    } /* means it's something like invalid page slug */
                    $page_slug = $parts[1];

                    $disallowed_admin_pages_arr = explode(',', $disallowed_admin_pages);
                    if (is_array($disallowed_admin_pages_arr)) {
                        if (sizeof($disallowed_admin_pages_arr) > 0) {
                            foreach ($disallowed_admin_pages_arr as $single_page) {
                                if ($page_slug == trim($single_page)) {
                                    return True;
                                }
                            }
                        }
                    }
                }
            }
            return False;
        }
    }
}
