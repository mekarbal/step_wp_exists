<!-- start content container -->
<div class="row">      
	<article class="main-content-area col-md-<?php envo_business_main_content_width_columns(); ?>">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                         
				<div <?php post_class(); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="featured-thumbnail">
							<img class="lazy" src="<?php echo esc_url( get_template_directory_uri() ) . '/img/placeholder.png' ?>" data-src="<?php the_post_thumbnail_url( 'envo-business-single' ); ?>" alt="<?php the_title_attribute(); ?>" />
							<noscript>
								<?php the_post_thumbnail( 'envo-business-single' ); ?>
							</noscript>
						</div>
					<?php endif; ?>	
					<div class="single-content row"> 
						<header class="col-md-4">
							<h2 class="page-header h1">                                
								<?php the_title(); ?>                          
							</h2>
							<div class="post-meta">
								<?php envo_business_time_link(); ?>
								<?php envo_business_posted_on(); ?>
								<?php envo_business_entry_footer(); ?>
							</div><!-- .single-entry-summary -->
						</header>
						<div class="col-md-8">
							<div class="single-entry-summary">
								<?php the_content(); ?> 
							</div><!-- .single-entry-summary -->
							<?php wp_link_pages(); ?>
						</div>                                                             
					</div>
					<div class="single-footer row">
						<div class="col-md-4">
							<?php get_template_part( 'template-parts/template-part', 'postauthor' ); ?>
						</div>
						<div class="col-md-8">
							<?php comments_template(); ?> 
						</div>
					</div>
				</div>        
			<?php endwhile; ?>        
		<?php else : ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>    
	</article> 

	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->
