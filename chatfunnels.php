<?php

/**
 * Plugin Name: Signals
 * Plugin URI:  https://wordpress.org/plugins/chatfunnels/
 * Description: This plugin makes it possible for you to enable your Signals software on your Wordpress site.
 * Version:     1.2
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
require_once(dirname(__FILE__) . '/src/install.php');
require_once(dirname(__FILE__) . '/src/management.php');
require_once(dirname(__FILE__) . '/src/sidebar.php');


add_action('wp_head', 'chatfunnels_header_script');
function chatfunnels_header_script()
{
	$option = get_option('chatfunnels_settings');
	if (empty($option)) {
?>
		<script>
			console.log("It seems that your snippet is not working");
		</script>
	<?php
		return;
	}

	$packet_matches = [];
	$address_matches = [];
	preg_match('/packet_code:[ ]*[\'"]([^\'"]+)[\'"]/', $option, $packet_matches);
	preg_match('/service_address:[ ]*[\'"]([^\\/]+)\\//', $option, $address_matches);
	if (count($packet_matches) < 2 || empty($packet_matches[1]) || count($address_matches) < 2 || empty($address_matches[1])) {
	?>
		<script>
			console.log("Could not launch Signals, missing packet code and/or service address")
		</script>
	<?php
		return;
	}
	$packet_code = $packet_matches[1];
	$service_host = $address_matches[1];
	?>
	<script>
		function cf_chat_loader() {
			return {
				packet_code: '<?php echo esc_js($packet_code); ?>',
				app_url: 'https://<?php echo esc_js($service_host); ?>/chat-client/',
				service_address: '<?php echo esc_js($service_host); ?>/api/chat-service/a'
			}
		}
		(function() {
			let el = document.createElement('script');
			el.async = true;
			el.src = 'https://<?php echo esc_js($service_host); ?>/chat-client/chat-loader.js';
			if (window.document.body) {
				window.document.body.appendChild(el);
			} else {
				window.document.head.appendChild(el);
			}
		}());
	</script>
<?php
}
