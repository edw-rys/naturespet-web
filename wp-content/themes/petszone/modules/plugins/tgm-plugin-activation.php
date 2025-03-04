<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package PetsZone WordPress theme
 */

function petszone_tgmpa_plugins_register() {

	// Get array of recommended plugins.
	$plugins_list = array(
        array(
            'name'               => esc_html__('PetsZone Plus', 'petszone'),
            'slug'               => 'petszone-plus',
            'source'             => PETSZONE_MODULE_DIR . '/plugins/petszone-plus.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('PetsZone Pro', 'petszone'),
            'slug'               => 'petszone-pro',
            'source'             => PETSZONE_MODULE_DIR . '/plugins/petszone-pro.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
         array(
            'name'               => esc_html__('PetsZone Shop', 'petszone'),
            'slug'               => 'petszone-shop',
            'source'             => PETSZONE_MODULE_DIR . '/plugins/petszone-shop.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Elementor', 'petszone'),
            'slug'     => 'elementor',
            'required' => true,
        ),
          array(
            'name'     => esc_html__('One Click Demo Import', 'petszone'),
            'slug'     => 'one-click-demo-import',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Elementor Addon', 'petszone'),
            'slug'               => 'wedesigntech-elementor-addon',
            'source'             => PETSZONE_MODULE_DIR . '/plugins/wedesigntech-elementor-addon.zip',
            'required'           => true,
            'version'            => '1.0.2',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Contact Form 7', 'petszone'),
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
         array(
            'name'     => esc_html__('WooCommerce', 'petszone'),
            'slug'     => 'woocommerce',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('Variation Swatches for WooCommerce', 'petszone'),
            'slug'     => 'woo-variation-swatches',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('TI WooCommerce Wishlist', 'petszone'),
            'slug'     => 'ti-woocommerce-wishlist',
            'required' => true,
        ),
         array(
            'name'     => esc_html__('YITH WooCommerce Compare', 'petszone'),
            'slug'     => 'yith-woocommerce-compare',
            'required' => true,
        ),
         array(
            'name'     => esc_html__('YITH WooCommerce Quick View', 'petszone'),
            'slug'     => 'yith-woocommerce-quick-view',
            'required' => true,
        )
	);

    $plugins = apply_filters('petszone_required_plugins_list', $plugins_list);

	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'petszone_theme',
		'domain'       => 'petszone',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );

}
add_action( 'tgmpa_register', 'petszone_tgmpa_plugins_register' );