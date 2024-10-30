<?php

// Uninstall: Uninstall the settings for CF
function chatfunnels_uninstall()
{
    delete_option('chatfunnels_settings');
}

register_uninstall_hook(__FILE__, 'chatfunnels_uninstall');
