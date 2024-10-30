<?php
function chatfunnels_options_page()
{
	$options = get_option('chatfunnels_settings');
?>
	<style type="text/css">
		h1 {
			color: #975ce6
		}

		.instructions {
			font-size: 16px
		}
	</style>
	<div class="wrap">
		<img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'assets/header-logo.png'); ?>" width="150" />
		<div>
			<p class="instructions">
				To get started, paste the Signals installation
				<a href="https://app.chatfunnels.com/#/settings/install" target="_blank">snippet</a>
				into the field below:
			</p>
		</div>
		<form action="options.php" method="post">
			<textarea type="text" class="textField" name="chatfunnels_settings" rows="12" cols="65" placeholder="[ Paste the Signals installation snippet here! ]"><?php echo esc_attr($options); ?></textarea>
			<h4>
				<i>Don't have an installation snippet? Get one from Signals by clicking
					<span>
						<a href="https://app.chatfunnels.com/#/settings/install" target="_blank">here!</a>
					</span>
				</i>
			</h4>
			<?php
			settings_fields('chatfunnels_settings_group');
			do_settings_sections('chatfunnels_settings_group');
			submit_button('Save Settings');
			?>
		</form>
	</div>
<?php
}
