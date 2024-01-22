<?php


if ( ! class_exists( 'DarkifyExternalSupport' ) ) {
    class DarkifyExternalSupport
    {

        public $base_admin;
        public function __construct($base_admin)
        {
            $this->base_admin = $base_admin;
        }

        /* =============== Default Darkify Ignore =============== */
        public function getDisallowedElementsByDarkify(){
            return array(
                ".darkify_ignore",
                ".darkify_ignore *",
                ".darkify_switch",
                ".darkify_switch *",
            );
        }

        /* =============== Logged-in as Admin =============== */
        public function getDisallowedElementsByAdminLogin(){
            return array(
                "#wpadminbar",
                "#wpadminbar *",
            );
        }

        /* =============== Is in Admin Panel =============== */
        public function getDisallowedElementsByAdminPanel(){
            return array(
                "#adminmenumain",
                "#adminmenumain *",
                ".wp-core-ui .button-primary",
                ".wp-core-ui .button-primary *",
                ".post-com-count-approved",
                ".post-com-count-approved *",
                ".drk--switcher",
                ".drk--switcher *",
                ".CodeMirror",
                ".CodeMirror *",
                ".wp-picker-container",
                ".wp-picker-container *",
                ".drk--sibling.drk--image",
                ".drk--sibling.drk--image *",
                ".button",
            );
        }


        /* =============== Elementor =============== */
        public function getDisallowedElementsByElementor(){
            return array(
                ".elementor-background-overlay",
                ".elementor-element-overlay",
                ".elementor-button-link",
                ".elementor-button-link *",
                ".elementor-widget-spacer",
                ".elementor-widget-spacer *",
            );
        }



        /* =============== Beaver Builder =============== */
        public function getDisallowedElementsByBeaver(){
            return array(
                ".uabb-button",
                ".uabb-button *",
            );
        }


        /* =============== Block Editor =============== */
        public function getDisallowedElementsByBlockEditor(){
            return array(
                ".wp-block-button__link",
                ".wp-block-button__link *",
            );
        }

        /* =============== Slider Revolution =============== */
        public function getDisallowedElementsByRevSlider(){
            return array(
                "rs-fullwidth-wrap",
                "rs-fullwidth-wrap *",
            );
        }

        /* =============== OneSignal Push Notifications =============== */
        public function getDisallowedElementsByOneSignal(){
            return array(
                ".onesignal-slidedown-dialog",
                ".onesignal-slidedown-dialog *",
            );
        }

        /* =============== Read Meter =============== */
        public function getDisallowedElementsByReadMeter(){
            return array(
                "#bsf_rt_progress_bar_container",
                "#bsf_rt_progress_bar_container *",
            );
        }

    }
}
