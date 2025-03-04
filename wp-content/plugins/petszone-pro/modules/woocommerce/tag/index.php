<?php

/**
 * Listings - Tag
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Pro_Listing_Tag' ) ) {

    class PetsZone_Pro_Listing_Tag {

        private static $_instance = null;

        private $settings;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            /* Load Modules */
                $this->load_modules();

            /* Loop Shop Per Page */
                add_filter( 'loop_shop_per_page', array ( $this, 'woo_loop_shop_per_page' ) );

        }

        /*
        Load Modules
        */
            function load_modules() {

                /* Customizer */
                    include_once PETSZONE_PRO_DIR_PATH.'modules/woocommerce/tag/customizer/index.php';

            }

        /*
        Loop Shop Per Page
        */
            function woo_loop_shop_per_page( $count ) {

                if( is_product_tag() ) {
                    $count = petszone_customizer_settings('wdt-woo-tag-page-product-per-page' );
                }

                return $count;

            }

    }

}


if( !function_exists('petszone_listing_tag') ) {
	function petszone_listing_tag() {
		return PetsZone_Pro_Listing_Tag::instance();
	}
}

petszone_listing_tag();