<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZoneProSiteBlog' ) ) {
    class PetsZoneProSiteBlog extends PetsZonePlusSiteBlog {

        private static $_instance = null;
        public $element_position = array();

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->load_widgets();
            add_action( 'petszone_after_main_css', array( $this, 'enqueue_css_assets' ), 20 );
            add_filter('blog_post_grid_list_style_update', array( $this, 'blog_post_grid_list_style_update' ));
            add_filter('blog_post_cover_style_update', array( $this, 'blog_post_cover_style_update' ));
        }

        function enqueue_css_assets() {
            wp_enqueue_style( 'petszone-pro-blog', PETSZONE_PRO_DIR_URL . 'modules/blog/assets/css/blog.css', false, PETSZONE_PRO_VERSION, 'all');

            $post_style = petszone_get_archive_post_style();
            $file_path = PETSZONE_PRO_DIR_PATH . 'modules/blog/templates/'.esc_attr($post_style).'/assets/css/blog-archive-'.esc_attr($post_style).'.css';
            if ( file_exists( $file_path ) ) {
                wp_enqueue_style( 'wdt-blog-archive-'.esc_attr($post_style), PETSZONE_PRO_DIR_URL . 'modules/blog/templates/'.esc_attr($post_style).'/assets/css/blog-archive-'.esc_attr($post_style).'.css', false, PETSZONE_PRO_VERSION, 'all');
            }

        }

        function load_widgets() {
            add_action( 'widgets_init', array( $this, 'register_widgets_init' ) );
        }

        function register_widgets_init() {
            include_once PETSZONE_PRO_DIR_PATH.'modules/blog/widget/widget-recent-posts.php';
            register_widget('PetsZone_Widget_Recent_Posts');
        }

        function blog_post_grid_list_style_update($list) {

            $pro_list = array (
                'wdt-simple'        => esc_html__('Simple', 'petszone-pro'),
                'wdt-overlap'       => esc_html__('Overlap', 'petszone-pro'),
                'wdt-thumb-overlap' => esc_html__('Thumb Overlap', 'petszone-pro'),
                'wdt-minimal'       => esc_html__('Minimal', 'petszone-pro'),
                'wdt-fancy-box'     => esc_html__('Fancy Box', 'petszone-pro'),
                'wdt-bordered'      => esc_html__('Bordered', 'petszone-pro'),
                'wdt-magnificent'   => esc_html__('Magnificent', 'petszone-pro')
            );

            return array_merge( $list, $pro_list );

        }

        function blog_post_cover_style_update($list) {

            $pro_list = array ();
            return array_merge( $list, $pro_list );

        }

    }
}

PetsZoneProSiteBlog::instance();

if( !class_exists( 'PetsZoneProSiteRelatedBlog' ) ) {
    class PetsZoneProSiteRelatedBlog extends PetsZoneProSiteBlog {
        function __construct() {}
    }
}