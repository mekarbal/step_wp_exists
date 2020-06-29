<?php
/**
 * Add theme dashboard page
 */

/**
 * Get theme actions required
 *
 * @return array|mixed|void
 */
function envo_business_get_actions_required() {

	$actions						 = array();
	$front_page						 = get_option( 'page_on_front' );
	$actions[ 'page_on_front' ]		 = 'dismiss';
	$actions[ 'page_template' ]		 = 'dismiss';
	$actions[ 'recommend_plugins' ]	 = 'dismiss';
	if ( 'page' != get_option( 'show_on_front' ) ) {
		$front_page = 0;
	}
	if ( $front_page <= 0 ) {
		$actions[ 'page_on_front' ]	 = 'active';
		$actions[ 'page_template' ]	 = 'active';
	} else {
		if ( get_post_meta( $front_page, '_wp_page_template', true ) == 'template-parts/template-homepage.php' ) {
			$actions[ 'page_template' ] = 'dismiss';
		} else {
			$actions[ 'page_template' ] = 'active';
		}
	}

	$recommend_plugins = get_theme_support( 'recommend-plugins' );
	if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[ 0 ] ) ) {
		$recommend_plugins = $recommend_plugins[ 0 ];
	} else {
		$recommend_plugins[] = array();
	}

	if ( !empty( $recommend_plugins ) ) {

		foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
			$plugin_info = wp_parse_args( $plugin_info, array(
				'name'				 => '',
				'active_filename'	 => '',
			) );
			if ( $plugin_info[ 'active_filename' ] ) {
				$active_file_name = $plugin_info[ 'active_filename' ];
			} else {
				$active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
			}
			if ( !is_plugin_active( $active_file_name ) ) {
				$actions[ 'recommend_plugins' ] = 'active';
			}
		}
	}

	$actions		 = apply_filters( 'envo_business_get_actions_required', $actions );
	$hide_by_click	 = get_option( 'envo_business_actions_dismiss' );
	if ( !is_array( $hide_by_click ) ) {
		$hide_by_click = array();
	}

	$n_active		 = $n_dismiss		 = 0;
	$number_notice	 = 0;
	foreach ( $actions as $k => $v ) {
		if ( !isset( $hide_by_click[ $k ] ) ) {
			$hide_by_click[ $k ] = false;
		}

		if ( $v == 'active' ) {
			$n_active ++;
			$number_notice ++;
			if ( $hide_by_click[ $k ] ) {
				if ( $hide_by_click[ $k ] == 'hide' ) {
					$number_notice --;
				}
			}
		} else if ( $v == 'dismiss' ) {
			$n_dismiss ++;
		}
	}

	$return = array(
		'actions'		 => $actions,
		'number_actions' => count( $actions ),
		'number_active'	 => $n_active,
		'number_dismiss' => $n_dismiss,
		'hide_by_click'	 => $hide_by_click,
		'number_notice'	 => $number_notice,
	);
	if ( $return[ 'number_notice' ] < 0 ) {
		$return[ 'number_notice' ] = 0;
	}

	return $return;
}

add_action( 'switch_theme', 'envo_business_reset_actions_required' );

function envo_business_reset_actions_required() {
	delete_option( 'envo_business_actions_dismiss' );
}

if ( !function_exists( 'envo_business_admin_scripts' ) ) :

	/**
	 * Enqueue scripts for admin page only: Theme info page
	 */
	function envo_business_admin_scripts( $hook ) {
		if ( $hook === 'appearance_page_et_envo-business' ) {
			wp_enqueue_style( 'envo-business-admin-css', get_template_directory_uri() . '/css/admin.css' );
			// Add recommend plugin css
			wp_enqueue_style( 'plugin-install' );
			wp_enqueue_script( 'plugin-install' );
			wp_enqueue_script( 'updates' );
			add_thickbox();
		}
	}

endif;
add_action( 'admin_enqueue_scripts', 'envo_business_admin_scripts' );

add_action( 'admin_menu', 'envo_business_theme_info' );

