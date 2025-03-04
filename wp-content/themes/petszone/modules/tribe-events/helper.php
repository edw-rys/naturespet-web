<?php

if( ! function_exists('petszone_event_breadcrumb_title') ) {
    function petszone_event_breadcrumb_title($title) {
        if( get_post_type() == 'tribe_events' && is_single()) {
            $etitle = esc_html__( 'Event Detail', 'petszone' );
            return '<h1>'.$etitle.'</h1>';
        } else {
            return $title;
        }
    }

    add_filter( 'petszone_breadcrumb_title', 'petszone_event_breadcrumb_title', 20, 1 );
}

?>