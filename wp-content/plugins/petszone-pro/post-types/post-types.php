<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (! class_exists ( 'PetsZoneProPostTypes' )) {
	/**
	 *
	 * @author iamdesigning11
	 *
	 */
	class PetsZoneProPostTypes {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

		function __construct() {

			// Mega Menu Post Type
			require_once PETSZONE_PRO_DIR_PATH . 'post-types/mega-menu-post-type.php';

		}
	}
}

PetsZoneProPostTypes::instance();