<?php
/**
 * Author Widget Class
 *
 * @package gucherry-blog
 */

if( ! class_exists( 'GuCherry_Blog_Author_Widget' ) ) {
    
    class GuCherry_Blog_Author_Widget extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'gucherry-blog-author-widget',  // Widget ID
                esc_html__( 'GB: Author Widget', 'gucherry-blog' ),   // Widget Name
                array(
                    'description' => esc_html__( 'Displays brief author detail.', 'gucherry-blog' ), 
                )
            );
     
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
                
            $author_page = !empty( $instance['author_page'] ) ? $instance['author_page'] : ''; 

            $author_link_title = !empty( $instance['author_link_title'] ) ? $instance['author_link_title'] : ''; 

            $author_args = array(
                'post_type' => 'page',
                'posts_per_page' => 1,
            ); 

            if( $author_page > 0 ) {
                $author_args['page_id'] = absint( $author_page );
            }

            $author = new WP_Query( $author_args );

            if( $author->have_posts() ) :

                while( $author->have_posts() ) : 

                    $author->the_post();
                    ?>
                    <div class="widget gc-author-widget">
                       <?php
                        if( !empty( $title ) ) :
                        ?>
                        <div class="widget-title">
                            <h3><?php echo esc_html( $title ); ?></h3>
                        </div><!-- // widget_title -->
                        <?php
                        endif;
                        ?>
                        <div class="widget-container">
                            <?php
                            if( has_post_thumbnail() ) :
                            ?>
                            <div class="author-thumb">
                                <?php
                                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'gucherry-blog-thumbnail-two' );
                                if( !empty( $thumbnail_url ) ) {
                                ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'gucherry-blog-thumbnail-two', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                </a>
                                <?php   
                                }
                                ?>
                            </div><!-- // author-thumb -->
                            <?php
                            endif;
                            ?>
                            <div class="author-bio">
                                <?php the_excerpt(); ?>
                            </div><!-- // author-bio -->
                            <?php
                            if( !empty( $author_link_title ) ) {
                            ?>
                            <div class="permalink">
                                <a class="gc-button-primary small" href="<?php the_permalink(); ?>"><?php echo esc_html( $author_link_title ); ?></a>
                            </div><!-- // permalink -->
                            <?php
                            }
                            ?>
                        </div><!-- // widget-container -->
                    </div><!-- // widget -->
                    <?php
                endwhile;
                wp_reset_postdata();               
            endif;
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title' => '',
                'author_page' => '',
                'author_link_title' => '',
            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>">
                    <strong><?php esc_html_e('Title', 'gucherry-blog'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'author_page' ) )?>"><strong><?php esc_html_e( 'Author Page', 'gucherry-blog' ); ?></strong></label>
                <?php
                    wp_dropdown_pages( array(
                        'id'               => esc_attr( $this->get_field_id( 'author_page' ) ),
                        'class'            => 'widefat',
                        'name'             => esc_attr( $this->get_field_name( 'author_page' ) ),
                        'selected'         => esc_attr( $instance[ 'author_page' ] ),
                        'show_option_none' => esc_html__( '&mdash; Select Page &mdash;', 'gucherry-blog' ),
                        )
                    );
                ?>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('author_link_title') ); ?>">
                    <strong><?php esc_html_e('Author Page Link Title', 'gucherry-blog'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_link_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_link_title') ); ?>" type="text" value="<?php echo esc_attr( $instance['author_link_title'] ); ?>" />   
            </p>
            <?php 
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']              = sanitize_text_field( $new_instance['title'] );

            $instance['author_page']        = absint( $new_instance['author_page'] );

            $instance['author_link_title']  = sanitize_text_field( $new_instance['author_link_title'] );

            return $instance;
        } 
    }   
}