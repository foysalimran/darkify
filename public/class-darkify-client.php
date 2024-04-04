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


