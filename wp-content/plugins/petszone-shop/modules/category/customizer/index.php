<?php

/**
 * Listing Customizer - Category Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Listing_Customizer_Category' ) ) {

    class PetsZone_Shop_Listing_Customizer_Category {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_filter( 'petszone_woo_category_page_default_settings', array( $this, 'category_page_default_settings' ), 10, 1 );
            add_action( 'customize_register', array( $this, 'register' ), 40);
            add_action( 'petszone_hook_content_before', array( $this, 'woo_handle_product_breadcrumb' ), 10);

        }

        function category_page_default_settings( $settings ) {

            $disable_breadcrumb             = petszone_customizer_settings('wdt-woo-category-page-disable-breadcrumb' );
            $settings['disable_breadcrumb'] = $disable_breadcrumb;

            $show_sorter_on_header              = petszone_customizer_settings('wdt-woo-category-page-show-sorter-on-header' );
            $settings['show_sorter_on_header']  = $show_sorter_on_header;

            $sorter_header_elements             = petszone_customizer_settings('wdt-woo-category-page-sorter-header-elements' );
            $settings['sorter_header_elements'] = (is_array($sorter_header_elements) && !empty($sorter_header_elements) ) ? $sorter_header_elements : array ();

            $show_sorter_on_footer              = petszone_customizer_settings('wdt-woo-category-page-show-sorter-on-footer' );
            $settings['show_sorter_on_footer']  = $show_sorter_on_footer;

            $sorter_footer_elements             = petszone_customizer_settings('wdt-woo-category-page-sorter-footer-elements' );
            $settings['sorter_footer_elements'] = (is_array($sorter_footer_elements) && !empty($sorter_footer_elements) ) ? $sorter_footer_elements : array ();

            return $settings;

        }

        function register( $wp_customize ) {

                /**
                * Option : Disable Breadcrumb
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-disable-breadcrumb]', array(
                            'type' => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-disable-breadcrumb]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Disable Breadcrumb', 'petszone-shop'),
                                'section' => 'woocommerce-category-page-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-shop' ),
                                    'off' => esc_attr__( 'No', 'petszone-shop' )
                                )
                            )
                        )
                    );


                /**
                 * Option : Show Sorter On Header
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-show-sorter-on-header]', array(
                            'type' => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-show-sorter-on-header]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Sorter On Header', 'petszone-shop'),
                                'section' => 'woocommerce-category-page-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-shop' ),
                                    'off' => esc_attr__( 'No', 'petszone-shop' )
                                )
                            )
                        )
                    );

                /**
                 * Option : Sorter Header Elements
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-sorter-header-elements]', array(
                            'type' => 'option',
                        )
                    );

                    $wp_customize->add_control( new PetsZone_Customize_Control_Sortable(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-sorter-header-elements]', array(
                            'type' => 'wdt-sortable',
                            'label' => esc_html__( 'Sorter Header Elements', 'petszone-shop'),
                            'section' => 'woocommerce-category-page-section',
                            'choices' => apply_filters( 'petszone_category_header_sorter_elements', array(
                                'filter'               => esc_html__( 'Filter - OrderBy', 'petszone-shop' ),
                                'filters_widget_area'  => esc_html__( 'Filters - Widget Area', 'petszone-shop' ),
                                'result_count'         => esc_html__( 'Result Count', 'petszone-shop' ),
                                'pagination'           => esc_html__( 'Pagination', 'petszone-shop' ),
                                'display_mode'         => esc_html__( 'Display Mode', 'petszone-shop' ),
                                'display_mode_options' => esc_html__( 'Display Mode Options', 'petszone-shop' )
                            )),
                        )
                    ));

                /**
                 * Option : Show Sorter On Footer
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-show-sorter-on-footer]', array(
                            'type' => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-show-sorter-on-footer]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Sorter On Footer', 'petszone-shop'),
                                'section' => 'woocommerce-category-page-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-shop' ),
                                    'off' => esc_attr__( 'No', 'petszone-shop' )
                                )
                            )
                        )
                    );

                /**
                 * Option : Sorter Footer Elements
                 */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-sorter-footer-elements]', array(
                            'type' => 'option',
                        )
                    );

                    $wp_customize->add_control( new PetsZone_Customize_Control_Sortable(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-woo-category-page-sorter-footer-elements]', array(
                            'type' => 'wdt-sortable',
                            'label' => esc_html__( 'Sorter Footer Elements', 'petszone-shop'),
                            'section' => 'woocommerce-category-page-section',
                            'choices' => apply_filters( 'petszone_category_footer_sorter_elements', array(
                                'filter'               => esc_html__( 'Filter', 'petszone-shop' ),
                                'result_count'         => esc_html__( 'Result Count', 'petszone-shop' ),
                                'pagination'           => esc_html__( 'Pagination', 'petszone-shop' ),
                                'display_mode'         => esc_html__( 'Display Mode', 'petszone-shop' ),
                                'display_mode_options' => esc_html__( 'Display Mode Options', 'petszone-shop' )
                            )),
                        )
                    ));

        }

        function woo_handle_product_breadcrumb() {

            if(is_product_category() && petszone_customizer_settings('wdt-woo-category-page-disable-breadcrumb' )) {
                remove_action('petszone_breadcrumb', 'petszone_breadcrumb_template');
            }

        }

    }

}


if( !function_exists('petszone_shop_listing_customizer_category') ) {
	function petszone_shop_listing_customizer_category() {
		return PetsZone_Shop_Listing_Customizer_Category::instance();
	}
}

petszone_shop_listing_customizer_category();