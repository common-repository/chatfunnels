<?php
add_action('admin_menu', 'chatfunnels_option_page');

function chatfunnels_option_page()
{
    add_options_page('Signals Options', 'Signals', 'activate_plugins', basename(__FILE__), 'chatfunnels_options_page');
}
