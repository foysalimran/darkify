<?php
$options = get_option('darkify');
$hide_on_desktop = $options["hide_on_desktop"];
$hide_on_mobile = $options["hide_on_mobile"];
$hide_dark_mode_on_mobile = isset($hide_on_mobile["hide_dark_mode_on_mobile"]) ? $hide_on_mobile["hide_dark_mode_on_mobile"] : 0;
$type_of_hide_by = isset($hide_on_mobile["type_of_hide_by"]) ? $hide_on_mobile["type_of_hide_by"] : 0;
?>
<?php if (!is_admin()) { ?>
    <?php if ($options["enable_dark_mode_switch"]) { ?>
        <?php if (!$this->utils->is_hidden_by_user_agent($hide_on_desktop, $hide_dark_mode_on_mobile, $type_of_hide_by)) { ?>
            <?php include DRK_PATH . "public/templates/views/switch.php"; ?>
        <?php } ?>
    <?php } ?>
<?php } ?>

<style type="text/css" class="darkify_inline_css">
    <?php echo esc_attr($this->utils->parseAndProcessNormalCustomCSS($options["normal_custom_css"])); ?>
</style>

<style type="text/css" class="darkify_inline_css">
    <?php echo esc_attr($this->utils->parseAndProcessCustomCSS($options["custom_css"], $options["disallowed_elements_force_to_correct"])); ?>
</style>

<?php if (!is_admin()) { ?>
    <script type="text/javascript" class="darkify_inline_js">
        document.addEventListener("DOMContentLoaded", function(event) {
            // darkify_init_draggable_floating_switch();
            darkify_init_alternative_dark_mode_switch();
        });
    </script>
<?php } ?>

<?php if (is_admin()) { ?>
    <?php /* Check if block editor is on, then add the dark mode button there */ ?>
    <?php if ($options["enable_admin_panel_dark_mode"]) { ?>
        <?php if (class_exists('WP_Block_Type_Registry')) { ?>
            <?php if (get_current_screen() && 'post' === get_current_screen()->base && ('post' === get_current_screen()->post_type || 'page' === get_current_screen()->post_type)) { ?>
                <script type="text/javascript" class="darkify_inline_js">
                    wp.domReady(function() {
                        const observer = new MutationObserver(function(mutations) {
                            mutations.forEach(function(mutation) {
                                if (mutation.addedNodes && mutation.addedNodes.length) {
                                    for (let i = 0; i < mutation.addedNodes.length; i++) {
                                        const node = mutation.addedNodes[i];
                                        if (node.classList && node.classList.contains('edit-post-header-toolbar')) {
                                            const button = document.createElement('button');
                                            button.className = 'darkify_block_editor_switch darkify_ignore';
                                            button.innerHTML = '<div class="icon"></div>';
                                            button.onclick = function() {
                                                darkify_switch_trigger();
                                            };
                                            node.appendChild(button);
                                            observer.disconnect();
                                            return;
                                        }
                                    }
                                }
                            });
                        });
                        observer.observe(document.body, {
                            childList: true,
                            subtree: true
                        });
                    });
                </script>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>