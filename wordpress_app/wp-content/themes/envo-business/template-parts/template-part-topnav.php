<?php do_action( 'envo_business_before_menu' ); ?> 
<div class="main-menu">
	<nav id="site-navigation" class="navbar navbar-default navbar-fixed-top">     
		<div class="container">   
			<div class="navbar-header">
				<?php if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled('main_menu') ) : ?>
				<?php elseif ( has_nav_menu( 'main_menu' ) ) : ?>
					<div id="main-menu-panel" class="open-panel" data-panel="main-menu-panel">
						<span></span>
						<span></span>
						<span></span>
					</div>
				<?php endif; ?>
				<div class="site-header" >
					<div class="site-branding-logo">
						<?php the_custom_logo(); ?>
					</div>
					<div class="site-branding-text navbar-brand">
						<?php if ( is_front_page() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>

						<?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
							?>
							<p class="site-description">
								<?php echo $description; ?>
							</p>
						<?php endif; ?>
					</div><!-- .site-branding-text -->
				</div>
			</div>  
			<?php
			wp_nav_menu( array(
				'theme_location'	 => 'main_menu',
				'depth'				 => 5,
				'container'			 => 'div',
				'container_class'	 => 'menu-container',
				'menu_class'		 => 'nav navbar-nav navbar-right',
				'fallback_cb'		 => 'wp_bootstrap_navwalker::fallback',
				'walker'			 => new wp_bootstrap_navwalker(),
			) );
			?>
		</div>
		<?php do_action( 'envo_business_menu' ); ?>
	</nav> 
</div>
<?php do_action( 'envo_business_after_menu' ); ?>
<?php if ( !is_page_template( 'template-parts/template-homepage.php' ) ) : ?>
	<div class="container main-container" role="main">
<?php endif; ?>
