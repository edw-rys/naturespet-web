<?php

/**
 * Listing Customizer - Tag Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Pro_Listing_Customizer_Tag' ) ) {

    class PetsZone_Pro_Listing_Customizer_Tag {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_filter( 'petszone_shop_pro_customizer_default', array( $this, 'default' ) );
            add_filter( 'petszone_woo_tag_page_default_settings', array( $this, 'tag_page_default_settings' ), 10, 1 );
            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function default( $option ) {

            $settings = petszone_woo_listing_tag()->woo_default_settings();
            extract($settings);

            if( $product_style_template == 'predefined' ) {
                $option['wdt-woo-tag-page-product-style-template'] = 'predefined-template-'.$product_style_custom_template;
            } else {
                $option['wdt-woo-tag-page-product-style-template'] = $product_style_custom_template;
            }

            $option['wdt-woo-tag-page-product-per-page']       = $product_per_page;
            $option['wdt-woo-tag-page-product-layout']         = $product_layout;

            // Default Values from Shop Plugin
            $option['wdt-woo-tag-page-show-sorter-on-header']  = $show_sorter_on_header;
            $option['wdt-woo-tag-page-sorter-header-elements'] = $sorter_header_elements;
            $option['wdt-woo-tag-page-show-sorter-on-footer']  = $show_sorter_on_footer;
            $option['wdt-woo-tag-page-sorter-footer-elements'] = $sorter_footer_elements;

            return $option;

        }

        function tag_page_default_settings( $settings ) {

            $product_style_custom_template = petszone_customizer_settings('wdt-woo-tag-page-product-style-template' );
            if( isset($product_style_custom_template) && !empty($product_style_custom_template) ) {
                $settings['product_style_template']        = 'custom';
                $settings['product_style_custom_template'] = $product_style_custom_template;
            }

            $product_per_page              = petszone_customizer_settings('wdt-woo-tag-page-product-per-page' );
            $settings['product_per_page']  = $product_per_page;

            $product_layout                = petszone_customizer_settings('wdt-woo-tag-page-product-layout' );
            $settings['product_layout']    = $product_layout;

            return $settings;

        }

        function register( $wp_customize ) {

            $wp_customize->add_section(
                new PetsZone_Customize_Section(
                    $wp_customize,
                    'woocommerce-tag-page-section',
                    array(
                        'title'    => esc_html__('Tag Page', 'petszone-pro'),
                        'panel'    => 'woocommerce-main-section',
                        'priority' => 30,
                    )
                )
            );

                /**
                 * Option : Product Style Template
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-woo-tag-page-product-style-template]', array(
                            'type'              => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-woo-tag-page-product-style-template]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Product Style Template', 'petszone-pro'),
                                'section'  => 'woocommerce-tag-page-section',
                                'choices'  => petszone_woo_listing_customizer_settings()->product_templates_list()
                            )
                        )
                    );

                /**
                 * Option : Products Per Page
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-woo-tag-page-product-per-page]', array(
                            'type' => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-woo-tag-page-product-per-page]', array(
                                'type'        => 'number',
                                'label'       => esc_html__( 'Products Per Page', 'petszone-pro' ),
                                'section'     => 'woocommerce-tag-page-section'
                            )
                        )
                    );


                /**
                 * Option : Product Layout
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-woo-tag-page-product-layout]', array(
                            'type' => 'option',
                        )
                    );

                    $wp_customize->add_control( new PetsZone_Customize_Control_Radio_Image(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-woo-tag-page-product-layout]', array(
                            'type' => 'wdt-radio-image',
                            'label' => esc_html__( 'Columns', 'petszone-pro'),
                            'section' => 'woocommerce-tag-page-section',
                            'choices' => apply_filters( 'petszone_woo_tag_columns_options', array(
                                1 => array(
                                    'label' => esc_html__( 'One Column', 'petszone-pro' ),
                                    'path' => PETSZONE_PRO_DIR_URL . 'modules/woocommerce/tag/customizer/images/one-column.png'
                                ),
                                2 => array(
                                    'label' => esc_html__( 'One Half Column', 'petszone-pro' ),
                                    'path' => PETSZONE_PRO_DIR_URL . 'modules/woocommerce/tag/customizer/images/one-half-column.png'
                                ),
                                3 => array(
                                    'label' => esc_html__( 'One Third Column', 'petszone-pro' ),
                                    'path' => PETSZONE_PRO_DIR_URL . 'modules/woocommerce/tag/customizer/images/one-third-column.png'
                                ),
                                4 => array(
                                    'label' => esc_html__( 'One Fourth Column', 'petszone-pro' ),
                                    'path' => PETSZONE_PRO_DIR_URL . 'modules/woocommerce/tag/customizer/images/one-fourth-column.png'
                                )
                            ))
                        )
                    ));

        }

    }

}


if( !function_exists('petszone_listing_customizer_tag') ) {
	function petszone_listing_customizer_tag() {
		return PetsZone_Pro_Listing_Customizer_Tag::instance();
	}
}

petszone_listing_customizer_tag();