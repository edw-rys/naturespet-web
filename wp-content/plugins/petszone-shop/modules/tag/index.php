<?php

/**
 * Listings - Tag
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Listing_Tag' ) ) {

    class PetsZone_Shop_Listing_Tag {

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

        }

        /*
        Load Modules
        */
            function load_modules() {

                /* Customizer */
                    include_once PETSZONE_SHOP_PATH . 'modules/tag/customizer/index.php';

            }

    }

}


if( !function_exists('petszone_shop_listing_tag') ) {
	function petszone_shop_listing_tag() {
		return PetsZone_Shop_Listing_Tag::instance();
	}
}

petszone_shop_listing_tag();