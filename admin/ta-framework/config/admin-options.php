<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = 'darkify';

//
// Create options
//
DRK::createOptions($prefix, array(
  'menu_title' => esc_html__('Darkify','darkify'),
  'menu_slug'  => 'darkify',
  'menu_icon'  => 'data:image/svg+xml;base64,' . base64_encode('<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.5 1.5C23.5 0.671573 22.8284 0 22 0C21.1716 0 20.5 0.671573 20.5 1.5V4.5C20.5 5.32843 21.1716 6 22 6C22.8284 6 23.5 5.32843 23.5 4.5V1.5Z" fill="white"/><path d="M34 22C34 28.6274 28.6274 34 22 34C15.3726 34 10 28.6274 10 22C10 15.3726 15.3726 10 22 10C28.6274 10 34 15.3726 34 22Z" fill="white"/><path d="M22 38C22.8284 38 23.5 38.6716 23.5 39.5V42.5C23.5 43.3284 22.8284 44 22 44C21.1716 44 20.5 43.3284 20.5 42.5V39.5C20.5 38.6716 21.1716 38 22 38Z" fill="white"/><path d="M10.6863 10.6863C10.1005 11.2721 9.15074 11.2721 8.56495 10.6863L6.44363 8.56498C5.85784 7.97919 5.85784 7.02945 6.44363 6.44366C7.02942 5.85787 7.97916 5.85787 8.56495 6.44366L10.6863 8.56498C11.2721 9.15077 11.2721 10.1005 10.6863 10.6863Z" fill="white"/><path d="M35.435 37.5564C36.0208 38.1421 36.9705 38.1421 37.5563 37.5564C38.1421 36.9706 38.1421 36.0208 37.5563 35.435L35.435 33.3137C34.8492 32.7279 33.8995 32.7279 33.3137 33.3137C32.7279 33.8995 32.7279 34.8493 33.3137 35.435L35.435 37.5564Z" fill="white"/><path d="M10.6863 33.3137C11.2721 33.8995 11.2721 34.8492 10.6863 35.435L8.56495 37.5563C7.97916 38.1421 7.02942 38.1421 6.44363 37.5563C5.85784 36.9706 5.85784 36.0208 6.44363 35.435L8.56495 33.3137C9.15074 32.7279 10.1005 32.7279 10.6863 33.3137Z" fill="white"/><path d="M37.5563 8.56496C38.1421 7.97918 38.1421 7.02943 37.5563 6.44364C36.9705 5.85786 36.0208 5.85786 35.435 6.44364L33.3137 8.56496C32.7279 9.15075 32.7279 10.1005 33.3137 10.6863C33.8995 11.2721 34.8492 11.2721 35.435 10.6863L37.5563 8.56496Z" fill="white"/><path d="M6 22C6 22.8284 5.32843 23.5 4.5 23.5H1.5C0.671573 23.5 0 22.8284 0 22C0 21.1716 0.671573 20.5 1.5 20.5H4.5C5.32843 20.5 6 21.1716 6 22Z" fill="white"/><path d="M42.5 23.5C43.3284 23.5 44 22.8284 44 22C44 21.1716 43.3284 20.5 42.5 20.5H39.5C38.6716 20.5 38 21.1716 38 22C38 22.8284 38.6716 23.5 39.5 23.5H42.5Z" fill="white"/></svg>'),
  'framework_title'   => esc_html__('Darkify ', 'darkify'),
  'footer_text'       => esc_html__('Thank you for using our plugin', 'darkify'),
  'context'           => 'normal',
  'theme'             => 'light',
  'show_sub_menu'     => false,
  'show_bar_menu'     => false,
  'sticky_header'     => false,
  'show_footer'     => false,
));

