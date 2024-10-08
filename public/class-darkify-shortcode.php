<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('DarkifyShortcodeParser')) {
    class DarkifyShortcodeParser
    {

        public $base_client;

        public function __construct($base_client)
        {
            $this->base_client = $base_client;

            add_shortcode('darkify', array($this, 'darkify_shortcode_parser'));
        }


        public function darkify_shortcode_parser($atts, $content = null)
        {
            if (!isset($atts['switch'])) {
                $atts = array();
                $atts['switch'] = '1';
            }

            return $this->darkify_client_view_maker($atts);
        }
        public function darkify_client_view_maker($atts)
        {
            if ( function_exists( 'wp_rand' ) ) {
                $unique_id = wp_rand() . "_shortcode";
            }
            $switch_styles = $this->base_client->utils->generateSwitchStylesForShortcode($atts);
            ob_start(); ?>

            <?php if (sizeof($switch_styles) > 0) { ?>
                <style type="text/css">
                    #darkify_switch_<?php echo esc_attr($unique_id); ?> {
                        <?php foreach ($switch_styles as $key => $value) { ?><?php echo esc_attr($key); ?>: <?php echo esc_attr($value); ?>;
                        <?php } ?>
                    }
                </style>

            <?php } ?>

            <?php if ($atts['switch'] == "1") {
                wp_enqueue_style( 'theme-classic' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style" style="position: relative;">
                    <div class="theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" fill="currentColor" stroke-linecap="round" class="theme-toggle__classic" viewBox="0 0 32 32">
                            <clipPath id="theme-toggle__classic__cutout">
                                <path d="M0-5h30a1 1 0 0 0 9 13v24H0Z" />
                            </clipPath>
                            <g clip-path="url(#theme-toggle__classic__cutout)">
                                <circle cx="16" cy="16" r="9.34" />
                                <g stroke="currentColor" stroke-width="1.5">
                                    <path d="M16 5.5v-4" />
                                    <path d="M16 30.5v-4" />
                                    <path d="M1.5 16h4" />
                                    <path d="M26.5 16h4" />
                                    <path d="m23.4 8.6 2.8-2.8" />
                                    <path d="m5.7 26.3 2.9-2.9" />
                                    <path d="m5.8 5.8 2.8 2.8" />
                                    <path d="m23.4 23.4 2.9 2.9" />
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            <?php } ?>
            <?php if ($atts['switch'] == "2") {
                wp_enqueue_style( 'theme-inner-moon' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" fill="currentColor" class="theme-toggle__inner-moon" viewBox="0 0 32 32">
                <path d="M27.5 11.5v-7h-7L16 0l-4.5 4.5h-7v7L0 16l4.5 4.5v7h7L16 32l4.5-4.5h7v-7L32 16l-4.5-4.5zM16 25.4a9.39 9.39 0 1 1 0-18.8 9.39 9.39 0 1 1 0 18.8z" />
                <circle cx="16" cy="16" r="8.1" />
            </svg>
        </div>
      
    </div>
            <?php } ?>
            <?php if ($atts['switch'] == "3") {
                wp_enqueue_style( 'theme-expand' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" fill="currentColor" class="theme-toggle__expand" viewBox="0 0 32 32">
                <clipPath id="theme-toggle__expand__cutout">
                    <path d="M0-11h25a1 1 0 0017 13v30H0Z" />
                </clipPath>
                <g clip-path="url(#theme-toggle__expand__cutout)">
                    <circle cx="16" cy="16" r="8.4" />
                    <path d="M18.3 3.2c0 1.3-1 2.3-2.3 2.3s-2.3-1-2.3-2.3S14.7.9 16 .9s2.3 1 2.3 2.3zm-4.6 25.6c0-1.3 1-2.3 2.3-2.3s2.3 1 2.3 2.3-1 2.3-2.3 2.3-2.3-1-2.3-2.3zm15.1-10.5c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zM3.2 13.7c1.3 0 2.3 1 2.3 2.3s-1 2.3-2.3 2.3S.9 17.3.9 16s1-2.3 2.3-2.3zm5.8-7C9 7.9 7.9 9 6.7 9S4.4 8 4.4 6.7s1-2.3 2.3-2.3S9 5.4 9 6.7zm16.3 21c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zm2.4-21c0 1.3-1 2.3-2.3 2.3S23 7.9 23 6.7s1-2.3 2.3-2.3 2.4 1 2.4 2.3zM6.7 23C8 23 9 24 9 25.3s-1 2.3-2.3 2.3-2.3-1-2.3-2.3 1-2.3 2.3-2.3z" />
                </g>
            </svg>
        </div>
    </div>

            <?php } ?>
            <?php if ($atts['switch'] == "4") {
                wp_enqueue_style( 'theme-within' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="theme-toggle__within" height="1em" width="1em" viewBox="0 0 32 32" fill="currentColor">
                <clipPath id="theme-toggle__within__clip">
                    <path d="M0 0h32v32h-32ZM6 16A1 1 0 0026 16 1 1 0 006 16" />
                </clipPath>
                <g clip-path="url(#theme-toggle__within__clip)">
                    <path d="M30.7 21.3 27.1 16l3.7-5.3c.4-.5.1-1.3-.6-1.4l-6.3-1.1-1.1-6.3c-.1-.6-.8-.9-1.4-.6L16 5l-5.4-3.7c-.5-.4-1.3-.1-1.4.6l-1 6.3-6.4 1.1c-.6.1-.9.9-.6 1.3L4.9 16l-3.7 5.3c-.4.5-.1 1.3.6 1.4l6.3 1.1 1.1 6.3c.1.6.8.9 1.4.6l5.3-3.7 5.3 3.7c.5.4 1.3.1 1.4-.6l1.1-6.3 6.3-1.1c.8-.1 1.1-.8.7-1.4zM16 25.1c-5.1 0-9.1-4.1-9.1-9.1 0-5.1 4.1-9.1 9.1-9.1s9.1 4.1 9.1 9.1c0 5.1-4 9.1-9.1 9.1z" />
                </g>
                <path class="theme-toggle__within__circle" d="M16 7.7c-4.6 0-8.2 3.7-8.2 8.2s3.6 8.4 8.2 8.4 8.2-3.7 8.2-8.2-3.6-8.4-8.2-8.4zm0 14.4c-3.4 0-6.1-2.9-6.1-6.2s2.7-6.1 6.1-6.1c3.4 0 6.1 2.9 6.1 6.2s-2.7 6.1-6.1 6.1z" />
                <path class="theme-toggle__within__inner" d="M16 9.5c-3.6 0-6.4 2.9-6.4 6.4s2.8 6.5 6.4 6.5 6.4-2.9 6.4-6.4-2.8-6.5-6.4-6.5z" />
            </svg>
        </div>

    </div>
            <?php } ?>
            <?php if ($atts['switch'] == "5") {
                wp_enqueue_style( 'theme-around' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" fill="currentColor" class="theme-toggle__around" viewBox="0 0 32 32">
                <clipPath id="theme-toggle__around__cutout">
                    <path d="M0 0h42v30a1 1 0 00-16 13H0Z" />
                </clipPath>
                <g clip-path="url(#theme-toggle__around__cutout)">
                    <circle cx="16" cy="16" r="8.4" />
                    <g>
                        <circle cx="16" cy="3.3" r="2.3" />
                        <circle cx="27" cy="9.7" r="2.3" />
                        <circle cx="27" cy="22.3" r="2.3" />
                        <circle cx="16" cy="28.7" r="2.3" />
                        <circle cx="5" cy="22.3" r="2.3" />
                        <circle cx="5" cy="9.7" r="2.3" />
                    </g>
                </g>
            </svg>
        </div>
        
    </div>
            <?php } ?>
            <?php if ($atts['switch'] == "6") {
                 wp_enqueue_style( 'theme-dark-side' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" class="theme-toggle__dark-side" fill="currentColor" viewBox="0 0 32 32">
                <path d="M16 .5C7.4.5.5 7.4.5 16S7.4 31.5 16 31.5 31.5 24.6 31.5 16 24.6.5 16 .5zm0 28.1V3.4C23 3.4 28.6 9 28.6 16S23 28.6 16 28.6z" />
            </svg>
        </div>

    </div>
            <?php } ?>
            <?php if ($atts['switch'] == "7") {
                wp_enqueue_style( 'theme-horizon' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" fill="currentColor" class="theme-toggle__horizon" viewBox="0 0 32 32">
                <clipPath id="theme-toggle__horizon__mask">
                    <path d="M0 0h32v29h-32z" />
                </clipPath>
                <path d="M30.7 29.9H1.3c-.7 0-1.3.5-1.3 1.1 0 .6.6 1 1.3 1h29.3c.7 0 1.3-.5 1.3-1.1.1-.5-.5-1-1.2-1z" />
                <g clip-path="url(#theme-toggle__horizon__mask)">
                    <path d="M16 8.8c-3.4 0-6.1 2.8-6.1 6.1s2.7 6.3 6.1 6.3 6.1-2.8 6.1-6.1-2.7-6.3-6.1-6.3zm13.3 11L26 15l3.3-4.8c.3-.5.1-1.1-.5-1.2l-5.7-1-1-5.7c-.1-.6-.8-.8-1.2-.5L16 5.1l-4.8-3.3c-.5-.4-1.2-.1-1.3.4L8.9 8 3.2 9c-.6.1-.8.8-.5 1.2L6 15l-3.3 4.8c-.3.5-.1 1.1.5 1.2l5.7 1 1 5.7c.1.6.8.8 1.2.5L16 25l4.8 3.3c.5.3 1.1.1 1.2-.5l1-5.7 5.7-1c.7-.1.9-.8.6-1.3zM16 22.5A7.6 7.6 0 0 1 8.3 15c0-4.2 3.5-7.5 7.7-7.5s7.7 3.4 7.7 7.5c0 4.2-3.4 7.5-7.7 7.5z" />
                </g>
            </svg>
        </div>

    </div>
            <?php } ?>
            <?php if ($atts['switch'] == "8") {
                wp_enqueue_style( 'theme-eclipse' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" class="theme-toggle__eclipse" fill="currentColor" viewBox="0 0 32 32">
                <clipPath id="theme-toggle__eclipse__cutout">
                    <path d="M0 0h64v32h-64zm36 16a1 1 0 0024 1 1 1 0 00-24-1" />
                </clipPath>
                <g clip-path="url(#theme-toggle__eclipse__cutout)">
                    <circle cx="16" cy="16" r="16" />
                </g>
            </svg>
        </div>
    </div>
            <?php } ?>
            <?php if ($atts['switch'] == "9") {
                wp_enqueue_style( 'theme-lightbulb' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" class="theme-toggle__lightbulb" stroke-width="0.7" stroke="currentColor" fill="currentColor" stroke-linecap="round" viewBox="0 0 32 32">
                <path stroke-width="0" d="M9.4 9.9c1.8-1.8 4.1-2.7 6.6-2.7 5.1 0 9.3 4.2 9.3 9.3 0 2.3-.8 4.4-2.3 6.1-.7.8-2 2.8-2.5 4.4 0 .2-.2.4-.5.4-.2 0-.4-.2-.4-.5v-.1c.5-1.8 2-3.9 2.7-4.8 1.4-1.5 2.1-3.5 2.1-5.6 0-4.7-3.7-8.5-8.4-8.5-2.3 0-4.4.9-5.9 2.5-1.6 1.6-2.5 3.7-2.5 6 0 2.1.7 4 2.1 5.6.8.9 2.2 2.9 2.7 4.9 0 .2-.1.5-.4.5h-.1c-.2 0-.4-.1-.4-.4-.5-1.7-1.8-3.7-2.5-4.5-1.5-1.7-2.3-3.9-2.3-6.1 0-2.3 1-4.7 2.7-6.5z" />
                <path d="M19.8 28.3h-7.6" />
                <path d="M19.8 29.5h-7.6" />
                <path d="M19.8 30.7h-7.6" />
                <path pathLength="1" class="theme-toggle__lightbulb__coil" fill="none" d="M14.6 27.1c0-3.4 0-6.8-.1-10.2-.2-1-1.1-1.7-2-1.7-1.2-.1-2.3 1-2.2 2.3.1 1 .9 1.9 2.1 2h7.2c1.1-.1 2-1 2.1-2 .1-1.2-1-2.3-2.2-2.3-.9 0-1.7.7-2 1.7 0 3.4 0 6.8-.1 10.2" />
                <g class="theme-toggle__lightbulb__rays">
                    <path pathLength="1" d="M16 6.4V1.3" />
                    <path pathLength="1" d="M26.3 15.8h5.1" />
                    <path pathLength="1" d="m22.6 9 3.7-3.6" />
                    <path pathLength="1" d="M9.4 9 5.7 5.4" />
                    <path pathLength="1" d="M5.7 15.8H.6" />
                </g>
            </svg>
        </div>

    </div>

    <?php } ?>
    <?php if ($atts['switch'] == "10") {
                wp_enqueue_style( 'theme-dark-inner' );
                ?>
<div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" class="theme-toggle__dark-inner" fill="currentColor" viewBox="0 0 32 32">
                <path d="M16 9c3.9 0 7 3.1 7 7s-3.1 7-7 7" />
                <path d="M16 .5C7.4.5.5 7.4.5 16S7.4 31.5 16 31.5 31.5 24.6 31.5 16 24.6.5 16 .5zm0 28.1V23c-3.9 0-7-3.1-7-7s3.1-7 7-7V3.4C23 3.4 28.6 9 28.6 16S23 28.6 16 28.6z" />
            </svg>
        </div>

    </div>
    <?php } ?>
<?php if ($atts['switch'] == "11") {
                wp_enqueue_style( 'theme-half-sun' );
                ?>
 <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="theme-toggle__half-sun" height="1em" width="1em" viewBox="0 0 32 32" fill="currentColor">
                <path d="M27.5 11.5v-7h-7L16 0l-4.5 4.5h-7v7L0 16l4.5 4.5v7h7L16 32l4.5-4.5h7v-7L32 16l-4.5-4.5zM16 25.4V6.6c5.2 0 9.4 4.2 9.4 9.4s-4.2 9.4-9.4 9.4z" />
            </svg>
        </div>
       
    </div>


    <?php } ?>
    <?php if ($atts['switch'] == "12") {
                wp_enqueue_style( 'theme-simple' );
                ?>
                <div id="darkify_switch_<?php echo esc_attr($unique_id); ?>" onclick="darkify_switch_trigger()" class="darkify_switch darkify_switch_style">
        <div class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="50px" height="50px" class="theme-toggle__simple" fill="currentColor" viewBox="0 0 32 32">
                <clipPath id="theme-toggle__simple__cutout">
                    <path d="M0-5h55v37h-55zm32 12a1 1 0 0025 0 1 1 0 00-25 0" />
                </clipPath>
                <g clip-path="url(#theme-toggle__simple__cutout)">
                    <circle cx="16" cy="16" r="15" />
                </g>
            </svg>
        </div>

    </div>
            <?php } ?>

<?php return ob_get_clean();
        }
    }
}
