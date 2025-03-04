<?php

/**
 * WooCommerce - Single - Module - Custom Template - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Customizer_Single_Default_CT' ) ) {

    class PetsZone_Shop_Customizer_Single_Default_CT {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_filter( 'petszone_woo_single_page_settings', array( $this, 'single_page_settings' ), 10, 1 );
            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function single_page_settings( $settings ) {

            $product_default_template             = petszone_customizer_settings('wdt-single-product-default-template' );
            $settings['product_default_template'] = $product_default_template;

            return $settings;

        }

        function register( $wp_customize ) {

            /**
             * Option : Product Template
             */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-default-template]', array(
                        'type' => 'option'
                    )
                );

                $wp_customize->add_control(
                    PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-default-template]', array(
                        'type'     => 'select',
                        'label'    => esc_html__( 'Product Template', 'petszone-pro'),
                        'section'  => 'woocommerce-single-page-default-section',
                        'choices'  => apply_filters( 'petszone_shop_single_product_default_template', array(
                                        'woo-default'     => esc_html__( 'WooCommerce Default', 'petszone-pro' ),
                                        'custom-template' => esc_html__( 'Custom Template', 'petszone-pro' )
                                    ) )
                    )
                );

        }

    }

}


if( !function_exists('petszone_shop_customizer_single_default_ct') ) {
	function petszone_shop_customizer_single_default_ct() {
		return PetsZone_Shop_Customizer_Single_Default_CT::instance();
	}
}

petszone_shop_customizer_single_default_ct();