//
// control section
//
DRK::createSection($prefix, array(
  'id'    => 'control_fields',
  'title'       => esc_html__('CONTROL', 'darkify'),
  'icon'        => 'fas fa-gamepad',
)
 );

 DRK::createSection( $prefix, array(
  'parent'      => 'control_fields',
  'title'       => 'Basic Control',
  'icon'        => 'fas fa-cog',
  'fields'      => array(
    array(
      'type'    => 'heading',
      'content' => esc_html__('Basic Control', 'darkify'),
    ),
    array(
      'id'      => 'enable_dark_mode_switch',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable Frontend Dark Mode Switch', 'darkify'),
      'desc'    => esc_html__('Switch to show the Dark Mode Floating Switch in your Websites frontend.', 'darkify'),
      'default' => true,
    ),
    array(
      'id'      => 'enable_default_dark_mode',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable Default Dark Mode', 'darkify'),
      'desc'    => esc_html__('Switch to automatically turn your website dark by default.', 'darkify'),
    ),
    array(
      'id'      => 'enable_os_aware',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable OS Aware Dark Mode', 'darkify'),
      'desc'    => esc_html__('Switch to enable or disable dark mode automatically according to users’ device preference.', 'darkify'),
      'default' => true,
    ),
    array(
      'id'      => 'enable_keyboard_shortcut',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable Keyboard Shortcut', 'darkify'),
      'desc'    => esc_html__('Switch to turn ON or OFF dark mode by pressing Ctrl+Alt+D on keyboard.', 'darkify'),
      'default' => true,
    ),
    ),
    ),
  );
  
  DRK::createSection( $prefix, array(
    'parent'      => 'control_fields',
    'title'       => 'Advanced Control',
    'icon'        => 'fas fa-cogs',
    'fields'      => array(
    array(
      'type'    => 'heading',
      'content' => esc_html__('Advanced Control', 'darkify'),
    ),

    // Enable Time Based Auto Dark Mode
    array(
      'id'     => 'enable_time',
      'type'   => 'fieldset',
      'title'  => esc_html__('Enable Time', 'darkify'),
      'fields' => array(
        array(
          'id'    => 'enable_time_based_dark',
          'type'  => 'switcher',
          'title' => esc_html__('Enable Time Based Auto Dark Mode', 'darkify'),
          'desc'  => esc_html__('Automatically turn dark mode ON based on users’ localtime.', 'darkify'),
        ),
        array(
          'id'        => 'time_based_dark_start',
          'type'      => 'datetime',
          'title'     => esc_html__('Pick a Time', 'darkify'),
          'from_to'   => true,
          'text_from' => esc_html__('Form', 'darkify'),
          'text_to'   => esc_html__('To', 'darkify'),
          'settings'  => array(
            'noCalendar' => true,
            'enableTime' => true,
            'dateFormat' => 'H:i',
            'time_24hr'  => false,
          ),
          'dependency' => array('enable_time_based_dark', '==', 'true'),
        ),
      ),
    ),
    array(
      'id'      => 'hide_on_desktop',
      'type'    => 'switcher',
      'title'   => esc_html__('Hide Dark Mode Switch on Desktop', 'darkify'),
      'desc'    => esc_html__('Switch to hide the Dark Mode Floating Switch if users’ are using desktop or laptop.', 'darkify'),
    ),
    array(
      'id'     => 'hide_on_mobile',
      'type'   => 'fieldset',
      'title'  => esc_html__('Hide On Mobile', 'darkify'),
      'fields' => array(
        array(
          'id'      => 'hide_dark_mode_on_mobile',
          'type'    => 'switcher',
          'title'   => esc_html__('Hide Dark Mode on Mobile', 'darkify'),
          'desc'    => esc_html__('Switch to hide the Dark Mode Floating Switch if users’ are using mobile.', 'darkify'),
        ),
        array(
          'id'      => 'type_of_hide_by',
          'type'    => 'select',
          'title'   => esc_html__('Type of Hide By', 'darkify'),
          'options' => array(
            'user_agent'  => esc_html__('Hide by User Agent', 'darkify'),
            'screen_size' => esc_html__('Hide by Screen Size', 'darkify'),
            'both'        => esc_html__('Hide by Both', 'darkify'),
          ),
          'default' => 'both',
          'dependency' => array('hide_dark_mode_on_mobile', '==', 'true'),
        ),
      ),
    ),
    
    array(
      'id'     => 'show_in_menu',
      'type'   => 'fieldset',
      'title'  => esc_html__('Show in Menu', 'darkify'),
      'fields' => array(
        array(
          'id'      => 'enable_switch_in_menu',
          'type'    => 'switcher',
          'title'   => esc_html__('Show Switch in Menu', 'darkify'),
          'desc'    => esc_html__('Show the dark mode toggle switch in specific menu.', 'darkify'),
        ),
        array(
          'id'          => 'switch_in_menu_location',
          'type'        => 'select',
          'title'       => esc_html__('Select Menu', 'darkify'),
          'options'     => 'menus',
          'dependency'  => array('enable_switch_in_menu', '==', 'true'),
        ),
        array(
          'id'          => 'darkify_menu_shortcode_helper',
          'type'        => 'textarea',
          'title'       => esc_html__('Short Code menu', 'darkify'),
          'desc'        => esc_html__('You can generate customized switch shortcode from SWITCH STYLE > Advanced Customization.', 'darkify'),
          'dependency'  => array('enable_switch_in_menu', '==', 'true'),
          'default'     => '[darkify switch="1" width_height="60px" border_radius="7px" icon_size="40px" light_mode_bg="#121116" dark_mode_bg="#ffffff" light_mode_color="#ffffff" dark_mode_color="#121116"]'
        ),
      ),
    ),
  )
));
DRK::createSection($prefix, array(
  'title'       => esc_html__('ADMIN DARK MODE', 'darkify'),
  'icon'        => 'fab fa-wordpress-simple',
  'id'    => 'control_admin',
  'fields'      => array(
    array(
      'type'    => 'heading',
      'content' => esc_html__('Admin Panel Dark Control', 'darkify'),
    ),
    array(
      'id'      => 'enable_admin_panel_dark_mode',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable Admin Panel Dark Mode', 'darkify'),
      'desc'    => esc_html__('Switch to show the Dark Mode Floating Switch in your Websites frontend.', 'darkify'),
      'default' => false,
    ),

    // array(
    //   'id'          => 'disallowed_admin_pages',
    //   'type'        => 'textarea',
    //   'title'       => esc_html__('Disallowed Pages', 'darkify'),
    //   'desc'        => esc_html__('Dark mode will not be applied to these admin pages.', 'darkify'),
    //   'placeholder' => esc_html__('Enter comma separated page slugs. Example: darkify-dashboard, elementor', 'darkify'),
    //   'dependency'  => array('enable_admin_panel_dark_mode', '==', 'true'),
    // ),
  )
));
DRK::createSection($prefix, array(
  'id'    => 'control_switch',
  'title'         => esc_html__('SWITCHER STYLE', 'darkify'),
  'icon'          => 'fas fa-toggle-off',

));
DRK::createSection($prefix, array(
  'parent'    => 'control_switch',
  'title'         => esc_html__('Switcher Version', 'darkify'),
  'icon'          => 'fas fa-code-branch',
  'fields' => array(
    array(
      'type'    => 'heading',
      'content' => esc_html__('Switch Version', 'darkify'),
    ),
    array(
      'id' => 'enable_dark_switcher',
      'type' => 'image_select',
      'title' => esc_html__('Floating Switch', 'darkify'),
      'desc'  => esc_html__('Choose default floating switch', 'darkify'),
      'class' => 'icon_select',
      'options' => array(
        'classic' => DRK_PLUGIN_DIR_URL . '/admin/image/icon-01.jpg',
        'expand' => DRK_PLUGIN_DIR_URL . '/admin/image/icon-02.jpg',
        'inner-moon' => DRK_PLUGIN_DIR_URL . '/admin/image/icon-03.jpg',
        'within' => DRK_PLUGIN_DIR_URL . '/admin/image/icon-04.jpg',
      ),
      'default' => 'classic',
    ),

    // Enable Tooltip on Floating Switch
    array(
      'id'     => 'tooltip_on_floating_switch',
      'type'   => 'fieldset',
      'title'  => esc_html__('Tooltip on Floating Switch', 'darkify'),
      'fields' => array(
        array(
          'id'          => 'floating_switch_width',
          'type'        => 'switcher',
          'title'       => esc_html__('Enable Tooltip on Floating Switch', 'darkify'),
          'desc'       => esc_html__('Want to show a hint on dark mode floating switch as tooltip?', 'darkify'),
          'default'     => false,
        ),
        array(
          'id'          => 'tooltip_position',
          'type'        => 'select',
          'title'       => esc_html__('Tooltip Position', 'darkify'),
          'desc'       => esc_html__('Choose the position where the tooltip should be displaed relative to the floating switch.', 'darkify'),
          'options' => array(
            'top' => esc_html__('Top', 'darkify'),
            'bottom' => esc_html__('Bottom', 'darkify'),
            'left' => esc_html__('Left', 'darkify'),
            'right' => esc_html__('Right', 'darkify'),
          ),
          'default'     => 'left',
          'dependency'  => array('floating_switch_width', '==', 'true'),
        ),
        array(
          'id'          => 'tooltip_text',
          'type'        => 'text',
          'title'       => esc_html__('Tooltip Text', 'darkify'),
          'desc'       => esc_html__('Customize text to be displayed on the tooltip.', 'darkify'),
          'default'     => esc_html__('Tooltip Text', 'darkify'),
          'dependency'  => array('floating_switch_width', '==', 'true'),
        ),
        array(
          'id'          => 'tooltip_background_color',
          'type'        => 'color',
          'title'       => esc_html__('Tooltip Background Color', 'darkify'),
          'desc'       => esc_html__('Customize the background color of the floating switch tooltip.', 'darkify'),
          'dependency'  => array('floating_switch_width', '==', 'true'),
          'default' => '#142434',
        ),
        array(
          'id'          => 'tooltip_text_color',
          'type'        => 'color',
          'title'       => esc_html__('Tooltip Text Color', 'darkify'),
          'desc'       => esc_html__('Customize default margin from the left of the Floating Switch in Mobile.', 'darkify'),
          'dependency'  => array('floating_switch_width', '==', 'true'),
          'default' => '#B0CBE7',
        ),
      ),
    ),
  )
  )
);
// Postion customization
    DRK::createSection($prefix, array(
      'parent'    => 'control_switch',
      'title'         => esc_html__('Postition Customization', 'darkify'),
      'icon'          => 'fas fa-arrows-alt',
      'fields' => array(
    array(
      'type'    => 'heading',
      'content' => esc_html__('Position Customization', 'darkify'),
    ),

    // Switch Position
    array(
      'id'     => 'switcher_button_position',
      'type'   => 'fieldset',
      'title'  => esc_html__('Switch Button Position', 'darkify'),
      'fields' => array(
        array(
          'id'          => 'dark_mode_switch_position',
          'type'        => 'select',
          'title'       => esc_html__('Switch Position', 'darkify'),
          'desc'        => esc_html__('Choose the screen position where the Floating Switch should be displayed.', 'darkify'),
          'options'     => array(
            'top_right' => esc_html__('Top Right', 'darkify'),
            'top_left'  => esc_html__('Top Left', 'darkify'),
            'bottom_right' => esc_html__('Bottom Right', 'darkify'),
            'bottom_left' => esc_html__('Bottom Left', 'darkify'),
          ),
          'default' => 'bottom_right',
        ),
        array(
          'id'          => 'switch_position_top_right',
          'type'        => 'spacing',
          'title'       => esc_html__('Margin From Top Right', 'darkify'),
          'desc'        => esc_html__('Customize default margin from the top right of the Floating Switch.', 'darkify'),
          'left'        => false,
          'bottom'      => false,
          'default'  => array(
            'top'    => '40',
            'right'  => '40',
            'unit'   => 'px',
          ),
          'dependency' => array('dark_mode_switch_position', '==', 'top_right'),
        ),
        array(
          'id'          => 'switch_position_top_left',
          'type'        => 'spacing',
          'title'       => esc_html__('Margin From Top Left', 'darkify'),
          'desc'        => esc_html__('Customize default margin from the top left of the Floating Switch.', 'darkify'),
          'right'       => false,
          'bottom'      => false,
          'default'   => array(
            'top'     => '40',
            'left'    => '40',
            'unit'    => 'px',
          ),
          'dependency' => array('dark_mode_switch_position', '==', 'top_left'),
        ),
        array(
          'id'          => 'switch_position_bottom_right',
          'type'        => 'spacing',
          'title'       => esc_html__('Margin From Bottom Right', 'darkify'),
          'desc'        => esc_html__('Customize default margin from the bottom right of the Floating Switch.', 'darkify'),
          'left'        => false,
          'top'         => false,
          'default'     => array(
            'bottom'    => '40',
            'right'     => '40',
            'unit'      => 'px',
          ),
          'dependency' => array('dark_mode_switch_position', '==', 'bottom_right'),
        ),
        array(
          'id'          => 'switch_position_bottom_left',
          'type'        => 'spacing',
          'title'       => esc_html__('Margin from bottom left', 'darkify'),
          'desc'        => esc_html__('Customize default margin from the bottom left of the Floating Switch.', 'darkify'),
          'right'       => false,
          'top'         => false,
          'default'  => array(
            'bottom'  => '40',
            'left'    => '40',
            'unit'    => 'px',
          ),
          'dependency'  => array('dark_mode_switch_position', '==', 'bottom_left'),
        ),
      ),
    ),

    // Different Switch Position in Mobile
    array(
      'id'     => 'different_switch_in_mobile',
      'type'   => 'fieldset',
      'title'  => esc_html__('Different Switch in Mobile', 'darkify'),
      'fields' => array(
        array(
          'id'          => 'switch_position_different_in_mobile',
          'type'        => 'switcher',
          'title'       => esc_html__('Different Switch Position in Mobile', 'darkify'),
          'desc'        => esc_html__('Should the Floating Switch be displayed on different position in mobile?', 'darkify'),
          'default'     => true,
        ),
        array(
          'id'          => 'switch_position_in_mobile',
          'type'        => 'select',
          'title'       => esc_html__('Switch Position in Mobile', 'darkify'),
          'desc'        => esc_html__('Choose the screen position where the Floating Switch should be displayed in mobile.', 'darkify'),
          'options'     => array(
            'top_right'     => esc_html__('Top Right', 'darkify'),
            'top_left'      => esc_html__('Top Left', 'darkify'),
            'bottom_right'  => esc_html__('Bottom Right', 'darkify'),
            'bottom_left'   => esc_html__('Bottom Left', 'darkify'),
          ),
          'dependency' => array('switch_position_different_in_mobile', '==', 'true'),
        ),
        array(
          'id'          => 'switch_position_top_right_in_mobile',
          'type'        => 'spacing',
          'title'       => esc_html__('Margin From Top Right in Mobile', 'darkify'),
          'desc'        => esc_html__('Customize default margin from the top right of the Floating Switch.', 'darkify'),
          'left'        => false,
          'bottom'      => false,
          'default'  => array(
            'top'       => '40',
            'right'     => '40',
            'unit'      => 'px',
          ),
          'dependency' => array('switch_position_different_in_mobile|switch_position_in_mobile', '==|==', 'true|top_right'),
        ),
        array(
          'id'          => 'switch_position_top_left_in_mobile',
          'type'        => 'spacing',
          'title'       => esc_html__('Margin From Top Left in Mobile', 'darkify'),
          'desc'        => esc_html__('Customize default margin from the top left of the Floating Switch.', 'darkify'),
          'right'       => false,
          'bottom'      => false,
          'default'  => array(
            'top'     => '40',
            'left'    => '40',
            'unit'    => 'px',
          ),
          'dependency' => array('switch_position_different_in_mobile|switch_position_in_mobile', '==|==', 'true|top_left'),
        ),
        array(
          'id'          => 'switch_position_bottom_right_in_mobile',
          'type'        => 'spacing',
          'title'       => esc_html__('Margin From Bottom Right in Mobile', 'darkify'),
          'desc'        => esc_html__('Customize default margin from the bottom right of the Floating Switch.', 'darkify'),
          'left'        => false,
          'top'         => false,
          'default'  => array(
            'bottom'    => '40',
            'right'     => '40',
            'unit'      => 'px',
          ),
          'dependency' => array('switch_position_different_in_mobile|switch_position_in_mobile', '==|==', 'true|bottom_right'),
        ),
        array(
          'id'          => 'switch_position_bottom_left_in_mobile',
          'type'        => 'spacing',
          'title'       => esc_html__('Margin From Bottom Left in Mobile', 'darkify'),
          'desc'        => esc_html__('Customize default margin from the bottom left of the Floating Switch.', 'darkify'),
          'right'       => false,
          'top'         => false,
          'default'  => array(
            'bottom'    => '40',
            'left'      => '40',
            'unit'      => 'px',
          ),
          'dependency'  => array('switch_position_different_in_mobile|switch_position_in_mobile', '==|==', 'true|bottom_left'),
        ),
      ),
    ),
    array(
      'id'          => 'enable_absolute_position',
      'type'        => 'switcher',
      'title'       => esc_html__('Absolute Switch Position', 'darkify'),
      'text_on'     => esc_html__('Enabled', 'darkify'),
      'text_off'    => esc_html__('Disabled', 'darkify'),
      'text_width'  => '100',
      'desc'        => esc_html__('Enable to make the floating switch scroll from its position with page scrolling.', 'darkify'),
    ),
  )));

  DRK::createSection($prefix, array(
    'parent'    => 'control_switch',
    'title'         => esc_html__('Advanced Customization', 'darkify'),
    'icon'          => 'fas fa-truck-monster',
    'fields' => array(
    array(
      'type'      => 'heading',
      'content'   => esc_html__('Advanced Customization', 'darkify'),
    ),

    array(
      'id'         => 'switch_width_height',
      'type'       => 'dimensions',
      'title'      => esc_html__('Floating Switch Size', 'darkify'),
      'desc'       => esc_html__('Customize the Selected Switch Design in Your Way.', 'darkify'),
      'height'    => false,
      'default'   => array(
        'width'    => '60',
      )
    ),
    array(
      'id'         => 'switch_icon_size',
      'type'       => 'dimensions',
      'title'      => esc_html__('Floating Switch Icon Size', 'darkify'),
      'desc'   => esc_html__('Customize the Selected Switch Icon Size.', 'darkify'),
      'height'  => false,
      'default'  => array(
        'width'    => '50',
      )
    ),
    array(
      'id'         => 'switch_border_radius',
      'type'       => 'spacing',
      'title'      => esc_html__('Border Radius', 'darkify'),
      'desc'   => esc_html__('Set the border radius of the Floating Switch in pixel.', 'darkify'),
      'all'   => true,
      'default' => array(
        'all' => '7',
        'unit'  => 'px',
      )
    ),
    array(
      'id'    => 'switch_light_mode_bg',
      'type'    => 'color',
      'title' => esc_html__('Switch Background on Light Mode', 'darkify'),
      'desc' => esc_html__('Set the background color of the Floating Switch in light mode.', 'darkify'),
      'default' => '#121116',
    ),
    array(
      'id'    => 'switch_dark_mode_bg',
      'type'    => 'color',
      'title' => esc_html__('Switch Background on Dark Mode', 'darkify'),
      'desc' => esc_html__('Set the background color of the Floating Switch in dark mode.', 'darkify'),
      'default' => '#ffffff',
    ),
    array(
      'id'    => 'switch_light_mode_color',
      'type'    => 'color',
      'title' => esc_html__('Switch Icon Color on Light Mode', 'darkify'),
      'desc' => esc_html__('Set the color color of the Floating Switch in light mode.', 'darkify'),
      'default' => '#ffffff',
    ),
    array(
      'id'    => 'switch_dark_mode_color',
      'type'    => 'color',
      'title' => esc_html__('Switch Icon Color on Dark Mode', 'darkify'),
      'desc' => esc_html__('Set the color color of the Floating Switch in dark mode.', 'darkify'),
      'default' => '#121116',
    ),
    )
    )
  );
  DRK::createSection($prefix, array(
    'parent'    => 'control_switch',
    'title'         => esc_html__('Switch Extras', 'darkify'),
    'icon'          => 'fas fa-sun',
    'fields' => array(
    array(
      'type'    => 'heading',
      'content' => esc_html__('Switch Extras', 'darkify'),
    ),

    array(
      'id'          => 'alternative_dark_mode_switcher',
      'type'        => 'text',
      'title'       => esc_html__('Treat an element as switch', 'darkify'),
      'desc'       => esc_html__('Enter comma-separated CSS class or ID selectors to treat them as dark mode switch.', 'darkify'),
    ),

    
        array(
          'id'    => 'switcher_shortcode',
          'type'    => 'switcher_shortcode',
          'title' => esc_html__('Switcher Shortcode', 'darkify'),
          'desc'       => esc_html__('Copy this shortcode and put any page or post to show switcher. You will able to customize all value including swtich 1-12 currently available in this version of plugin.', 'darkify'),
        ),

  )
));


