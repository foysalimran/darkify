<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package    Darkify
 * @subpackage Darkify/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Darkify
 * @subpackage Darkify/public
 * @author     ThemeAtelier <themeatelierbd@gmail.com>
 */
class Darkify_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
	}


	private function load_dependencies(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-darkify-shortcode.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-darkify-client.php';

	}

}
