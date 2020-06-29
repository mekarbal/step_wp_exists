<?php
/**
 * Active Callback
 * 
 * @package The Schema
*/

function the_schema_ed_excerpt_ac( $control ){
    
    $ed_excerpt = $control->manager->get_setting( 'ed_excerpt' )->value();
    $control_id    = $control->id;
    
    if( $control_id == 'excerpt_length' && $ed_excerpt ) return true;
    if( $control_id == 'read_more_text' && $ed_excerpt ) return true;
    
    return false;
}

function the_schema_ed_recommend_posts_ac( $control ){
    
    $ed_related = $control->manager->get_setting( 'ed_related' )->value();
    $control_id    = $control->id;
    
    if( $control_id == 'related_post_title' && $ed_related ) return true;
    
    return false;
}