<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('DarkifyClient')) {
    class DarkifyClient
    {
        public $utils;
        public $settings;
        public $external_support;
        public $unique_id;
    
    
        public function __construct()
        {
    
            $this->utils = new DarkifyUtils($this);
            $this->external_support = new DarkifyExternalSupport($this);
            
            new DarkifyShortcodeParser($this);
            
            if ( function_exists( 'wp_rand' ) ) {
                $this->unique_id = wp_rand();
            }

            $options = get_option('darkify');
            $show_in_menu = isset($options['show_in_menu']) ? $options['show_in_menu'] : "";
            $enable_switcher_in_menu = isset($show_in_menu["enable_switch_in_menu"]) ? $show_in_menu["enable_switch_in_menu"] : false;
    
            if($enable_switcher_in_menu){
                add_filter('wp_nav_menu_items',array($this, 'darkify_switch_in_menu'), 10, 2);
            }
    
            add_action( 'wp_enqueue_scripts', array( $this, 'darkify_client_enqueue' ) );
            add_action( 'login_enqueue_scripts', array( $this, 'darkify_client_enqueue' ) );
            add_action( 'register_enqueue_scripts', array( $this, 'darkify_client_enqueue' ) );
            add_action( 'wp_head', array( $this, 'darkify_client_header_script' ), 1);
            add_action( 'login_head', array( $this, 'darkify_client_header_script' ), 1 );
            add_action( 'register_head', array( $this, 'darkify_client_header_script' ), 1 );
            add_action( 'wp_footer', array( $this, 'darkify_client_footer_script' ) );
            add_action( 'login_footer', array( $this, 'darkify_client_footer_script' ) );
            add_action( 'register_footer', array( $this, 'darkify_client_footer_script' ) );
        }

    
        function darkify_client_enqueue() {
            if($this->darkify_is_dark_mode_allowed()){
                $options = get_option('darkify');
                $enable_dark_switcher = $options['enable_dark_switcher'];
                $enable_time = $options['enable_time'];
                
                $enable_default_dark_mode = $options['enable_default_dark_mode'];
                $enable_time = $options['enable_time'];
                $enable_time_based_dark = isset($enable_time['enable_time_based_dark']) ? $enable_time['enable_time_based_dark'] : "";
                $time_based_dark_start = isset($enable_time['time_based_dark_start']['from']) ? $enable_time['time_based_dark_start']['from'] : "";
                $time_based_dark_stop =  isset($enable_time['time_based_dark_start']['to'])  ?  $enable_time['time_based_dark_start']['to'] : "";
                $grayscale =  $options['brightness'];
                $enable_low_image_brightness =  isset($grayscale['enable_low_image_brightness']) ? $grayscale['enable_low_image_brightness'] : "";
                $low_image_brightness_label =  isset($grayscale['low_image_brightness_label']) ? $grayscale['low_image_brightness_label'] : "";
                $grayscale =  isset($options['grayscale']);
                $enable_image_grayscale =  isset($grayscale['enable_image_grayscale']) ? $grayscale['enable_image_grayscale'] : "";
                $image_grayscale_label =  isset($grayscale['image_grayscale_label']) ? $grayscale['image_grayscale_label'] : "";
                $disallowed_low_grayscale_images =  isset($grayscale['disallowed_low_grayscale_images']) ? $grayscale['disallowed_low_grayscale_images'] : "";
                $darken_background =  isset($options['darken_background']);
                $enable_low_image_darken =  isset($darken_background['enable_low_image_darken']) ? $darken_background['enable_low_image_darken'] : "";
                $low_image_darken_label =  isset($darken_background['low_image_darken_label']) ? $darken_background['low_image_darken_label'] : "";
                $video_brightness =  isset($options['video_brightness']);
                $enable_low_video_brightness =  isset($video_brightness['enable_low_video_brightness']) ? $video_brightness['enable_low_video_brightness'] : "";
                $low_video_brightness_label =  isset($video_brightness['low_video_brightness_label']) ? $video_brightness['low_video_brightness_label'] : "";
                $video_grayscale =  isset($options['video_grayscale']);
                $enable_video_grayscale =  isset($video_grayscale['enable_video_grayscale']) ? $video_grayscale['enable_video_grayscale'] : "";


        
                wp_enqueue_style("theme-{$enable_dark_switcher}", DRK_LITE_DIR_URL . "public/css/switcher/$enable_dark_switcher.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-around',  DRK_LITE_DIR_URL . "public/css/switcher/around.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-classic',  DRK_LITE_DIR_URL . "public/css/switcher/classic.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-dark-inner',  DRK_LITE_DIR_URL . "public/css/switcher/dark-inner.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-dark-side',  DRK_LITE_DIR_URL . "public/css/switcher/dark-side.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-eclipse',  DRK_LITE_DIR_URL . "public/css/switcher/eclipse.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-expand',  DRK_LITE_DIR_URL . "public/css/switcher/expand.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-half-sun',  DRK_LITE_DIR_URL . "public/css/switcher/half-sun.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-horizon',  DRK_LITE_DIR_URL . "public/css/switcher/horizon.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-inner-moon',  DRK_LITE_DIR_URL . "public/css/switcher/inner-moon.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-lightbulb',  DRK_LITE_DIR_URL . "public/css/switcher/lightbulb.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-simple',  DRK_LITE_DIR_URL . "public/css/switcher/simple.css", array(), DRK_LITE_VERSION, 'all');
                wp_register_style('theme-within',  DRK_LITE_DIR_URL . "public/css/switcher/within.css", array(), DRK_LITE_VERSION, 'all');
                wp_enqueue_style('darkify-client-main', DRK_LITE_DIR_URL . 'assets/css/client_main.css', array(), DRK_LITE_VERSION);
                wp_enqueue_script( 'darkify-client-main', DRK_LITE_DIR_URL . 'assets/js/client_main.js', array('jquery'), DRK_LITE_VERSION, true);

                $darkify_data = array(
                    'darkify_switch_unique_id' => $this->unique_id,
                    'darkify_is_this_admin_panel' => is_admin() ? "1" : "0",
                    'darkify_enable_default_dark_mode' => $enable_default_dark_mode,
                    'darkify_enable_os_aware' => $options["enable_os_aware"],
                    'darkify_enable_keyboard_shortcut' => $options["enable_keyboard_shortcut"],
                    'darkify_enable_time_based_dark' => $enable_time_based_dark,
                    'darkify_time_based_dark_start' => $time_based_dark_start ? $time_based_dark_start : "19:00",
                    'darkify_time_based_dark_stop' => $time_based_dark_stop ? $time_based_dark_stop : "07:00",
                    'darkify_alternative_dark_mode_switch' => $options["alternative_dark_mode_switcher"],
                    'darkify_enable_low_image_brightness' => $enable_low_image_brightness,
                    'darkify_image_brightness_to' => $low_image_brightness_label,
                    'darkify_enable_image_grayscale' => $enable_image_grayscale,
                    'darkify_image_grayscale_to' => $image_grayscale_label,
                    'darkify_disallowed_grayscale_images' => $disallowed_low_grayscale_images,
                    'darkify_enable_bg_image_darken' => $enable_low_image_darken,
                    'darkify_bg_image_darken_to' => $low_image_darken_label,
                    'darkify_enable_invert_inline_svg' => $options["enable_invert_inline_svg"],
                    'darkify_enable_low_video_brightness' => $enable_low_video_brightness,
                    'darkify_video_brightness_to' => $low_video_brightness_label,
                    'darkify_enable_video_grayscale' => $enable_video_grayscale,
                    // Add more variables as needed...
                );
                wp_localize_script('darkify-client-main', 'darkify_data', $darkify_data);
            }
        }
        function darkify_is_dark_mode_allowed() {
            $options = get_option('darkify');
            /* Disable if Oxygen Builder is Opened */
            if (isset( $_GET['ct_builder'] )) {
                if($_GET['ct_builder'] == "true"){
                    if (!isset( $_GET['oxygen_iframe'] )) {
                        return False;
                    }
                }
            }
    
            return True;
        }
    
    
        function darkify_client_header_script()
        {
            if($this->darkify_is_dark_mode_allowed()){
                include_once DRK_LITE_PATH . "public/templates/header_script.php";
            }
        }
    
        function darkify_client_footer_script()
        {
            if($this->darkify_is_dark_mode_allowed()){
                include_once DRK_LITE_PATH . "public/templates/footer_script.php";
            }
        }
    
        function darkify_switch_in_menu( $items, $args ) {
            $options = get_option('darkify');
            $show_in_menu = $options['show_in_menu'];
            $switch_in_menu_location = $show_in_menu['switch_in_menu_location'];
            $darkify_menu_shortcode_helper = $show_in_menu['darkify_menu_shortcode_helper'];
    
            if($this->darkify_is_dark_mode_allowed()){
                if(isset($args->menu->term_id)){
                    if($args->menu->term_id == $switch_in_menu_location){
                        $items .=  '<li class="menu-item">'.do_shortcode($darkify_menu_shortcode_helper).'</li>';
                    }
                }
            }
            return $items;
        }
       
    }
}

new DarkifyClient();


