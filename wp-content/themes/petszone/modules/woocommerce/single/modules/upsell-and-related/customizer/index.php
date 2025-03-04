<?php

/**
 * WooCommerce - Single - Module - Upsell & Related - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Customizer_Single_Upsell_Related' ) ) {

    class PetsZone_Shop_Customizer_Single_Upsell_Related {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function register( $wp_customize ) {

            /**************
             *  Upsell
             **************/

                /**
                * Option : Show Upsell Products
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-display]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-display]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Upsell Products', 'petszone'),
                                'section' => 'woocommerce-single-page-upsell-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone' ),
                                    'off' => esc_attr__( 'No', 'petszone' )
                                )
                            )
                        )
                    );

                /**
                 * Option : Upsell Title
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-title]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-title]', array(
                            'type'       => 'text',
                            'section'    => 'woocommerce-single-page-upsell-section',
                            'label'      => esc_html__( 'Upsell Title', 'petszone' )
                        )
                    );

                /**
                 * Option : Upsell Column
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-column]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control( new PetsZone_Customize_Control_Radio_Image(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-column]', array(
                            'type' => 'wdt-radio-image',
                            'label' => esc_html__( 'Upsell Column', 'petszone'),
                            'section' => 'woocommerce-single-page-upsell-section',
                            'choices' => apply_filters( 'petszone_woo_upsell_columns_options', array(
                                1 => array(
                                    'label' => esc_html__( 'One Column', 'petszone' ),
                                    'path' => petszone_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-column.png'
                                ),
                                2 => array(
                                    'label' => esc_html__( 'One Half Column', 'petszone' ),
                                    'path' => petszone_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-half-column.png'
                                ),
                                3 => array(
                                    'label' => esc_html__( 'One Third Column', 'petszone' ),
                                    'path' => petszone_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-third-column.png'
                                ),
                                4 => array(
                                    'label' => esc_html__( 'One Fourth Column', 'petszone' ),
                                    'path' => petszone_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-fourth-column.png'
                                )
                            ))
                        )
                    ));


                /**
                * Option : Upsell Limit
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-limit]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-limit]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Upsell Limit', 'petszone'),
                                'section'  => 'woocommerce-single-page-upsell-section',
                                'choices'  => array (
                                    1 => esc_html__( '1', 'petszone' ),
                                    2 => esc_html__( '2', 'petszone' ),
                                    3 => esc_html__( '3', 'petszone' ),
                                    4 => esc_html__( '4', 'petszone' ),
                                    5 => esc_html__( '5', 'petszone' ),
                                    6 => esc_html__( '6', 'petszone' ),
                                    7 => esc_html__( '7', 'petszone' ),
                                    8 => esc_html__( '8', 'petszone' ),
                                    9 => esc_html__( '9', 'petszone' ),
                                    10 => esc_html__( '10', 'petszone' ),
                                )
                            )
                        )
                    );

                /**
                 * Option : Product Style Template
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-style-template]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-upsell-style-template]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Product Style Template', 'petszone'),
                                'section'  => 'woocommerce-single-page-upsell-section',
                                'choices'  => petszone_woo_listing_customizer_settings()->product_templates_list()
                            )
                        )
                    );


            /**************
             *  Related
             **************/

                /**
                * Option : Show Related Products
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-display]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-display]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Related Products', 'petszone'),
                                'section' => 'woocommerce-single-page-related-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone' ),
                                    'off' => esc_attr__( 'No', 'petszone' )
                                )
                            )
                        )
                    );

                /**
                 * Option : Related Title
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-title]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-title]', array(
                            'type'       => 'text',
                            'section'    => 'woocommerce-single-page-related-section',
                            'label'      => esc_html__( 'Related Title', 'petszone' )
                        )
                    );

                /**
                 * Option : Related Column
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-column]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control( new PetsZone_Customize_Control_Radio_Image(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-column]', array(
                            'type' => 'wdt-radio-image',
                            'label' => esc_html__( 'Related Column', 'petszone'),
                            'section' => 'woocommerce-single-page-related-section',
                            'choices' => apply_filters( 'petszone_woo_related_columns_options', array(
                                1 => array(
                                    'label' => esc_html__( 'One Column', 'petszone' ),
                                    'path' => petszone_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-column.png'
                                ),
                                2 => array(
                                    'label' => esc_html__( 'One Half Column', 'petszone' ),
                                    'path' => petszone_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-half-column.png'
                                ),
                                3 => array(
                                    'label' => esc_html__( 'One Third Column', 'petszone' ),
                                    'path' => petszone_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-third-column.png'
                                ),
                                4 => array(
                                    'label' => esc_html__( 'One Fourth Column', 'petszone' ),
                                    'path' => petszone_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-fourth-column.png'
                                )
                            ))
                        )
                    ));


                /**
                * Option : Related Limit
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-limit]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-limit]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Related Limit', 'petszone'),
                                'section'  => 'woocommerce-single-page-related-section',
                                'choices'  => array (
                                    1 => esc_html__( '1', 'petszone' ),
                                    2 => esc_html__( '2', 'petszone' ),
                                    3 => esc_html__( '3', 'petszone' ),
                                    4 => esc_html__( '4', 'petszone' ),
                                    5 => esc_html__( '5', 'petszone' ),
                                    6 => esc_html__( '6', 'petszone' ),
                                    7 => esc_html__( '7', 'petszone' ),
                                    8 => esc_html__( '8', 'petszone' ),
                                    9 => esc_html__( '9', 'petszone' ),
                                    10 => esc_html__( '10', 'petszone' ),
                                )
                            )
                        )
                    );

                /**
                 * Option : Product Style Template
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-style-template]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-related-style-template]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Product Style Template', 'petszone'),
                                'section'  => 'woocommerce-single-page-related-section',
                                'choices'  => petszone_woo_listing_customizer_settings()->product_templates_list()
                            )
                        )
                    );


        }

    }

}


if( !function_exists('petszone_shop_customizer_single_upsell_related') ) {
	function petszone_shop_customizer_single_upsell_related() {
		return PetsZone_Shop_Customizer_Single_Upsell_Related::instance();
	}
}

petszone_shop_customizer_single_upsell_related();