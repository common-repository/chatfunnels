<?php

// Install: Register CF's settings
function chatunnels_install()
{
    register_setting('chatfunnels_settings_group', 'chatfunnels_settings');
}

add_action('admin_init', 'chatunnels_install');
