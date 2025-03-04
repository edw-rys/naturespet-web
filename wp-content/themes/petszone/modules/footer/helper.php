<?php
add_action( 'petszone_after_main_css', 'footer_style' );
function footer_style() {
    wp_enqueue_style( 'petszone-footer', get_theme_file_uri('/modules/footer/assets/css/footer.css'), false, PETSZONE_THEME_VERSION, 'all');
}

add_action( 'petszone_footer', 'footer_content' );
function footer_content() {
    petszone_template_part( 'content', 'content', 'footer' );
}