function envo_business_theme_info() {

	$actions		 = envo_business_get_actions_required();
	$number_count	 = $actions[ 'number_notice' ];

	if ( $number_count > 0 ) {
		/* translators: %1$s: replaced with number (counter) */
		$update_label	 = sprintf( _n( '%1$s action required', '%1$s actions required', $number_count, 'envo-business' ), $number_count );
		$count			 = "<span class='update-plugins count-" . esc_attr( $number_count ) . "' title='" . esc_attr( $update_label ) . "'><span class='update-count'>" . number_format_i18n( $number_count ) . "</span></span>";
		/* translators: %s: replaced with number (counter) */
		$menu_title		 = sprintf( esc_html__( 'Envo Business theme %s', 'envo-business' ), $count );
	} else {
		$menu_title = esc_html__( 'Envo Business theme', 'envo-business' );
	}

	add_theme_page( esc_html__( 'Envo Business dashboard', 'envo-business' ), $menu_title, 'edit_theme_options', 'et_envo-business', 'envo_business_theme_info_page' );
}

/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
function envo_business_admin_notice() {
	if ( !function_exists( 'envo_business_get_actions_required' ) ) {
		return false;
	}
	// $actions = envo_business_get_actions_required();
	// $number_action = $actions['number_notice'];
	// if ( $number_action > 0 ) {
	$theme_data = wp_get_theme();
	?>
	<div class="updated notice notice-success eb-notice is-dismissible">
		<p>
			<?php
			/* translators: %1$s: theme name, %2$s link */
			printf( __( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'envo-business' ), $theme_data->Name, esc_url( admin_url( 'themes.php?page=et_envo-business' ) ) );
			?>
		</p>
		<p>
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=et_envo-business' ) ) ?>" class="button" style="text-decoration: none;">
				<?php
				/* translators: %s theme name */
				printf( esc_html__( 'Get started with %s', 'envo-business' ), $theme_data->Name )
				?>
			</a>
		</p>
	</div>
	<div class="updated notice notice-success notice-alt is-dismissible">
		<p>
			<?php esc_html_e( 'Save time by importing our demo data: your website will be set up and ready to be customized in minutes.', 'envo-business' ); ?>
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=et_envo-business&tab=import_data' ) ) ?>" class="button" style="text-decoration: none;">
				<?php esc_html_e( 'Import demo data', 'envo-business' ); ?>
			</a>
		</p>
	</div>
	<?php
	// }
}

function envo_business_one_activation_admin_notice() {
	global $pagenow;
	if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET[ 'activated' ] ) ) {
		add_action( 'admin_notices', 'envo_business_admin_notice' );
	}
}

function envo_business_render_recommend_plugins( $recommend_plugins = array() ) {
	foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
		$plugin_info	 = wp_parse_args( $plugin_info, array(
			'name'				 => '',
			'active_filename'	 => '',
			'description'		 => '',
		) );
		$plugin_name	 = $plugin_info[ 'name' ];
		$plugin_desc	 = $plugin_info[ 'description' ];
		$status			 = is_dir( WP_PLUGIN_DIR . '/' . $plugin_slug );
		$button_class	 = 'install-now button';
		if ( $plugin_info[ 'active_filename' ] ) {
			$active_file_name = $plugin_info[ 'active_filename' ];
		} else {
			$active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
		}

		if ( !is_plugin_active( $active_file_name ) ) {
			$button_txt = esc_html__( 'Install Now', 'envo-business' );
			if ( !$status ) {
				$install_url = wp_nonce_url(
				add_query_arg(
				array(
					'action' => 'install-plugin',
					'plugin' => $plugin_slug
				), network_admin_url( 'update.php' )
				), 'install-plugin_' . $plugin_slug
				);
			} else {
				$install_url	 = add_query_arg( array(
					'action'		 => 'activate',
					'plugin'		 => rawurlencode( $active_file_name ),
					'plugin_status'	 => 'all',
					'paged'			 => '1',
					'_wpnonce'		 => wp_create_nonce( 'activate-plugin_' . $active_file_name ),
				), network_admin_url( 'plugins.php' ) );
				$button_class	 = 'activate-now button-primary';
				$button_txt		 = esc_html__( 'Activate', 'envo-business' );
			}

			$detail_link = add_query_arg(
			array(
				'tab'		 => 'plugin-information',
				'plugin'	 => $plugin_slug,
				'TB_iframe'	 => 'true',
				'width'		 => '772',
				'height'	 => '349',
			), network_admin_url( 'plugin-install.php' )
			);

			echo '<div class="rcp">';
			echo '<h4 class="rcp-name">';
			echo esc_html( $plugin_name );
			echo '</h4>';
			echo '<p class="rcp-desc">';
			echo $plugin_desc;
			echo '</p>';
			echo '<p class="action-btn plugin-card-' . esc_attr( $plugin_slug ) . '"><a href="' . esc_url( $install_url ) . '" data-slug="' . esc_attr( $plugin_slug ) . '" class="' . esc_attr( $button_class ) . '">' . $button_txt . '</a></p>';
			echo '<a class="plugin-detail thickbox open-plugin-details-modal" href="' . esc_url( $detail_link ) . '">' . esc_html__( 'Details', 'envo-business' ) . '</a>';
			echo '</div>';
		}
	}
}

