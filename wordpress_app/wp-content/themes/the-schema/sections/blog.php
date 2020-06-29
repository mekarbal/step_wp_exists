<?php

/**
 * Home Blog Section
**/

?>
<div id="content" class="site-content">
	<div class="post-content-wrap">
		
            <?php        
            $home_blog_title = get_theme_mod('blog_section_title',__('Read our blog to sharpen your business and SEO skills.','the-schema'));
            $home_blog_desc = get_theme_mod('blog_section_subtitle',__('Get evidence-based collection of articles on a topic sent directly to you in one email.','the-schema'));
            if($home_blog_desc || $home_blog_title){?>
            <header class="page-header">
                <div class="container">
                    <?php if($home_blog_title){?>
                        <h1 class="page-title"><?php echo esc_html($home_blog_title); ?></h1>
                    <?php } ?>

                    <?php if($home_blog_desc){?>
                        <div class="page-desc">
                            <?php echo wp_kses_post($home_blog_desc); ?>
                        </div>
                    <?php } ?>
                </div>
            </header>
        <?php }?>

		<div class="container">
			<div id="primary" class="content-area">

				<?php 
				/**
				* Before Posts hook
				*/
				do_action( 'the_schema_before_posts_content' );
				?>

				<main id="main" class="site-main">

					<?php
					
                    $pgd = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
                    $posts_per_page = absint( get_option('posts_per_page') );
                    
					$latest_posts_args = array(
				        'ignore_sticky_posts' 	=> true,  
				        'posts_per_page' 		=> $posts_per_page,
				        'paged'					=> $pgd,
				    );
				    
				    $latest_posts_qry = new WP_Query( $latest_posts_args );
					
					if( $latest_posts_qry->have_posts() ):

						/* Start the Loop */
						while ( $latest_posts_qry->have_posts() ) : $latest_posts_qry->the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'content' );


						endwhile;

						echo '<nav class="navigation pagination" role="navigation">';
						echo '<div class="nav-links">';
						$big = 999999999; // need an unlikely integer
                        echo paginate_links( array(
                        	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        	'format' => '?paged=%#%',
                        	'current' => max( 1, get_query_var('page') ),
                        	'total' => $latest_posts_qry->max_num_pages
                        ) );
                        echo '</div>';
                        echo '</nav>';

						wp_reset_postdata();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div>

	</div>
</div>