<?php

/**
 * WooCommerce - Single - Module - Social Share & Follow - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Customizer_Single_Social_Share_And_Follow' ) ) {

    class PetsZone_Shop_Customizer_Single_Social_Share_And_Follow {

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

            $product_show_sharer_facebook                = petszone_customizer_settings('wdt-single-product-show-sharer-facebook' );
            $settings['product_show_sharer_facebook']    = $product_show_sharer_facebook;

            $product_show_sharer_delicious               = petszone_customizer_settings('wdt-single-product-show-sharer-delicious' );
            $settings['product_show_sharer_delicious']   = $product_show_sharer_delicious;

            $product_show_sharer_digg                    = petszone_customizer_settings('wdt-single-product-show-sharer-digg' );
            $settings['product_show_sharer_digg']        = $product_show_sharer_digg;

            $product_show_sharer_twitter                 = petszone_customizer_settings('wdt-single-product-show-sharer-twitter' );
            $settings['product_show_sharer_twitter']     = $product_show_sharer_twitter;

            $product_show_sharer_linkedin                = petszone_customizer_settings('wdt-single-product-show-sharer-linkedin' );
            $settings['product_show_sharer_linkedin']    = $product_show_sharer_linkedin;

            $product_show_sharer_pinterest               = petszone_customizer_settings('wdt-single-product-show-sharer-pinterest' );
            $settings['product_show_sharer_pinterest']   = $product_show_sharer_pinterest;

            return $settings;

        }

        function register( $wp_customize ) {

            /**
            * Share
            */

                /**
                * Option : Sharer Description
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-description]', array(
                            'type' => 'option'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-description]', array(
                                'type'        => 'wdt-description',
                                'label'       => esc_html__( 'Note: ', 'petszone-pro'),
                                'section'     => 'woocommerce-single-page-sociable-share-section',
                                'description' => esc_html__( 'This option is applicable only for WooCommerce "Custom Template".', 'petszone-pro')
                            )
                        )
                    );

                /**
                * Option : Show Facebook Sharer
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-facebook]', array(
                            'type' => 'option'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-facebook]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Facebook Sharer', 'petszone-pro'),
                                'section' => 'woocommerce-single-page-sociable-share-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-pro' ),
                                    'off' => esc_attr__( 'No', 'petszone-pro' )
                                )
                            )
                        )
                    );

                /**
                * Option : Show Delicious Sharer
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-delicious]', array(
                            'type' => 'option'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-delicious]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Delicious Sharer', 'petszone-pro'),
                                'section' => 'woocommerce-single-page-sociable-share-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-pro' ),
                                    'off' => esc_attr__( 'No', 'petszone-pro' )
                                )
                            )
                        )
                    );

                /**
                * Option : Show Digg Sharer
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-digg]', array(
                            'type' => 'option'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-digg]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Digg Sharer', 'petszone-pro'),
                                'section' => 'woocommerce-single-page-sociable-share-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-pro' ),
                                    'off' => esc_attr__( 'No', 'petszone-pro' )
                                )
                            )
                        )
                    );

                /**
                * Option : Show Twitter Sharer
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-twitter]', array(
                            'type' => 'option'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-twitter]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Twitter Sharer', 'petszone-pro'),
                                'section' => 'woocommerce-single-page-sociable-share-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-pro' ),
                                    'off' => esc_attr__( 'No', 'petszone-pro' )
                                )
                            )
                        )
                    );

                /**
                * Option : Show LinkedIn Sharer
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-linkedin]', array(
                            'type' => 'option'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-linkedin]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show LinkedIn Sharer', 'petszone-pro'),
                                'section' => 'woocommerce-single-page-sociable-share-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-pro' ),
                                    'off' => esc_attr__( 'No', 'petszone-pro' )
                                )
                            )
                        )
                    );

                /**
                * Option : Show Pinterest Sharer
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-pinterest]', array(
                            'type' => 'option'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-sharer-pinterest]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Pinterest Sharer', 'petszone-pro'),
                                'section' => 'woocommerce-single-page-sociable-share-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'petszone-pro' ),
                                    'off' => esc_attr__( 'No', 'petszone-pro' )
                                )
                            )
                        )
                    );

            /**
            * Follow
            */

                /**
                * Option : Follow Description
                */
                    $wp_customize->add_setting(
                        PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-follow-description]', array(
                            'type' => 'option'
                        )
                    );

                    $wp_customize->add_control(
                        new PetsZone_Customize_Control_Switch(
                            $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-follow-description]', array(
                                'type'    => 'wdt-description',
                                'label'   => esc_html__( 'Note :', 'petszone-pro'),
                                'section' => 'woocommerce-single-page-sociable-follow-section',
                                'description'   => esc_html__( 'This option is applicable only for WooCommerce "Custom Template".', 'petszone-pro'),
                            )
                        )
                    );

                    $social_follow = array (
                        'delicious'   => esc_html__('Delicious', 'petszone-pro'),
                        'deviantart'  => esc_html__('Deviantart', 'petszone-pro'),
                        'digg'        => esc_html__('Digg', 'petszone-pro'),
                        'dribbble'    => esc_html__('Dribbble', 'petszone-pro'),
                        'envelope'    => esc_html__('Envelope', 'petszone-pro'),
                        'facebook'    => esc_html__('Facebook', 'petszone-pro'),
                        'flickr'      => esc_html__('Flickr', 'petszone-pro'),
                        'google-plus' => esc_html__('Google Plus', 'petszone-pro'),
                        'instagram'   => esc_html__('Instagram', 'petszone-pro'),
                        'lastfm'      => esc_html__('Lastfm', 'petszone-pro'),
                        'linkedin'    => esc_html__('Linkedin', 'petszone-pro'),
                        'myspace'     => esc_html__('Myspace', 'petszone-pro'),
                        'pinterest'   => esc_html__('Pinterest', 'petszone-pro'),
                        'reddit'      => esc_html__('Reddit', 'petszone-pro'),
                        'rss'         => esc_html__('RSS', 'petszone-pro'),
                        'skype'       => esc_html__('Skype', 'petszone-pro'),
                        'stumbleupon' => esc_html__('Stumbleupon', 'petszone-pro'),
                        'tumblr'      => esc_html__('Tumblr', 'petszone-pro'),
                        'twitter'     => esc_html__('Twitter', 'petszone-pro'),
                        'viadeo'      => esc_html__('Viadeo', 'petszone-pro'),
                        'vimeo'       => esc_html__('Vimeo', 'petszone-pro'),
                        'yahoo'       => esc_html__('Yahoo', 'petszone-pro'),
                        'youtube'     => esc_html__('Youtube', 'petszone-pro')
                    );

                    foreach($social_follow as $socialfollow_key => $socialfollow) {

                        $wp_customize->add_setting(
                            PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-follow-'.$socialfollow_key.']', array(
                                'type' => 'option'
                            )
                        );

                        $wp_customize->add_control(
                            new PetsZone_Customize_Control_Switch(
                                $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-show-follow-'.$socialfollow_key.']', array(
                                    'type'    => 'wdt-switch',
                                    'label'   => sprintf(esc_html__('Show %1$s Follow', 'petszone-pro'), $socialfollow),
                                    'section' => 'woocommerce-single-page-sociable-follow-section',
                                    'choices' => array(
                                        'on'  => esc_attr__( 'Yes', 'petszone-pro' ),
                                        'off' => esc_attr__( 'No', 'petszone-pro' )
                                    )
                                )
                            )
                        );

                        $wp_customize->add_setting(
                            PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-follow-'.$socialfollow_key.'-link]', array(
                                'type' => 'option'
                            )
                        );

                        $wp_customize->add_control(
                            new PetsZone_Customize_Control(
                                $wp_customize, PETSZONE_CUSTOMISER_VAL . '[wdt-single-product-follow-'.$socialfollow_key.'-link]', array(
                                    'type'       => 'text',
                                    'section'    => 'woocommerce-single-page-sociable-follow-section',
                                    'input_attrs' => array(
                                        'placeholder' => sprintf(esc_html__('%1$s Link', 'petszone-pro'), $socialfollow)
                                    ),
                                    'dependency' => array ( 'wdt-single-product-show-follow-'.$socialfollow_key, '==', '1' )
                                )
                            )
                        );

                    }

        }

    }

}


if( !function_exists('petszone_shop_customizer_single_social_share_and_follow') ) {
	function petszone_shop_customizer_single_social_share_and_follow() {
		return PetsZone_Shop_Customizer_Single_Social_Share_And_Follow::instance();
	}
}

petszone_shop_customizer_single_social_share_and_follow();