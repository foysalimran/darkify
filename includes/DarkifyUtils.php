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
                return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
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


        public function string_contains_any($string, $words, $caseSensitive = true)
        {
            foreach ($words as $word) {
                $position = $caseSensitive ? stripos($string, $word) : strpos($string, $word);
                if ($position !== false) {
                    return true;
                }
            }
            return false;
        }

        public function extractCustomCssSelectorsForAutoExcluding($css)
        {
            $pseudo_classes = array(":after", ":before", ":first-letter", ":first-line", ":selection", ":not-disallowed");
            $css = str_replace(array("\r", "\n"), "", $css);
            /* Convert to Array */
            $exclude_elements = array();
            $results = array();
            preg_match_all('/(.+?)\s?\{\s?(.+?)\s?\}/', $css, $matches);
            foreach ($matches[0] as $i => $original) {
                foreach (explode(';', $matches[2][$i]) as $attr) {
                    if (strlen(trim($attr)) > 0) // for missing semicolon on last element, which is legal
                    {
                        list($name, $value) = explode(':', $attr);
                        $results[$matches[1][$i]][trim($name)] = trim($value);
                    }
                }
            }
            /* Array to processed css string */
            foreach ($results as $single_selector => $rules) {
                $single_selector_arr = explode(",", $single_selector);
                for ($i = 0; $i < sizeof($single_selector_arr); $i++) {
                    if (!$this->string_contains_any(trim($single_selector_arr[$i]), $pseudo_classes, false)) {
                        $exclude_elements[] = trim($single_selector_arr[$i]);
                    }
                }
            }
            return $exclude_elements;
        }

        public function parseAndProcessCustomCSS($css)
        {
            /* Replace : on https:// or http:// for detecting as background:black type */
            $css = str_replace("://", "--colon--//", $css);

            $css = str_replace(array("\r", "\n"), "", $css);
            /* Convert to Array */
            $results = array();
            preg_match_all('/(.+?)\s?\{\s?(.+?)\s?\}/', $css, $matches);
            foreach ($matches[0] as $i => $original) {
                foreach (explode(';', $matches[2][$i]) as $attr) {
                    if (strlen(trim($attr)) > 0) // for missing semicolon on last element, which is legal
                    {
                        list($name, $value) = explode(':', $attr);
                        $results[$matches[1][$i]][trim($name)] = trim($value);
                    }
                }
            }
            /* Array to processed css string */
            $updated_css = "";
            foreach ($results as $single_selector => $rules) {
                $updated_single_selector = "";
                $single_selector_arr = explode(",", $single_selector);
                for ($i = 0; $i < sizeof($single_selector_arr); $i++) {
                    if ($i > 0) {
                        $updated_single_selector .= ", ";
                    }
                    $updated_single_selector .= ".darkify_dark_mode_enabled " . trim($single_selector_arr[$i]);
                }

                $updated_single_selector = str_replace(":not-disallowed", "", $updated_single_selector);
                $updated_css .= $updated_single_selector . "{";

                foreach ($rules as $key => $value) {
                    if (strpos($value, "important") == false) {
                        $value = $value . " !important";
                    }
                    $updated_css .= $key . ": " . $value . ";";
                }

                $updated_css .= "}";
            }
            /* Replace --colon--// back to https:// or http:// format */
            $updated_css = str_replace("--colon--//", "://", $updated_css);
            return $updated_css;
        }


        public function parseAndProcessNormalCustomCSS($css)
        {
            /* Replace : on https:// or http:// for detecting as background:black type */
            $css = str_replace("://", "--colon--//", $css);

            $css = str_replace(array("\r", "\n"), "", $css);
            /* Convert to Array */
            $results = array();
            preg_match_all('/(.+?)\s?\{\s?(.+?)\s?\}/', $css, $matches);
            foreach ($matches[0] as $i => $original) {
                foreach (explode(';', $matches[2][$i]) as $attr) {
                    if (strlen(trim($attr)) > 0) // for missing semicolon on last element, which is legal
                    {
                        list($name, $value) = explode(':', $attr);
                        $results[$matches[1][$i]][trim($name)] = trim($value);
                    }
                }
            }
            /* Array to processed css string */
            $updated_css = "";
            foreach ($results as $single_selector => $rules) {
                $updated_css .= $single_selector . "{";

                foreach ($rules as $key => $value) {
                    if (strpos($value, "important") == false) {
                        $value = $value . " !important";
                    }
                    $updated_css .= $key . ": " . $value . ";";
                }

                $updated_css .= "}";
            }
            /* Replace --colon--// back to https:// or http:// format */
            $updated_css = str_replace("--colon--//", "://", $updated_css);
            return $updated_css;
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


        public function getWpNavMenus()
        {
            $results = array();
            $results[] = array("id" => "0", "text" => "Choose Menu");
            $menus = wp_get_nav_menus();
            foreach ($menus as $menu) {
                $results[] = array("id" => $menu->term_id, "text" => $menu->name);
            }
            return $results;
        }

        public function getWpPages()
        {
            $results = array();
            $results[] = array("id" => "0", "text" => "Homepage");
            $results[] = array("id" => "lr", "text" => "WP Login / Registration Page");
            $args = array('post_type' => 'page', 'posts_per_page' => -1, 'orderby' => 'title', 'order'   => 'ASC');
            foreach (get_posts($args) as $page) {
                $results[] = array("id" => $page->ID, "text" => $page->post_title);
            }
            return $results;
        }

        public function searchWpPosts($search = "")
        {
            global $wpdb;
            $results = array();
            $sql = $wpdb->prepare("SELECT ID, post_title FROM {$wpdb->prefix}posts WHERE post_type = 'post' AND post_title LIKE %s GROUP BY ID ORDER BY ID DESC LIMIT 10", array('%' . $search . '%'));
            $listPosts = $wpdb->get_results($sql);
            if (sizeof($listPosts) > 0) {
                foreach ($listPosts as $singlePost) {
                    $results[] = array("id" => $singlePost->ID, "text" => $singlePost->post_title);
                }
            }
            return $results;
        }


        public function getWpPosts($post_ids = array())
        {
            $results = array();
            if (sizeof($post_ids) > 0) {
                $args = array('post_type' => 'post', 'posts_per_page' => -1, 'orderby' => 'ID', 'order'   => 'DESC', 'post__in' => $post_ids);
                foreach (get_posts($args) as $page) {
                    $results[] = array("id" => $page->ID, "text" => $page->post_title);
                }
            }
            return $results;
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