DRK::createSection($prefix, array(
  'id'    => 'colors_fields',
  'title'  => esc_html__('COLOR CONTROL', 'darkify'),
  'icon'   => 'fas fa-palette',
));
DRK::createSection( $prefix, array(
'parent'      => 'colors_fields',
'title'       => esc_html__('Color Customization', 'darkify'),
'icon'        => 'fas fa-paint-brush',
  'fields' => array(
    array(
      'type'    => 'heading',
      'content' => esc_html__('Color Preset', 'darkify'),
    ),
    array(
      'id'      => 'color_pallets',
      'type'    => 'palette',
      'title'   => esc_html__('Choose a preset', 'darkify'),
      'options' => array(
        'set1'  => array( '#0F0F0F', '#BEBEBE', '#2D2D2D', '#4A4A4A', '#2D2D2D' ),
        'set2'  => array( '#092635', '#1B4242', '#5C8374', '#9EC8B9', '#5C8374' ),
        'set4'  => array( '#363062', '#435585', '#818FB4', '#F5E8C7', '#818FB4' ),
        'set5'  => array( '#22092C', '#435585', '#818FB4', '#F5E8C7', '#818FB4' ),
        'set6'  => array( '#352F44', '#5C5470', '#B9B4C7', '#FAF0E6', '#B9B4C7' ),
        'set9'  => array( '#082032', '#2C394B', '#334756', '#FF4C29', '#334756' ),
        'set10'  => array( '#1D2D50', '#133B5C', '#1E5F74', '#FCDAB7', '#1E5F74' ),
        'set11'  => array( '#142850', '#27496D', '#0C7B93', '#00A8CC', '#0C7B93' ),
      ),
      'default' => 'set1',
    ),



    array(
      'type'    => 'heading',
      'content' => esc_html__('Color Customization', 'darkify'),
    ),
        // color pallate set 1
    array(
      'id'    => 'dark_mode_color_set1',
      'type'    => 'color_group',
      'title' => esc_html__('Background', 'darkify'),
      'desc' => esc_html__('Set the background color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set1', 'all'),
      'options'   => array(
        'background' => esc_html__('Background Color', 'darkify'),
        'secondary_background' => esc_html__('Secondary Background', 'darkify'),
      ),
      'default' => array(
        'background' => '#0F0F0F',
        'secondary_background' => '#171717',
      ),
    ),
    array(
      'id'    => 'dark_mode_link_color_set1',
      'type'    => 'color_group',
      'title' => esc_html__('Text', 'darkify'),
      'desc' => esc_html__('Set the text color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set1', 'all'),
      'options'   => array(
        'text' => esc_html__('Text Color', 'darkify'),
      ),
      'default' => array(
        'text' => '#BEBEBE',
        'color' => '#FFFFFF',
        'hover' => '#CCCCCC',
      ),
    ),

    // color pallate set 2

    array(
      'id'    => 'dark_mode_color_set2',
      'type'    => 'color_group',
      'title' => esc_html__('Background', 'darkify'),
      'desc' => esc_html__('Set the background color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set2', 'all'),
      'options'   => array(
        'background' => esc_html__('Background Color', 'darkify'),
        'secondary_background' => esc_html__('Secondary Background', 'darkify'),
      ),
      'default' => array(
        'background' => '#092635',
        'secondary_background' => '#1B4242',
      ),
    ),
    array(
      'id'    => 'dark_mode_link_color_set2',
      'type'    => 'color_group',
      'title' => esc_html__('Text', 'darkify'),
      'desc' => esc_html__('Set the text color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set2', 'all'),
      'options'   => array(
        'text' => esc_html__('Text Color', 'darkify'),
        'color' => esc_html__('Link Color', 'darkify'),
        'hover' => esc_html__('Link Hover Color', 'darkify'),
      ),
      'default' => array(
        'text' => '#9EC8B9',
        'color' => '#FFFFFF',
        'hover' => '#9EC8B9',
      ),
    ),

    array(
      'id'    => 'dark_mode_input_color_set2',
      'type'    => 'color_group',
      'title' => esc_html__('Input', 'darkify'),
      'desc' => esc_html__('Set the input field color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set2', 'all'),
      'options'   => array(
        'color' => esc_html__('Input Text', 'darkify'),
        'placeholder' => esc_html('Input Placeholder', 'darkify'),
        'background' => esc_html('Input Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#092635',
        'placeholder' => '#989898',
        'background' => '#BEBEBE',
      ),
    ),
    
    array(
      'id'    => 'dark_mode_border_color_set2',
      'type'    => 'color',
      'title' => esc_html__('Border', 'darkify'),
      'desc' => esc_html__('Set the border color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set2', 'all'),
      'default' => '#5C8374',
    ),
    array(
      'id'    => 'dark_mode_btn_color_set2',
      'type'    => 'color_group',
      'title' => esc_html__('Button', 'darkify'),
      'desc' => esc_html__('Set the color of buttons of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set2', 'all'),
      'options'   => array(
        'color' => esc_html__('Button Text', 'darkify'),
        'background' => esc_html('Button Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#1B4242',
        'background' => '#BEBEBE',
      ),
    ),


        // color pallate set 4

    array(
      'id'    => 'dark_mode_color_set4',
      'type'    => 'color_group',
      'title' => esc_html__('Background', 'darkify'),
      'desc' => esc_html__('Set the background color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set4', 'all'),
      'options'   => array(
        'background' => esc_html__('Background Color', 'darkify'),
        'secondary_background' => esc_html__('Secondary Background', 'darkify'),
      ),
      'default' => array(
        'background' => '#363062',
        'secondary_background' => '#435585',
      ),
    ),
    array(
      'id'    => 'dark_mode_link_color_set4',
      'type'    => 'color_group',
      'title' => esc_html__('Text', 'darkify'),
      'desc' => esc_html__('Set the text color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set4', 'all'),
      'options'   => array(
        'text' => esc_html__('Text Color', 'darkify'),
        'color' => esc_html__('Link Color', 'darkify'),
        'hover' => esc_html__('Link Hover Color', 'darkify'),
      ),
      'default' => array(
        'text' => '#F5E8C7',
        'color' => '#FFFFFF',
        'hover' => '#F5E8C7',
      ),
    ),

    array(
      'id'    => 'dark_mode_input_color_set4',
      'type'    => 'color_group',
      'title' => esc_html__('Input', 'darkify'),
      'desc' => esc_html__('Set the input field color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set4', 'all'),
      'options'   => array(
        'color' => esc_html__('Input Text', 'darkify'),
        'placeholder' => esc_html('Input Placeholder', 'darkify'),
        'background' => esc_html('Input Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#363062',
        'placeholder' => '#989898',
        'background' => '#BEBEBE',
      ),
    ),
    
    array(
      'id'    => 'dark_mode_border_color_set4',
      'type'    => 'color',
      'title' => esc_html__('Border', 'darkify'),
      'desc' => esc_html__('Set the border color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set4', 'all'),
      'default' => '#818FB4',
    ),
    array(
      'id'    => 'dark_mode_btn_color_set4',
      'type'    => 'color_group',
      'title' => esc_html__('Button', 'darkify'),
      'desc' => esc_html__('Set the color of buttons of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set4', 'all'),
      'options'   => array(
        'color' => esc_html__('Button Text', 'darkify'),
        'background' => esc_html('Button Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#435585',
        'background' => '#BEBEBE',
      ),
    ),

    // color pallate set 5
      
    array(
      'id'    => 'dark_mode_color_set5',
      'type'    => 'color_group',
      'title' => esc_html__('Background', 'darkify'),
      'desc' => esc_html__('Set the background color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set5', 'all'),
      'options'   => array(
        'background' => esc_html__('Background Color', 'darkify'),
        'secondary_background' => esc_html__('Secondary Background', 'darkify'),
      ),
      'default' => array(
        'background' => '#22092C',
        'secondary_background' => '#435585',
      ),
    ),
    array(
      'id'    => 'dark_mode_link_color_set5',
      'type'    => 'color_group',
      'title' => esc_html__('Text', 'darkify'),
      'desc' => esc_html__('Set the text color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set5', 'all'),
      'options'   => array(
        'text' => esc_html__('Text Color', 'darkify'),
        'color' => esc_html__('Link Color', 'darkify'),
        'hover' => esc_html__('Link Hover Color', 'darkify'),
      ),
      'default' => array(
        'text' => '#F5E8C7',
        'color' => '#FFFFFF',
        'hover' => '#F5E8C7',
      ),
    ),

    array(
      'id'    => 'dark_mode_input_color_set5',
      'type'    => 'color_group',
      'title' => esc_html__('Input', 'darkify'),
      'desc' => esc_html__('Set the input field color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set5', 'all'),
      'options'   => array(
        'color' => esc_html__('Input Text', 'darkify'),
        'placeholder' => esc_html('Input Placeholder', 'darkify'),
        'background' => esc_html('Input Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#22092C',
        'placeholder' => '#989898',
        'background' => '#BEBEBE',
      ),
    ),
    
    array(
      'id'    => 'dark_mode_border_color_set5',
      'type'    => 'color',
      'title' => esc_html__('Border', 'darkify'),
      'desc' => esc_html__('Set the border color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set5', 'all'),
      'default' => '#818FB4',
    ),
    array(
      'id'    => 'dark_mode_btn_color_set5',
      'type'    => 'color_group',
      'title' => esc_html__('Button', 'darkify'),
      'desc' => esc_html__('Set the color of buttons of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set5', 'all'),
      'options'   => array(
        'color' => esc_html__('Button Text', 'darkify'),
        'background' => esc_html('Button Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#435585',
        'background' => '#BEBEBE',
      ),
    ),

    // color pallate set 6

    array(
      'id'    => 'dark_mode_color_set6',
      'type'    => 'color_group',
      'title' => esc_html__('Background', 'darkify'),
      'desc' => esc_html__('Set the background color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set6', 'all'),
      'options'   => array(
        'background' => esc_html__('Background Color', 'darkify'),
        'secondary_background' => esc_html__('Secondary Background', 'darkify'),
      ),
      'default' => array(
        'background' => '#352F44',
        'secondary_background' => '#5C5470',
      ),
    ),
    array(
      'id'    => 'dark_mode_link_color_set6',
      'type'    => 'color_group',
      'title' => esc_html__('Text', 'darkify'),
      'desc' => esc_html__('Set the text color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set6', 'all'),
      'options'   => array(
        'text' => esc_html__('Text Color', 'darkify'),
        'color' => esc_html__('Link Color', 'darkify'),
        'hover' => esc_html__('Link Hover Color', 'darkify'),
      ),
      'default' => array(
        'text' => '#FAF0E6',
        'color' => '#FFFFFF',
        'hover' => '#FAF0E6',
      ),
    ),

    array(
      'id'    => 'dark_mode_input_color_set6',
      'type'    => 'color_group',
      'title' => esc_html__('Input', 'darkify'),
      'desc' => esc_html__('Set the input field color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set6', 'all'),
      'options'   => array(
        'color' => esc_html__('Input Text', 'darkify'),
        'placeholder' => esc_html('Input Placeholder', 'darkify'),
        'background' => esc_html('Input Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#352F44',
        'placeholder' => '#989898',
        'background' => '#BEBEBE',
      ),
    ),
    
    array(
      'id'    => 'dark_mode_border_color_set6',
      'type'    => 'color',
      'title' => esc_html__('Border', 'darkify'),
      'desc' => esc_html__('Set the border color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set6', 'all'),
      'default' => '#5C5470',
    ),
    array(
      'id'    => 'dark_mode_btn_color_set6',
      'type'    => 'color_group',
      'title' => esc_html__('Button', 'darkify'),
      'desc' => esc_html__('Set the color of buttons of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set6', 'all'),
      'options'   => array(
        'color' => esc_html__('Button Text', 'darkify'),
        'background' => esc_html('Button Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#5C5470',
        'background' => '#BEBEBE',
      ),
    ),



// color pallate set 9

    array(
      'id'    => 'dark_mode_color_set9',
      'type'    => 'color_group',
      'title' => esc_html__('Background', 'darkify'),
      'desc' => esc_html__('Set the background color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set9', 'all'),
      'options'   => array(
        'background' => esc_html__('Background Color', 'darkify'),
        'secondary_background' => esc_html__('Secondary Background', 'darkify'),
      ),
      'default' => array(
        'background' => '#082032',
        'secondary_background' => '#2C394B',
      ),
    ),
    array(
      'id'    => 'dark_mode_link_color_set9',
      'type'    => 'color_group',
      'title' => esc_html__('Text', 'darkify'),
      'desc' => esc_html__('Set the text color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set9', 'all'),
      'options'   => array(
        'text' => esc_html__('Text Color', 'darkify'),
        'color' => esc_html__('Link Color', 'darkify'),
        'hover' => esc_html__('Link Hover Color', 'darkify'),
      ),
      'default' => array(
        'text' => '#FF4C29',
        'color' => '#FFFFFF',
        'hover' => '#CCCCCC',
      ),
    ),

    array(
      'id'    => 'dark_mode_input_color_set9',
      'type'    => 'color_group',
      'title' => esc_html__('Input', 'darkify'),
      'desc' => esc_html__('Set the input field color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set9', 'all'),
      'options'   => array(
        'color' => esc_html__('Input Text', 'darkify'),
        'placeholder' => esc_html('Input Placeholder', 'darkify'),
        'background' => esc_html('Input Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#334756',
        'placeholder' => '#989898',
        'background' => '#BEBEBE',
      ),
    ),
    
    array(
      'id'    => 'dark_mode_border_color_set9',
      'type'    => 'color',
      'title' => esc_html__('Border', 'darkify'),
      'desc' => esc_html__('Set the border color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set9', 'all'),
      'default' => '#334756',
    ),
    array(
      'id'    => 'dark_mode_btn_color_set9',
      'type'    => 'color_group',
      'title' => esc_html__('Button', 'darkify'),
      'desc' => esc_html__('Set the color of buttons of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set9', 'all'),
      'options'   => array(
        'color' => esc_html__('Button Text', 'darkify'),
        'background' => esc_html('Button Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#2C394B',
        'background' => '#BEBEBE',
      ),
    ),

    // color pallate set 10

    array(
      'id'    => 'dark_mode_color_set10',
      'type'    => 'color_group',
      'title' => esc_html__('Background', 'darkify'),
      'desc' => esc_html__('Set the background color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set10', 'all'),
      'options'   => array(
        'background' => esc_html__('Background Color', 'darkify'),
        'secondary_background' => esc_html__('Secondary Background', 'darkify'),
      ),
      'default' => array(
        'background' => '#1D2D50',
        'secondary_background' => '#133B5C',
      ),
    ),
    array(
      'id'    => 'dark_mode_link_color_set10',
      'type'    => 'color_group',
      'title' => esc_html__('Text', 'darkify'),
      'desc' => esc_html__('Set the text color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set10', 'all'),
      'options'   => array(
        'text' => esc_html__('Text Color', 'darkify'),
        'color' => esc_html__('Link Color', 'darkify'),
        'hover' => esc_html__('Link Hover Color', 'darkify'),
      ),
      'default' => array(
        'text' => '#FCDAB7',
        'color' => '#FFFFFF',
        'hover' => '#FCDAB7',
      ),
    ),

    array(
      'id'    => 'dark_mode_input_color_set10',
      'type'    => 'color_group',
      'title' => esc_html__('Input', 'darkify'),
      'desc' => esc_html__('Set the input field color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set10', 'all'),
      'options'   => array(
        'color' => esc_html__('Input Text', 'darkify'),
        'placeholder' => esc_html('Input Placeholder', 'darkify'),
        'background' => esc_html('Input Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#1E5F74',
        'placeholder' => '#989898',
        'background' => '#BEBEBE',
      ),
    ),
    
    array(
      'id'    => 'dark_mode_border_color_set10',
      'type'    => 'color',
      'title' => esc_html__('Border', 'darkify'),
      'desc' => esc_html__('Set the border color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set10', 'all'),
      'default' => '#1E5F74',
    ),
    array(
      'id'    => 'dark_mode_btn_color_set10',
      'type'    => 'color_group',
      'title' => esc_html__('Button', 'darkify'),
      'desc' => esc_html__('Set the color of buttons of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set10', 'all'),
      'options'   => array(
        'color' => esc_html__('Button Text', 'darkify'),
        'background' => esc_html('Button Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#133B5C',
        'background' => '#BEBEBE',
      ),
    ),

    // color pallate set 11

    array(
      'id'    => 'dark_mode_color_set11',
      'type'    => 'color_group',
      'title' => esc_html__('Background', 'darkify'),
      'desc' => esc_html__('Set the background color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set11', 'all'),
      'options'   => array(
        'background' => esc_html__('Background Color', 'darkify'),
        'secondary_background' => esc_html__('Secondary Background', 'darkify'),
      ),
      'default' => array(
        'background' => '#142850',
        'secondary_background' => '#27496D',
      ),
    ),
    array(
      'id'    => 'dark_mode_link_color_set11',
      'type'    => 'color_group',
      'title' => esc_html__('Text', 'darkify'),
      'desc' => esc_html__('Set the text color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set11', 'all'),
      'options'   => array(
        'text' => esc_html__('Text Color', 'darkify'),
        'color' => esc_html__('Link Color', 'darkify'),
        'hover' => esc_html__('Link Hover Color', 'darkify'),
      ),
      'default' => array(
        'text' => '#00A8CC',
        'color' => '#FFFFFF',
        'hover' => '#00A8CC',
      ),
    ),

    array(
      'id'    => 'dark_mode_input_color_set11',
      'type'    => 'color_group',
      'title' => esc_html__('Input', 'darkify'),
      'desc' => esc_html__('Set the input field color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set11', 'all'),
      'options'   => array(
        'color' => esc_html__('Input Text', 'darkify'),
        'placeholder' => esc_html('Input Placeholder', 'darkify'),
        'background' => esc_html('Input Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#0C7B93',
        'placeholder' => '#989898',
        'background' => '#BEBEBE',
      ),
    ),
    
    array(
      'id'    => 'dark_mode_border_color_set11',
      'type'    => 'color',
      'title' => esc_html__('Border', 'darkify'),
      'desc' => esc_html__('Set the border color of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set11', 'all'),
      'default' => '#0C7B93',
    ),
    array(
      'id'    => 'dark_mode_btn_color_set11',
      'type'    => 'color_group',
      'title' => esc_html__('Button', 'darkify'),
      'desc' => esc_html__('Set the color of buttons of your website when dark mode is enabled.', 'darkify'),
      'dependency' => array('color_pallets', '==', 'set11', 'all'),
      'options'   => array(
        'color' => esc_html__('Button Text', 'darkify'),
        'background' => esc_html('Button Background', 'darkify'),
      ),
      'default' => array(
        'color' => '#27496D',
        'background' => '#BEBEBE',
      ),
    ),

  
    

      )));

    DRK::createSection( $prefix, array(
      'parent'      => 'colors_fields',
      'title'       => esc_html__('Scrollbar Customization', 'darkify'),
      'icon'        => 'fas fa-scroll',
      'fields'      => array(
    array(
      'type'    => 'heading',
      'content' => esc_html__('Scrollbar Customization', 'darkify'),
    ),
    array(
      'id' => 'enable_scrollbar_dark',
      'type'  => 'switcher',
      'title' => esc_html__('Enable Dark Mode on Scrollbar', 'darkify'),
      'desc' => esc_html__('Want to enable dark mode on the scrollbar of the website?', 'darkify'),
      'default' => true,
    ),
  ),

));
DRK::createSection($prefix, array(
  'title'  => esc_html__('IMAGE STYLE', 'darkify'),
  'icon'   => 'fas fa-image',
  'fields' => array(
    // Appearance Control
    array(
      'type'    => 'heading',
      'content' => esc_html__('Appearance Control', 'darkify'),
    ),

    // Low Brightness
    array(
      'id'     => 'brightness',
      'type'   => 'fieldset',
      'title'  => esc_html__('Brightness', 'darkify'),
      'fields' => array(
        array(
          'id' => 'enable_low_image_brightness',
          'type'  => 'switcher',
          'title' => esc_html__('Low Brightness', 'darkify'),
          'desc'  => esc_html__('Switch and select the brightness level of images on dark mode.', 'darkify'),
          'text_on' => esc_html__('Yes', 'darkify'),
          'text_off' => esc_html__('No', 'darkify'),
          'default' => true,
        ),
        array(
          'id' => 'low_image_brightness_label',
          'type'  => 'select',
          'title' => esc_html__('Brightness Label', 'darkify'),
          'options' => array(
            '0' => esc_html('0% Brightness', 'darkify'),
            '10' => esc_html('10% Brightness', 'darkify'),
            '20' => esc_html('20% Brightness', 'darkify'),
            '30' => esc_html('30% Brightness', 'darkify'),
            '40' => esc_html('40% Brightness', 'darkify'),
            '50' => esc_html('50% Brightness', 'darkify'),
            '60' => esc_html('60% Brightness', 'darkify'),
            '70' => esc_html('70% Brightness', 'darkify'),
            '80' => esc_html('80% Brightness', 'darkify'),
            '90' => esc_html('90% Brightness', 'darkify'),
            '100' => esc_html('100% Brightness', 'darkify'),
          ),
          'default'     => '80',
          'dependency' => array('enable_low_image_brightness', '==', 'true', 'all'),
        ),
      ),
    ),
    // Grayscale Image
    array(
      'id'     => 'grayscale',
      'type'   => 'fieldset',
      'title'  => esc_html__('Grayscale', 'darkify'),
      'fields' => array(
        array(
          'id' => 'enable_image_grayscale',
          'type'  => 'switcher',
          'title' => esc_html__('Grayscale Image', 'darkify'),
          'desc'  => esc_html__('Switch and select the grayscale level of images on dark mode.', 'darkify'),
          'text_on' => esc_html__('Yes', 'darkify'),
          'text_off' => esc_html__('No', 'darkify'),
          'default' => false,
        ),
        array(
          'id' => 'image_grayscale_label',
          'type'  => 'select',
          'title' => esc_html__('Grayscale Label', 'darkify'),
          'options' => array(
            '0' => esc_html('0% Brightness', 'darkify'),
            '10' => esc_html('10% Grayscale', 'darkify'),
            '20' => esc_html('20% Grayscale', 'darkify'),
            '30' => esc_html('30% Grayscale', 'darkify'),
            '40' => esc_html('40% Grayscale', 'darkify'),
            '50' => esc_html('50% Grayscale', 'darkify'),
            '60' => esc_html('60% Grayscale', 'darkify'),
            '70' => esc_html('70% Grayscale', 'darkify'),
            '80' => esc_html('80% Grayscale', 'darkify'),
            '90' => esc_html('90% Grayscale', 'darkify'),
            '100' => esc_html('100% Grayscale', 'darkify'),
          ),
          'default'     => '80',
          'dependency' => array('enable_image_grayscale', '==', 'true', 'all'),
        ),

        array(
          'id' => 'disallowed_low_grayscale_images',
          'type'  => 'textarea',
          'title' => esc_html__('Exclude images', 'darkify'),
          'desc'  => esc_html__('Enter comma-separated image URLs where grayscale will be normal.', 'darkify'),
          'placeholder' => esc_html__('Exclude low grayscale on specific images.', 'darkify'),
          'dependency' => array('enable_image_grayscale', '==', 'true', 'all'),
        ),
      ),
    ),

    // Darken Background Image
    array(
      'id'     => 'darken_background',
      'type'   => 'fieldset',
      'title'  => esc_html__('Darken Background', 'darkify'),
      'fields' => array(
        array(
          'id' => 'enable_low_image_darken',
          'type'  => 'switcher',
          'title' => esc_html__('Darken Background Image', 'darkify'),
          'desc'  => esc_html__('Switch and select the level of darkness of background images on dark mode.', 'darkify'),
          'text_on' => esc_html__('Yes', 'darkify'),
          'text_off' => esc_html__('No', 'darkify'),
          'default' => true,
        ),
        array(
          'id' => 'low_image_darken_label',
          'type'  => 'select',
          'title' => esc_html__('Darken Label', 'darkify'),
          'options' => array(
            '0' => esc_html('0% Darken', 'darkify'),
            '10' => esc_html('10% Darken', 'darkify'),
            '20' => esc_html('20% Darken', 'darkify'),
            '30' => esc_html('30% Darken', 'darkify'),
            '40' => esc_html('40% Darken', 'darkify'),
            '50' => esc_html('50% Darken', 'darkify'),
            '60' => esc_html('60% Darken', 'darkify'),
            '70' => esc_html('70% Darken', 'darkify'),
            '80' => esc_html('80% Darken', 'darkify'),
            '90' => esc_html('90% Darken', 'darkify'),
            '100' => esc_html('100% Darken', 'darkify'),
          ),
          'default'     => '80',
          'dependency' => array('enable_low_image_darken', '==', 'true', 'all'),
        ),
      ),
    ),

    array(
      'id' => 'enable_invert_inline_svg',
      'type'  => 'switcher',
      'title' => esc_html__('Invert Inline SVG', 'darkify'),
      'desc'  => esc_html__('Turn On to automatically invert all inline SVG images in dark mode.', 'darkify'),
      'default' => false,
    ),
  )
));
DRK::createSection($prefix, array(
  'title'  => esc_html__('VIDEO STYLE', 'darkify'),
  'icon'   => 'fas fa-play-circle',
  'fields' => array(

    // Appearance Control
    array(
      'type'    => 'heading',
      'content' => esc_html__('Appearance Control', 'darkify'),
    ),


    // Low Brightness
    array(
      'id'     => 'video_brightness',
      'type'   => 'fieldset',
      'title'  => esc_html__('Brightness', 'darkify'),
      'fields' => array(
        array(
          'id' => 'enable_low_video_brightness',
          'type'  => 'switcher',
          'title' => esc_html__('Low Brightness', 'darkify'),
          'desc'  => esc_html__('Switch and select the brightness level of videos on dark mode.', 'darkify'),
          'text_on' => esc_html__('Yes', 'darkify'),
          'text_off' => esc_html__('No', 'darkify'),
          'default' => true,
        ),
        array(
          'id' => 'low_video_brightness_label',
          'type'  => 'select',
          'title' => esc_html__('Brightness Label', 'darkify'),
          'options' => array(
            '0' => esc_html('0% Brightness', 'darkify'),
            '10' => esc_html('10% Brightness', 'darkify'),
            '20' => esc_html('20% Brightness', 'darkify'),
            '30' => esc_html('30% Brightness', 'darkify'),
            '40' => esc_html('40% Brightness', 'darkify'),
            '50' => esc_html('50% Brightness', 'darkify'),
            '60' => esc_html('60% Brightness', 'darkify'),
            '70' => esc_html('70% Brightness', 'darkify'),
            '80' => esc_html('80% Brightness', 'darkify'),
            '90' => esc_html('90% Brightness', 'darkify'),
            '100' => esc_html('100% Brightness', 'darkify'),
          ),
          'default'     => '80',
          'dependency' => array('enable_low_video_brightness', '==', 'true', 'all'),
        ),
      ),
    ),

    // Grayscale Video
    array(
      'id'     => 'video_grayscale',
      'type'   => 'fieldset',
      'title'  => esc_html__('Grayscale', 'darkify'),
      'fields' => array(
        array(
          'id' => 'enable_video_grayscale',
          'type'  => 'switcher',
          'title' => esc_html__('Grayscale Video', 'darkify'),
          'desc'  => esc_html__('Switch and select the grayscale level of videos on dark mode.', 'darkify'),
          'text_on' => esc_html__('Yes', 'darkify'),
          'text_off' => esc_html__('No', 'darkify'),
          'default' => false,
        ),
        array(
          'id' => 'video_grayscale_label',
          'type'  => 'select',
          'title' => esc_html__('Grayscale Label', 'darkify'),
          'options' => array(
            '0' => esc_html('0% Brightness', 'darkify'),
            '10' => esc_html('10% Grayscale', 'darkify'),
            '20' => esc_html('20% Grayscale', 'darkify'),
            '30' => esc_html('30% Grayscale', 'darkify'),
            '40' => esc_html('40% Grayscale', 'darkify'),
            '50' => esc_html('50% Grayscale', 'darkify'),
            '60' => esc_html('60% Grayscale', 'darkify'),
            '70' => esc_html('70% Grayscale', 'darkify'),
            '80' => esc_html('80% Grayscale', 'darkify'),
            '90' => esc_html('90% Grayscale', 'darkify'),
            '100' => esc_html('100% Grayscale', 'darkify'),
          ),
          'default'     => '80',
          'dependency' => array('enable_video_grayscale', '==', 'true', 'all'),
        ),
      ),
    ),
  )
));

DRK::createSection($prefix, array(
  'title'  => esc_html__('BACKUP', 'darkify'),
  'icon'   => 'fas fa-shield-alt',
  'fields' => array(

    // Backup
    array(
      'type' => 'backup',
    ),
  )
));