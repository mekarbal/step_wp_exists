<?php
/**
 * Social Links Widget Class
 *
 * @package gucherry-blog
 */

if( ! class_exists( 'GuCherry_Blog_Social_Widget' ) ) {

    class GuCherry_Blog_Social_Widget extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'gucherry-blog-social-widget',  // Widget ID
                esc_html__( 'GB: Social Widget', 'gucherry-blog' ),   // Widget Name
                array(
                    'description' => esc_html__( 'Displays social links.', 'gucherry-blog' ), 
                )
            );
     
        }
     
        public function widget( $args, $instance ) {

            $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $facebook       = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
            $twitter        = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
            $instagram      = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
            $spotify        = ! empty( $instance['spotify'] ) ? $instance['spotify'] : '';
            $linkedin       = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
            $youtube        = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
            $pinterest      = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '';
            $vk             = ! empty( $instance['vk'] ) ? $instance['vk'] : '';
            $reddit         = ! empty( $instance['reddit'] ) ? $instance['reddit'] : '';
            $dribble        = ! empty( $instance['dribble'] ) ? $instance['dribble'] : '';
            ?>
            <div class="widget gc-social-widget">
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
                    <div class="social-icons">
                        <ul>
                           <?php
                           if( !empty( $facebook ) ) :
                           ?>
                            <li class="fb"><a href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $twitter ) ) :
                            ?>
                            <li class="tw"><a href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $instagram ) ) :
                            ?>
                            <li class="insta"><a href="<?php echo esc_url( $instagram ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $spotify ) ) :
                            ?>
                            <li class="spotify"><a href="<?php echo esc_url( $spotify ); ?>"><i class="fa fa-spotify" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $pinterest ) ) :
                            ?>
                            <li class="pin"><a href="<?php echo esc_url( $pinterest ); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $linkedin ) ) :
                            ?>
                            <li class="linkedin"><a href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $vk ) ) :
                            ?>
                            <li class="vk"><a href="<?php echo esc_url( $vk ); ?>"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $youtube ) ) :
                            ?>
                            <li class="yt"><a href="<?php echo esc_url( $youtube ); ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $reddit ) ) :
                            ?>
                            <li class="reddit"><a href="<?php echo esc_url( $reddit ); ?>"><i class="fa fa-reddit-alien" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
            
                            if( !empty( $dribbble ) ) :
                            ?>
                            <li class="dribble"><a href="<?php echo esc_url( $dribbble ); ?>"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                            <?php
                            endif;
                            ?>
                        </ul>
                    </div><!-- // social-icons -->
                </div><!-- // widget-container -->
            </div><!-- // widget -->
            <?php 
        }
     
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, 
                array(
                    'title'         => '',
                    'facebook'      => '',
                    'twitter'       => '',
                    'instagram'     => '',
                    'pinterest'     => '',
                    'youtube'       => '',
                    'linkedin'      => '',
                    'vk'            => '',
                    'spotify'       => '',
                    'reddit'        => '',
                    'dribble'       => '',
                ) 
            );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                    <strong><?php esc_html_e( 'Title ', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
                    <strong><?php esc_html_e( 'Facebook Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
                    <strong><?php esc_html_e( 'Twitter Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
                    <strong><?php esc_html_e( 'Instagram Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>">
                    <strong><?php esc_html_e( 'Pinterest Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>">
                    <strong><?php esc_html_e( 'Youtube Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>">
            </p>          

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>">
                    <strong><?php esc_html_e( 'Linkedin Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>">
                    <strong><?php esc_html_e( 'VK Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" value="<?php echo esc_attr( $instance['vk'] ); ?>">
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'spotify' ) ); ?>">
                    <strong><?php esc_html_e( 'Spotify Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'spotify' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'spotify' ) ); ?>" value="<?php echo esc_attr( $instance['spotify'] ); ?>">
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>">
                    <strong><?php esc_html_e( 'Reddit Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reddit' ) ); ?>" value="<?php echo esc_attr( $instance['reddit'] ); ?>">
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'dribble' ) ); ?>">
                    <strong><?php esc_html_e( 'Dribble Link', 'gucherry-blog' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribble' ) ); ?>" value="<?php echo esc_attr( $instance['dribble'] ); ?>">
            </p>
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance[ 'title' ]        = sanitize_text_field( $new_instance[ 'title' ] );

            $instance[ 'facebook' ]     = esc_url_raw( $new_instance[ 'facebook' ] );

            $instance[ 'twitter' ]      = esc_url_raw( $new_instance[ 'twitter' ] );

            $instance[ 'instagram' ]    = esc_url_raw( $new_instance[ 'instagram' ] );

            $instance[ 'linkedin' ]     = esc_url_raw( $new_instance[ 'linkedin' ] );

            $instance[ 'youtube' ]      = esc_url_raw( $new_instance[ 'youtube' ] );

            $instance[ 'pinterest' ]    = esc_url_raw( $new_instance[ 'pinterest' ] );

            $instance[ 'vk' ]           = esc_url_raw( $new_instance[ 'vk' ] );
            
            $instance[ 'spotify' ]      = esc_url_raw( $new_instance[ 'spotify' ] );
            
            $instance[ 'reddit' ]       = esc_url_raw( $new_instance[ 'reddit' ] );
            
            $instance[ 'dribble' ]      = esc_url_raw( $new_instance[ 'dribble' ] );

            return $instance;
        } 
    }
}
