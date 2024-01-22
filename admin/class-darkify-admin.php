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
		$this->unique_id = rand();
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

	public function enqueue_scripts()
	{
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
		if ($options["enable_admin_panel_dark_mode"]) {
			if ($this->darkify_is_dark_mode_allowed()) {
				if (!wp_style_is('darkify-admin-switch', 'enqueued')) {
					wp_enqueue_style('darkify-admin-switch', DRK_LITE_DIR_URL . 'assets/css/client_main.css', array(), $this->version, 'all');
				}
				wp_enqueue_script('darkify-admin-client-main', DRK_LITE_DIR_URL . 'assets/js/client_main.js', array(), $this->version, true);
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
