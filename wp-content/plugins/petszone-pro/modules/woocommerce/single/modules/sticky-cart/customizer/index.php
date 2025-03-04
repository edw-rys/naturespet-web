<?php

/**
 * WooCommerce - Single - Module - Sticky Cart - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Customizer_Single_Sticky_Cart' ) ) {

    class PetsZone_Shop_Customizer_Single_Sticky_Cart {

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

            $product_addtocart_sticky             = petszone_customizer_settings('wdt-single-product-addtocart-sticky' );
            $settings['product_addtocart_sticky'] = $product_addtocart_sticky;

            return $settings;

        }

        function register( $wp_customize ) {

            /**
            * Option : Sticky Add to Cart
            */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-addtocart-sticky]', array(
                        'type' => 'option'
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control_Switch(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-addtocart-sticky]', array(
                            'type'    => 'wdt-switch',
                            'label'   => esc_html__( 'Sticky Add to Cart', 'petszone-pro'),
                            'section' => 'woocommerce-single-page-default-section',
                            'choices' => array(
                                'on'  => esc_attr__( 'Yes', 'petszone-pro' ),
                                'off' => esc_attr__( 'No', 'petszone-pro' )
                            )
                        )
                    )
                );

        }

    }

}


if( !function_exists('petszone_shop_customizer_single_sticky_cart') ) {
	function petszone_shop_customizer_single_sticky_cart() {
		return PetsZone_Shop_Customizer_Single_Sticky_Cart::instance();
	}
}

petszone_shop_customizer_single_sticky_cart();