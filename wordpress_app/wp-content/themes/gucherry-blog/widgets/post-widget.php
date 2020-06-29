<?php
/**
 * Post Widget Class
 *
 * @package gucherry-blog
 */

if( ! class_exists( 'GuCherry_Blog_Post_Widget' ) ) :

    class GuCherry_Blog_Post_Widget extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'gucherry-blog-post-widget',  // Widget ID
                esc_html__( 'GB: Posts Widget', 'gucherry-blog' ),   // Widget Name
                array(
                    'description' => esc_html__( 'Displays Posts.', 'gucherry-blog' ), 
                )
            );
     
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $posts_no = !empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 4;

            $layout = !empty( $instance[ 'layout' ] ) ? $instance[ 'layout' ] : 'layout_one';
            
            $post_type = !empty( $instance[ 'post_type' ] ) ? $instance[ 'post_type' ] : 'recent_post';
            
            $post_content = !empty( $instance[ 'post_content' ] ) ? $instance[ 'post_content' ] : 'display_time';

            $post_args = array(
                'post_type' => 'post'
            );
            
            if( $post_type == 'popular_post' ) {
                $post_args['orderby'] = 'comment_count';
            }

            if( absint( $posts_no ) > 0 ) {
                $post_args['posts_per_page'] = absint( $posts_no );
            }

            $post_query = new WP_Query( $post_args );

            if( $post_query->have_posts() ) {

                if( $layout == 'layout_one' ) {
                    ?>
                    <div class="widget gc-post-widget recent-s1">
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
                           while( $post_query->have_posts() ) :
                            $post_query->the_post();
                            
                                if( has_post_thumbnail() ) :
                                ?>
                                <article class="hentry">
                                    <div class="gc-row box">
                                        <div class="gc-col left">
                                            <figure class="thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail( 'gucherry-blog-thumbnail-two', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                                </a>
                                                <?php
                                                gucherry_blog_post_format_icons();
                                                ?>
                                            </figure><!-- // thumb -->
                                        </div><!-- // left -->
                                        <div class="gc-col right">
                                            <div class="post-content">
                                                <div class="post-title">
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                </div><!-- // post-title -->
                                                <div class="entry-metas">
                                                    <ul>
                                                        <?php
                                                        if( $post_content == 'display_time' ) {
                                                            gucherry_blog_posted_on( true );
                                                        } else {
                                                            gucherry_blog_comments_no_meta( true );
                                                        }
                                                        ?>
                                                    </ul>
                                                </div><!-- // entry-metas -->
                                            </div><!-- // post-content -->
                                        </div><!-- // left -->
                                    </div><!-- // box -->
                                </article><!-- // hentry -->
                                <?php
                                endif;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div><!-- // widget-container -->
                    </div><!-- // widget -->
                    <?php
                } else {
                    ?>
                    <div class="widget gc-post-widget popular-s1">
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
                           while( $post_query->have_posts() ) :
                            $post_query->the_post();
                            
                                if( has_post_thumbnail() ) :
                                ?>
                                <article class="hentry">
                                    <div class="gc-row box">
                                        <div class="gc-col left">
                                            <figure class="thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail( 'gucherry-blog-thumbnail-two', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                                </a>
                                                <?php
                                                gucherry_blog_post_format_icons();
                                                ?>
                                            </figure><!-- // thumb -->
                                        </div><!-- // left -->
                                        <div class="gc-col right">
                                            <div class="post-content">
                                                <div class="post-title">
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                </div><!-- // post-title -->
                                                <div class="entry-metas">
                                                    <ul>
                                                        <?php
                                                        if( $post_content == 'display_time' ) {
                                                            gucherry_blog_posted_on( true );
                                                        } else {
                                                            gucherry_blog_comments_no_meta( true );
                                                        }
                                                        ?>
                                                    </ul>
                                                </div><!-- // entry-metas -->
                                            </div><!-- // post-content -->
                                        </div><!-- // left -->
                                    </div><!-- // box -->
                                </article><!-- // hentry -->
                                <?php
                                endif;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div><!-- // widget-container -->
                    </div><!-- // widget -->
                    <?php
                }           
            }
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title'        => '',
                'post_no'      => 4,
                'layout'       => 'layout_one',
                'post_type'    => 'recent_post',
                'post_content' => 'display_time',
            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('layout') ); ?>">
                    <strong><?php esc_html_e('Chooose Layout', 'gucherry-blog'); ?></strong>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>">
                    <?php
                    $layout_choices = array(
                        'layout_one' => esc_html__( 'Layout One', 'gucherry-blog' ),
                        'layout_two' => esc_html__( 'Layout Two', 'gucherry-blog' ),
                    );

                    foreach( $layout_choices as $key => $layout ) {
                        ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php if( $instance['layout'] == $key ) { ?>selected<?php } ?>>
                            <?php
                                echo esc_html( $layout );
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
                    <strong><?php esc_html_e( 'Post Type' , 'gucherry-blog' ); ?></strong>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
                <?php
                    $post_type_choices = array(
                        'recent_post'   => esc_html__( 'Recent Posts', 'gucherry-blog' ),
                        'popular_post'  => esc_html__( 'Popular Posts', 'gucherry-blog' ),
                    );
                    
                    foreach( $post_type_choices as $key => $post_type ){
                        ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php if( $instance['post_type'] == $key ) { ?>selected<?php } ?>>
                            <?php 
                                echo esc_html( $post_type );
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>">
                    <strong><?php esc_html_e('Title', 'gucherry-blog'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>">
                    <strong><?php esc_html_e('No of Posts', 'gucherry-blog'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_no') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>" type="number" value="<?php echo esc_attr( $instance['post_no'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name( 'post_content' ) ); ?>">
                    <strong><?php esc_html_e( 'Post Content' , 'gucherry-blog' ); ?></strong>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_content' ) ); ?>">
                <?php
                    $post_content_choices = array(
                        'display_time'     => esc_html__( 'Display Posted Time', 'gucherry-blog' ),
                        'display_cmt_no'  => esc_html__( 'Display Comment No.', 'gucherry-blog' ),
                    );
                    
                    foreach( $post_content_choices as $key => $post_content ){
                        ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php if( $instance['post_content'] == $key ) { ?>selected<?php } ?>>
                            <?php 
                                echo esc_html( $post_content );
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </p>     
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']        = sanitize_text_field( $new_instance['title'] );

            $instance['post_no']      = absint( $new_instance['post_no'] );

            $instance['layout']       = sanitize_text_field( $new_instance['layout'] );
            
            $instance['post_type']    = sanitize_text_field( $new_instance['post_type'] );
            
            $instance['post_content'] = sanitize_text_field( $new_instance['post_content'] );

            return $instance;
        } 
    }
endif;