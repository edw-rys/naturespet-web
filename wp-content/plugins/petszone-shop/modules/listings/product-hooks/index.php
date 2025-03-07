<?php

/**
 * Listing Framework Hooks Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Woo_Listing_Fw_Hooks_Settings' ) ) {


    class PetsZone_Woo_Listing_Fw_Hooks_Settings {

        private static $_instance = null;

        private $template_hooks_page_top = false;
        private $template_hooks_page_bottom = false;
        private $template_hooks_content_top = false;
        private $template_hooks_content_bottom = false;
        
        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            $this->template_hooks_page_top = petszone_customizer_settings('wdt-woo-shop-page-template-hooks-page-top' );
            $this->template_hooks_page_bottom = petszone_customizer_settings('wdt-woo-shop-page-template-hooks-page-bottom' );
            $this->template_hooks_content_top = petszone_customizer_settings('wdt-woo-shop-page-template-hooks-content-top' );
            $this->template_hooks_content_bottom = petszone_customizer_settings('wdt-woo-shop-page-template-hooks-content-bottom' );

            add_action( 'petszone_hook_sections_before', array ( $this, 'woo_hook_sections_before' ), 10 );
            add_action( 'petszone_hook_sections_after', array ( $this, 'woo_hook_sections_after' ), 10 );

            add_action( 'petszone_woo_before_products_loop', array ( $this, 'woo_before_products_loop' ), 15 );
            add_action( 'petszone_woo_after_products_loop', array ( $this, 'woo_after_products_loop' ), 5 );

        }


        public function woo_hook_sections_before() {

            $output = '';

            if(is_shop()) {
                if(isset($this->template_hooks_page_top) && !empty($this->template_hooks_page_top)) {
                    $frontend = Elementor\Frontend::instance();
                    $output .= $frontend->get_builder_content( $this->template_hooks_page_top, true );
                }
            }

            echo petszone_html_output($output);

        }

        public function woo_hook_sections_after() {

            $output = '';

            if(is_shop()) {
                if(isset($this->template_hooks_page_bottom) && !empty($this->template_hooks_page_bottom)) {
                    $frontend = Elementor\Frontend::instance();
                    $output .= $frontend->get_builder_content( $this->template_hooks_page_bottom, true );
                }
            }

            echo petszone_html_output($output);

        }


        public function woo_before_products_loop() {

            $output = '';

            if(is_shop()) {
                if(isset($this->template_hooks_content_top) && !empty($this->template_hooks_content_top)) {
                    $frontend = Elementor\Frontend::instance();
                    $output .= $frontend->get_builder_content( $this->template_hooks_content_top, true );
                }
            }

            echo petszone_html_output($output);

        }

        public function woo_after_products_loop() {

            $output = '';

            if(is_shop()) {
                if(isset($this->template_hooks_content_bottom) && !empty($this->template_hooks_content_bottom)) {
                    $frontend = Elementor\Frontend::instance();
                    $output .= $frontend->get_builder_content( $this->template_hooks_content_bottom, true );
                }
            }

            echo petszone_html_output($output);

        }


    }

}


if( !function_exists('petszone_woo_listing_fw_hooks_settings') ) {
	function petszone_woo_listing_fw_hooks_settings() {
		return PetsZone_Woo_Listing_Fw_Hooks_Settings::instance();
	}
}

petszone_woo_listing_fw_hooks_settings();