function envo_business_admin_dismiss_actions() {
	// Action for dismiss
	if ( isset( $_GET[ 'envo_business_action_notice' ] ) ) {
		$actions_dismiss = get_option( 'envo_business_actions_dismiss' );
		if ( !is_array( $actions_dismiss ) ) {
			$actions_dismiss = array();
		}
		$action_key = stripslashes( $_GET[ 'envo_business_action_notice' ] );
		if ( isset( $actions_dismiss[ $action_key ] ) && $actions_dismiss[ $action_key ] == 'hide' ) {
			$actions_dismiss[ $action_key ] = 'show';
		} else {
			$actions_dismiss[ $action_key ] = 'hide';
		}
		update_option( 'envo_business_actions_dismiss', $actions_dismiss );
		$url = $_SERVER[ 'REQUEST_URI' ];
		$url = remove_query_arg( 'envo_business_action_notice', $url );
		wp_redirect( $url );
		die();
	}

	// Action for copy options
	if ( isset( $_POST[ 'copy_from' ] ) && isset( $_POST[ 'copy_to' ] ) ) {
		$from	 = sanitize_text_field( $_POST[ 'copy_from' ] );
		$to		 = sanitize_text_field( $_POST[ 'copy_to' ] );
		if ( $from && $to ) {
			$mods = get_option( "theme_mods_" . $from );
			update_option( "theme_mods_" . $to, $mods );

			$url = $_SERVER[ 'REQUEST_URI' ];
			$url = add_query_arg( array( 'copied' => 1 ), $url );
			wp_redirect( $url );
			die();
		}
	}
}

add_action( 'admin_init', 'envo_business_admin_dismiss_actions' );


/* activation notice */
add_action( 'load-themes.php', 'envo_business_one_activation_admin_notice' );

