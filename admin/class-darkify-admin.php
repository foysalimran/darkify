<?php

class Darkify_Admin
{

	public $utils;
	public $settings;
	public $external_support;

	public $unique_id;

	private $plugin_name;
	private $version;

	public function __construct($plugin_name, $version)
	{

		$this->utils = new DarkifyUtils($this);
		$this->external_support = new DarkifyExternalSupport($this);
		if (function_exists('wp_rand')) {
			$this->unique_id = wp_rand();
		}
		$options = get_option('darkify');
		$enable_admin_panel_dark_mode = isset($options['enable_admin_panel_dark_mode']) ? $options['enable_admin_panel_dark_mode'] : false;

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_filter('plugin_action_links', array($this, 'add_plugin_action_links'), 10, 2);

		add_action('admin_enqueue_scripts', array($this, 'darkify_admin_enqueue'));

		if ($enable_admin_panel_dark_mode) {
			add_action('admin_bar_menu',  array($this, 'darkify_admin_bar_switch'), 9999);
			add_action('admin_print_scripts', array($this, 'darkify_admin_header_script'), 1);
			add_action('admin_footer', array($this, 'darkify_admin_footer_script'));
		}
	}

	public function enqueue_styles()
	{
		wp_enqueue_style($this->plugin_name, DRK_LITE_DIR_URL . 'admin/css/darkify-admin.css', array(), $this->version, 'all');
	}

	public function enqueue_scripts($hook)
	{
		if($hook !== 'toplevel_page_darkify'){
			return;
		}
		wp_enqueue_script($this->plugin_name, DRK_LITE_DIR_URL . 'admin/js/darkify-admin.js', array(), $this->version, 'all');
	}

	public function add_plugin_action_links($links, $file)
	{
		if (DRK_LITE_BASENAME === $file) {
			$new_links       = array(
				sprintf('<a href="%s">%s</a>', admin_url('admin.php?page=darkify#tab=control'), __('Settings', 'darkify')),
			);
			return array_merge($new_links, $links);
		}
		return $links;
	}

	function darkify_admin_enqueue($page)
	{
		$options = get_option('darkify');
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

		if ($options["enable_admin_panel_dark_mode"]) {
			if ($this->darkify_is_dark_mode_allowed()) {
				if (!wp_style_is('darkify-admin-switch', 'enqueued')) {
					wp_enqueue_style('darkify-admin-switch', DRK_LITE_DIR_URL . 'assets/css/client_main.css', array(), $this->version, 'all');
				}
				wp_enqueue_script('darkify-admin-client-main', DRK_LITE_DIR_URL . 'assets/js/client_main.js', array(), $this->version, true);

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
				wp_localize_script('darkify-admin-client-main', 'darkify_data', $darkify_data);
			}
		}
	}

	function darkify_admin_bar_switch($wp_admin_bar)
	{
		if ($this->darkify_is_dark_mode_allowed()) {
			$args = array(
				'parent' => 'top-secondary',
				'id' => 'darkify_admin_bar_switch_container',
				'meta' => array(
					'class' => 'darkify_admin_bar_switch_container',
					'onclick' => 'darkify_switch_trigger()',
				)
			);
			$wp_admin_bar->add_node($args);
		}
	}

	function darkify_is_dark_mode_allowed()
	{

		$options = get_option('darkify');
		$disallowed_admin_pages = isset($options["disallowed_admin_pages"]) ? $options["disallowed_admin_pages"] : "";
		/* Disable on Disallowed Admin Plugins */
		if ($this->utils->isRestrictedByDisallowedAdminPages($disallowed_admin_pages)) {
			return False;
		}
		return True;
	}

	function darkify_admin_header_script()
	{
		if ($this->darkify_is_dark_mode_allowed()) {
			include_once DRK_LITE_PATH . "public/templates/header_script.php";
		}
	}

	function darkify_admin_footer_script()
	{
		if ($this->darkify_is_dark_mode_allowed()) {
			include_once DRK_LITE_PATH . "public/templates/footer_script.php";
		}
	}
}
