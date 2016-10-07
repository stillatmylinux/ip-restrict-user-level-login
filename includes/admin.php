<?php

function irull_add_link() {

	global $irull_admin_page;

	$irull_admin_page = add_submenu_page( 'options-general.php', __( 'Restrict User Level Login', 'irull' ), __( 'Restrict Login', 'irull' ), 'manage_options', 'restrict-userlevel', 'irull_admin_page' );

	// add_action( 'admin_head', 'irull_hide_renewal_notice_page' );
}
add_action( 'admin_menu', 'irull_add_link', 10 );

/**
 * Renders the main Licenses admin page
 *
 * @access      private
 * @since       1.0
 * @return      void
*/
function irull_admin_page() {

	?>
	<div class="wrap">

		<div id="icon-edit" class="icon32"><br/></div>
		<h2><?php _e( 'Restricted User Level Login', 'irull' ); ?></h2>
		
			
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-1">
				<div id="postbox-container-1" class="postbox-container">
					<div class="postbox">
						<h3 class="hndle">
							<span>IP Addresses</span>
						</h3>
						
						<form method="post">
							<div class="inside">
								<p><?php _e( 'Description', 'irull' ); ?></p>
								<p>
									<input type="text" name="ip_address"  value=""/>
									<span class="description"><?php _e( 'IP addresses separated by commas: 192.168.1.10,192.168.1.40', 'irull' ); ?></span>
								</p>
								<p>
									<?php wp_nonce_field( 'irull_add_ip_nonce', 'irull_add_ip_nonce' ); ?>
									
									
									<input type="submit" class="button-primary button" value="<?php _e( 'Add IP Address', 'irull' ); ?>"/>
								</p>
							</div>
						</form>
					</div>
				</div>
				<div id="postbox-container-1" class="postbox-container">
					<div class="postbox">
						<h3 class="hndle">
							<span>User Levels</span>
						</h3>
						
						<form method="post">
							<div class="inside">
								<p><?php _e( 'Description', 'irull' ); ?></p>
								<p>
									<input type="text" name="ip_address"  value=""/>
									<span class="description"><?php _e( 'Enter User Level', 'irull' ); ?></span>
								</p>
								<p>
									<?php wp_nonce_field( 'irull_add_ip_nonce', 'irull_add_ip_nonce' ); ?>
									
									<input type="submit" class="button-primary button" value="<?php _e( 'User Level', 'irull' ); ?>"/>
								</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
	<?php /*

	// $redirect = get_transient( '_irull_bulk_actions_redirect' );

	if( false !== $redirect ) : delete_transient( '_irull_bulk_actions_redirect' ) ?>
	<script type="text/javascript">
	// window.location = "<?php echo admin_url( 'edit.php?post_type=download&page=edd-licenses' ); ?>";
	</script>
	<?php endif; */
}
