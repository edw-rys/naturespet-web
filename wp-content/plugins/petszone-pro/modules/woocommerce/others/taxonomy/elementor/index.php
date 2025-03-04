<?php

/**
 * WooCommerce - Elementor Taxonomy Widgets Core Class
 */

namespace PetsZoneElementor\widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PetsZone_Shop_Elementor_Taxonomy_Widgets {

	/**
	 * A Reference to an instance of this class
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor
	 */
	function __construct() {

		add_action( 'petszone_shop_register_widgets', array( $this, 'petszone_shop_register_widgets' ), 10, 1 );

		add_action( 'petszone_shop_register_widget_styles', array( $this, 'petszone_shop_register_widget_styles' ), 10, 1 );
		add_action( 'petszone_shop_register_widget_scripts', array( $this, 'petszone_shop_register_widget_scripts' ), 10, 1 );

		add_action( 'petszone_shop_preview_styles', array( $this, 'petszone_shop_preview_styles') );

	}

	/**
	 * Register widgets
	 */
	function petszone_shop_register_widgets( $widgets_manager ) {

		require petszone_shop_others_taxonomy()->module_dir_path() . 'elementor/widgets/product-cat/class-product-cat.php';
		$widgets_manager->register( new PetsZone_Shop_Widget_Product_Cat() );

		require petszone_shop_others_taxonomy()->module_dir_path() . 'elementor/widgets/product-cat-single/class-product-cat-single.php';
		$widgets_manager->register( new PetsZone_Shop_Widget_Product_Cat_Single() );

	}

	/**
	 * Register widgets styles
	 */
	function petszone_shop_register_widget_styles( $suffix ) {

		# Product Cat
			wp_register_style( 'wdt-shop-product-cat',
				petszone_shop_others_taxonomy()->module_dir_url() . 'assets/css/style'.$suffix.'.css',
				array()
			);

		# Product Cat Single
			wp_register_style( 'wdt-shop-product-cat-single',
				petszone_shop_others_taxonomy()->module_dir_url() . 'assets/css/style'.$suffix.'.css',
				array()
			);

	}

	/**
	 * Register widgets scripts
	 */
	function petszone_shop_register_widget_scripts( $suffix ) {


	}

	/**
	 * Editor Preview Style
	 */
	function petszone_shop_preview_styles() {

		# Product Cat
			wp_enqueue_style( 'wdt-shop-product-cat' );

		# Product Cat Single
			wp_enqueue_style( 'wdt-shop-product-cat-single' );

	}

}

PetsZone_Shop_Elementor_Taxonomy_Widgets::instance();