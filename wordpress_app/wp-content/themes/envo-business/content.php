<article>
	<div <?php post_class(); ?>>                    
		<?php if ( has_post_thumbnail() ) : ?>                               
			<a class="featured-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
				<img class="lazy" src="<?php echo esc_url( get_template_directory_uri() ) . '/img/placeholder.png' ?>" data-src="<?php the_post_thumbnail_url( 'envo-business-single' ); ?>" alt="<?php the_title_attribute(); ?>" />
				<noscript>
				<?php the_post_thumbnail( 'envo-business-single' ); ?>
				</noscript>
			</a>								               
		<?php endif; ?>	
		<div class="main-content">
			<h2 class="page-header h1">                                
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>                            
			</h2>
			<header class="col-md-4">
				<div class="post-meta">
					<?php envo_business_time_link(); ?>
					<?php envo_business_posted_on(); ?>
					<?php envo_business_entry_footer(); ?>
				</div>
			</header>
			<div class="content-inner col-md-8">                                                      
				<div class="single-entry">
					<?php the_excerpt(); ?> 
				</div><!-- .single-entry -->
				<a class="btn btn-default btn-lg" href="<?php the_permalink(); ?>" > 
					<?php esc_html_e( 'Read more', 'envo-business' ) ?>
				</a>
			</div>                                                             
		</div>                   
	</div>
</article>