function envo_business_theme_info_page() {

	$theme_data = wp_get_theme( 'envo-business' );

	if ( isset( $_GET[ 'envo_business_action_dismiss' ] ) ) {
		$actions_dismiss = get_option( 'envo_business_actions_dismiss' );
		if ( !is_array( $actions_dismiss ) ) {
			$actions_dismiss = array();
		}
		$actions_dismiss[ stripslashes( $_GET[ 'envo_business_action_dismiss' ] ) ] = 'dismiss';
		update_option( 'envo_business_actions_dismiss', $actions_dismiss );
	}

	// Check for current viewing tab
	$tab = null;
	if ( isset( $_GET[ 'tab' ] ) ) {
		$tab = $_GET[ 'tab' ];
	} else {
		$tab = null;
	}

	$actions_r		 = envo_business_get_actions_required();
	$number_action	 = $actions_r[ 'number_notice' ];
	$actions		 = $actions_r[ 'actions' ];

	$current_action_link = admin_url( 'themes.php?page=et_envo-business&tab=actions_required' );

	$recommend_plugins = get_theme_support( 'recommend-plugins' );
	if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[ 0 ] ) ) {
		$recommend_plugins = $recommend_plugins[ 0 ];
	} else {
		$recommend_plugins[] = array();
	}
	?>
	<div class="wrap about-wrap theme_info_wrapper">
		<h1>
			<?php
			/* translators: %1$s theme name, %2$s theme version */
			printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'envo-business' ), $theme_data->Name, $theme_data->Version );
			?>
		</h1>
		<div class="about-text"><?php echo $theme_data->Description; ?></div>
		<h2 class="nav-tab-wrapper">
			<a href="?page=et_envo-business" class="nav-tab<?php echo is_null( $tab ) ? ' nav-tab-active' : null; ?>"><?php echo $theme_data->Name; ?></a>
			<a href="?page=et_envo-business&tab=actions_required" class="nav-tab<?php echo $tab == 'actions_required' ? ' nav-tab-active' : null; ?>"><?php
				esc_html_e( 'Recommended Actions', 'envo-business' );
				echo ( $number_action > 0 ) ? "<span class='theme-action-count'>{$number_action}</span>" : '';
				?>
      </a>
			<a href="?page=et_envo-business&tab=useful_plugins" class="nav-tab<?php echo $tab == 'useful_plugins' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Useful Plugins', 'envo-business' ) ?></a>
			<a href="?page=et_envo-business&tab=import_data" class="nav-tab<?php echo $tab == 'import_data' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'One Click Demo Import', 'envo-business' ) ?></a>
			<?php do_action( 'envo_business_admin_more_tabs' ); ?>
		</h2>

		<?php if ( is_null( $tab ) ) { ?>
			<div class="theme_info info-tab-content">
				<div class="theme_info_column clearfix">
					<div class="theme_info_left">
						<div class="theme_link">
							<h3><?php esc_html_e( 'One Click Demo Import', 'envo-business' ); ?></h3>
							<p class="about"><?php esc_html_e( 'Save time by importing our demo data: your website will be set up and ready to be customized in minutes.', 'envo-business' ); ?></p>
							<p>
								<a href="<?php echo esc_url( admin_url( 'themes.php?page=et_envo-business&tab=import_data' ) ); ?>" class="button button-secondary"><?php esc_html_e( 'Import demo data', 'envo-business' ); ?></a>
							</p>
						</div>
						<div class="theme_link">
							<h3><?php esc_html_e( 'Theme Customizer', 'envo-business' ); ?></h3>
							<p class="about">
								<?php
								/* translators: %s theme name */
								printf( esc_html__( '%s supports the Theme Customizer for all theme settings. Click "Customize" to personalize your site.', 'envo-business' ), $theme_data->Name );
								?>
							</p>
							<p>
								<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary"><?php esc_html_e( 'Start customizing', 'envo-business' ); ?></a>
							</p>
						</div>
						<div class="theme_link">
							<h3><?php esc_html_e( 'Theme documentation', 'envo-business' ); ?></h3>
							<p class="about">
								<?php
								/* translators: %s theme name */
								printf( esc_html__( 'Need help in setting up and configuring %s? Please take a look at our documentation page.', 'envo-business' ), $theme_data->Name );
								?>
							</p>
							<p>
								<a href="<?php echo esc_url( 'https://envothemes.com/envo-business/envo-business-documentation/' ); ?>" target="_blank" class="button button-secondary">
									<?php
									/* translators: %s theme name */
									printf( esc_html__( '%s Documentation', 'envo-business' ), $theme_data->Name );
									?>
								</a>
							</p>
						</div>
						<div class="theme_link">
							<h3><?php esc_html_e( 'Having trouble? Need support?', 'envo-business' ); ?></h3>
							<p>
								<a href="<?php echo esc_url( 'https://envothemes.com/contact/' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Contact us', 'envo-business' ); ?></a>
							</p>
						</div>
					</div>

					<div class="theme_info_right">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="Theme Screenshot" />
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if ( $tab == 'actions_required' ) { ?>
			<div class="action-required-tab info-tab-content">

				<?php
				if ( is_child_theme() ) {
					$child_theme = wp_get_theme();
					?>
					<form method="post" action="<?php echo esc_attr( $current_action_link ); ?>" class="demo-import-boxed copy-settings-form">
						<p>
							<strong>
								<?php
								/* translators: %1$s theme name */
								printf( esc_html__( 'You\'re using %1$s, an Envo Business child theme', 'envo-business' ), $child_theme->Name );
								?>
							</strong>
						</p>
						<p>
							<?php esc_html_e( 'Do you want to import the theme settings of the parent theme into your child theme?', 'envo-business' ); ?>
						</p>
						<p>
							<?php
							$select		 = '<select name="copy_from">';
							$select .= '<option value="">' . esc_html__( 'From theme', 'envo-business' ) . '</option>';
							$select .= '<option value="envo-business">Envo Business</option>';
							$select .= '<option value="' . esc_attr( $child_theme->get_stylesheet() ) . '">' . ( $child_theme->Name ) . '</option>';
							$select .='</select>';

							$select_2 = '<select name="copy_to">';
							$select_2 .= '<option value="">' . esc_html__( 'To theme', 'envo-business' ) . '</option>';
							$select_2 .= '<option value="envo-business">Envo Business</option>';
							$select_2 .= '<option value="' . esc_attr( $child_theme->get_stylesheet() ) . '">' . ( $child_theme->Name ) . '</option>';
							$select_2 .='</select>';

							echo $select . ' to ' . $select_2;
							?>
							<input type="submit" class="button button-secondary" value="<?php esc_html_e( 'Import now', 'envo-business' ); ?>">
						</p>
						<?php if ( isset( $_GET[ 'copied' ] ) && $_GET[ 'copied' ] == 1 ) { ?>
							<p>
								<?php esc_html_e( 'Are you sure you want to proceed? Imported settings will replace the ones of the current theme.', 'envo-business' ); ?>
							</p>
						<?php } ?>
					</form>

				<?php } ?>
				<?php if ( $actions_r[ 'number_active' ] > 0 ) { ?>
					<?php $actions = wp_parse_args( $actions, array( 'page_on_front' => '', 'page_template' ) ) ?>

					<?php if ( $actions[ 'recommend_plugins' ] == 'active' ) { ?>
						<div id="plugin-filter" class="recommend-plugins action-required">
							<a  title="" class="dismiss" href="<?php echo add_query_arg( array( 'envo_business_action_notice' => 'recommend_plugins' ), $current_action_link ); ?>">
								<?php if ( $actions_r[ 'hide_by_click' ][ 'recommend_plugins' ] == 'hide' ) { ?>
									<span class="dashicons dashicons-hidden"></span>
								<?php } else { ?>
									<span class="dashicons  dashicons-visibility"></span>
								<?php } ?>
							</a>
							<h3><?php esc_html_e( 'Recommended plugins', 'envo-business' ); ?></h3>
							<?php
							envo_business_render_recommend_plugins( $recommend_plugins );
							?>
						</div>
					<?php } ?>


					<?php if ( $actions[ 'page_on_front' ] == 'active' ) { ?>
						<div class="theme_link  action-required">
							<a title="<?php esc_attr_e( 'Dismiss', 'envo-business' ); ?>" class="dismiss" href="<?php echo add_query_arg( array( 'envo_business_action_notice' => 'page_on_front' ), $current_action_link ); ?>">
								<?php if ( $actions_r[ 'hide_by_click' ][ 'page_on_front' ] == 'hide' ) { ?>
									<span class="dashicons dashicons-hidden"></span>
								<?php } else { ?>
									<span class="dashicons  dashicons-visibility"></span>
								<?php } ?>
							</a>
							<h3><?php esc_html_e( 'Switch "Your homepage displays" to "A static page"', 'envo-business' ); ?></h3>
							<div class="about">
								<p>
									<?php
									/* translators: %1$s "Documentation" string and link */
									printf( esc_html__( 'If you want your website to have a "one-page" look, go to Appearence > Customize > Homepage settings and switch "Your homepage displays" to "A static page". %1$s', 'envo-business' ), '<a class="documentation" href="' . esc_url( 'https://envothemes.com/envo-business/envo-business-documentation/#homepage-setup' ) . '" target="_blank">' . esc_html__( 'Documentation', 'envo-business' ) . '</a>' );
									?>
								</p> 
							</div>
							<p>
								<a  href="<?php echo admin_url( 'options-reading.php' ); ?>" class="button">
									<?php esc_html_e( '"Your homepage displays" setup', 'envo-business' ); ?>
								</a>
							</p>
						</div>
					<?php } ?>

					<?php if ( $actions[ 'page_template' ] == 'active' ) { ?>
						<div class="theme_link  action-required">
							<a  title="<?php esc_attr_e( 'Dismiss', 'envo-business' ); ?>" class="dismiss" href="<?php echo add_query_arg( array( 'envo_business_action_notice' => 'page_template' ), $current_action_link ); ?>">
								<?php if ( $actions_r[ 'hide_by_click' ][ 'page_template' ] == 'hide' ) { ?>
									<span class="dashicons dashicons-hidden"></span>
								<?php } else { ?>
									<span class="dashicons dashicons-visibility"></span>
								<?php } ?>
							</a>
							<h3><?php esc_html_e( 'Set your homepage page template to "Homepage"', 'envo-business' ); ?></h3>

							<div class="about">
								<p>
									<?php
									/* translators: %1$s "Documentation" string and link */
									printf( esc_html__( 'To change homepage contents, you need to choose "Homepage" as the template for your homepage. %1$s', 'envo-business' ), '<a class="documentation" href="' . esc_url( 'https://envothemes.com/envo-business/envo-business-documentation/#homepage-setup' ) . '" target="_blank">' . esc_html__( 'Documentation', 'envo-business' ) . '</a>' );
									?>
								</p>
							</div>
							<p>
								<?php
								$front_page = get_option( 'page_on_front' );
								if ( $front_page <= 0 ) {
									?>
									<a  href="<?php echo admin_url( 'options-reading.php' ); ?>" class="button"><?php esc_html_e( '"Your homepage displays" setup', 'envo-business' ); ?></a>
									<?php
								}

								if ( $front_page > 0 && get_post_meta( $front_page, '_wp_page_template', true ) != 'template-parts/template-homepage.php' ) {
									?>
									<a href="<?php echo get_edit_post_link( $front_page ); ?>" class="button"><?php esc_html_e( 'Change homepage template', 'envo-business' ); ?></a>
									<?php
								}
								?>
							</p>
						</div>
					<?php } ?>
					<?php do_action( 'envo_business_more_required_details', $actions ); ?>
				<?php } else { ?>
					<p>
						<?php esc_html_e( 'Hooray! There are no required actions for you right now.', 'envo-business' ); ?>
					</p>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if ( $tab == 'useful_plugins' ) { ?>
			<div class="useful-plugins-tab info-tab-content">
				<?php
				$confing			 = array(
					'recommended_plugins' => array(
						'details'	 => esc_html__( 'Details', 'envo-business' ),
						'activated'	 => esc_html__( 'Active', 'envo-business' ),
						'content'	 => array(
							array(
								'link'	 => 'https://wordpress.org/plugins/envothemes-importer-kingcomposer/',
								'name'	 => 'Demo Layouts Import',
								'id'	 => 'envothemes-importer-kingcomposer',
							),
							array(
								'link'	 => 'https://envothemes.com/product/envo-business-copyright/',
								'name'	 => 'Copyright',
								'id'	 => 'envo-business-footer-credits',
							),
							array(
								'link'	 => 'https://envothemes.com/product/envo-business-colors-and-typography/',
								'name'	 => 'Colors & Typography',
								'id'	 => 'envo-business-colors-typography',
							),
							array(
								'link'	 => 'https://envothemes.com/product/envo-business-kingcomposer-pro-support/',
								'name'	 => 'KingComposer PRO Support',
								'id'	 => 'envo-business-kingcomposer',
							),
							array(
								'link'	 => 'https://envothemes.com/product/envo-business-mega-menu/',
								'name'	 => 'Mega Menu Support',
								'id'	 => 'envo-business-mega-menu',
							),
							array(
								'link'	 => 'https://envothemes.com/product/envo-business-woocommerce-support/',
								'name'	 => 'WooCommerce Support',
								'id'	 => 'envo-business-woocommerce',
							),
							array(
								'link'	 => 'https://envothemes.com/product/envo-business-lazy-load-images/',
								'name'	 => 'Lazy Load Images',
								'id'	 => 'envo-business-lazy-load-images',
							),
						),
					),
				);
				$recommended_plugins = $confing[ 'recommended_plugins' ];
				if ( !empty( $recommended_plugins ) ) {
					if ( !empty( $recommended_plugins[ 'content' ] ) && is_array( $recommended_plugins[ 'content' ] ) ) {
						echo '<div class="recommended-plugins" >';

						foreach ( $recommended_plugins[ 'content' ] as $recommended_plugins_item ) {
							echo '<div class="plugin-box" >';
							echo '<div class="plugin-box-inner ' . esc_attr( $recommended_plugins_item[ 'id' ] ) . '" >';
							echo esc_html( $recommended_plugins_item[ 'name' ] );
							echo '</div>';
							echo '<div class="plugin-box-detail" >';
							if ( is_plugin_active( $recommended_plugins_item[ 'id' ] . '/' . $recommended_plugins_item[ 'id' ] . '.php' ) ) {
								echo esc_html( $recommended_plugins[ 'activated' ] );
							} else {
								echo '<a class="install-now button" target="_blank" href="' . esc_url( $recommended_plugins_item[ 'link' ] ) . '" >';
								echo esc_html( $recommended_plugins[ 'details' ] );
								echo '</a>';
							}
							echo '</div>';
							echo '</div>';
						}
						echo '</div>';
					}
				}
				?>

			</div>
		<?php } ?>

		<?php
		if ( $tab == 'import_data' ) {
			if ( is_plugin_active( 'envo-business-kingcomposer/envo-business-kingcomposer.php' ) ) {
				if ( class_exists( 'ebdi_kc_SettingsPage' ) ) {
					envo_business_kingcomposer_SettingsPage::get_instance()->et_import();
				}
			} elseif ( is_plugin_active( 'envothemes-importer-kingcomposer/envothemes-importer-kingcomposer.php' ) ) {
				if ( class_exists( 'ebdi_kc_SettingsPage' ) ) {
					ebdi_kc_SettingsPage::get_instance()->et_import();
				}
			} else {
				$importer = array(
					'envothemes-importer-kingcomposer' => array(
						'name'				 => esc_html__( 'EnvoThemes Demo Importer for KingComposer', 'envo-business' ),
						'active_filename'	 => 'envothemes-importer-kingcomposer/envothemes-importer-kingcomposer.php',
						/* translators: %1$s "documentation" string and link */
						'description'		 => sprintf( __( 'You can import the demo content with just one click. For step-by-step video tutorial, see %1$s', 'envo-business' ), '<a class="documentation" href="' . esc_url( 'https://envothemes.com/envo-business/envo-business-documentation/#importing-the-sample-data' ) . '" target="_blank">' . esc_html__( 'documentation', 'envo-business' ) . '</a>' ),
					),
				);
				envo_business_render_recommend_plugins( $importer );
			}
		}
		?>

		<?php do_action( 'envo_business_more_tabs_details', $actions ); ?>

	</div> <!-- END .theme_info -->
	<script type="text/javascript">
	    jQuery( document ).ready( function ( $ ) {
	        $( 'body' ).addClass( 'about-php' );

	        $( '.copy-settings-form' ).on( 'submit', function () {
	            var c = confirm( '<?php echo esc_attr_e( 'Are you sure you want to proceed? Imported settings will replace the ones of the current theme.', 'envo-business' ); ?>' );
	            if ( !c ) {
	                return false;
	            }
	        } );
	    } );
	</script>
	<?php
}
