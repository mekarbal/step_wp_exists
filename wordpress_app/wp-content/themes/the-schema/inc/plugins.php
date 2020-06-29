<?php
/**
* PLugins Hook And Filter
**/

/** Disable FA Icon **/
if( the_schema_is_raratheme_companion() && get_theme_mod('ed_jquery_combined',false)  ){

    function the_schema_scripts_ed(){
        $reture_false = false;
        return $reture_false;
    }
    add_filter('rrtc_all_enqueue','the_schema_scripts_ed',12);
}


/** News Letter Default Color **/
if(the_schema_is_btnw_activated()):
    function the_schema_newsletter_default_bg_color(){
        return '#3f46ad';
    }
    add_filter('bt_newsletter_bg_color_setting','the_schema_newsletter_default_bg_color');
endif;


/** Client Widget Filter **/
if( the_schema_is_raratheme_companion() ){
    
add_filter('raratheme_companion_cl','the_schema_client_logo',10,6);
function the_schema_client_logo($html, $args, $title, $image, $link){?>

    <div class="raratheme-client-logo-holder">
        <div class="raratheme-client-logo-inner-holder">
            <?php
            if( $title ) { echo $args['before_title'].esc_html($title).$args['after_title']; }
            if( isset( $image) && $image!='' )
            {
                echo '<div class="image-holder-wrap">';
                    foreach ($image as $key => $value) {
                        if( isset( $image[$key] ) && $image[$key]!='' ){
                            $attachment_id = $image[$key];
                            $cta_img_size = apply_filters('rrtc_cl_img_size','full');
                            $image_array   = wp_get_attachment_image_src( $attachment_id, $cta_img_size);
                            $widget_bg_image  = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image_array[0]);
                            $fimg_url = $image_array[0];?>
                        
                            <div class="image-holder black-white">
                                <?php
                                if( isset($link[$key]) && $link[$key]!='' )
                                { 
                                    echo '<a href="' .esc_url($link[$key]).'" target="_blank">';
                                
                                }
                                echo '<img src="'.esc_url($fimg_url).'" alt="'.esc_attr( $title ).'" />';
                                if( isset($link[$key]) && $link[$key]!='' )
                                {
                                echo '</a>';                                
                                }?> 
                            </div>
                            
                        <?php
                        }
                    }
                echo '</div>';
            }?>
        </div>
    </div>
<?php
}
}