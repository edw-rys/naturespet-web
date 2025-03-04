<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Metabox_Suggested_Products' ) ) {
    class PetsZone_Shop_Metabox_Suggested_Products {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
			add_filter( 'cs_metabox_options', array( $this, 'product_options' ) );
        }

        function product_options( $options ) {

			$settings = petszone_woo_others()->woo_default_settings();
			extract($settings);

			if(isset($enable_suggested_products) && !empty($enable_suggested_products)) {

				$options[] = array(
					'id'        => '_suggested_products_type',
					'title'     => esc_html__('Suggested Product','petszone-pro'),
					'post_type' => 'product',
					'context'   => 'side',
					'priority'  => 'low',
					'sections'  => array(
								array(
								'name'   => 'suggested_products_type_section',
								'fields' =>  array(
												array(
													'id'         => 'suggested-products-location',
													'type'       => 'text',
													'title'      => esc_html__('Suggested Location ', 'petszone-pro'),
													'desc'       => esc_html__('Enter the location', 'petszone-pro')
												),
												array(
													'id'         => 'suggested-products-time',
													'type'       => 'text',
													'title'      => esc_html__('Suggested Time ', 'petszone-pro'),
													'desc'       => esc_html__('Enter the time in minutes', 'petszone-pro')
												)
											)
								)
							)
				);

			}

			return $options;

		}

    }
}

PetsZone_Shop_Metabox_Suggested_Products::instance();