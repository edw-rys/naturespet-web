<?php

/**
 * WooCommerce - Elementor Single Widgets Core Class
 */

namespace PetsZoneElementor\widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PetsZone_Shop_Elementor_Others_Size_Guide_Widgets {

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

		$this->petszone_shop_load_cpetszone_modules();

		add_action( 'petszone_shop_register_widget_styles', array( $this, 'petszone_shop_register_widget_styles' ), 10, 1 );
		add_action( 'petszone_shop_register_widget_scripts', array( $this, 'petszone_shop_register_widget_scripts' ), 10, 1 );

		add_action( 'petszone_shop_preview_styles', array( $this, 'petszone_shop_preview_styles') );

	}

	/**
	 * Init
	 */
	function petszone_shop_load_cpetszone_modules() {

		require petszone_shop_others_size_guide()->module_dir_path() . 'elementor/utils.php';

	}

	/**
	 * Register widgets styles
	 */
	function petszone_shop_register_widget_styles( $suffix ) {

		wp_register_style( 'swiper',
			petszone_shop_others_size_guide()->module_dir_url() . 'assets/css/swiper.min'.$suffix.'.css',
			array()
		);

		wp_register_style( 'wdt-shop-size-guide',
			petszone_shop_others_size_guide()->module_dir_url() . 'assets/css/style'.$suffix.'.css',
			array()
		);

	}

	/**
	 * Register widgets scripts
	 */
	function petszone_shop_register_widget_scripts( $suffix ) {

		wp_register_script( 'jquery-swiper',
			petszone_shop_others_size_guide()->module_dir_url() . 'assets/js/swiper.min'.$suffix.'.js',
			array( 'jquery' ),
			false,
			true
		);

		wp_register_script( 'wdt-shop-size-guide',
			petszone_shop_others_size_guide()->module_dir_url() . 'assets/js/scripts'.$suffix.'.js',
			array( 'jquery' ),
			false,
			true
		);

	}

	/**
	 * Editor Preview Style
	 */
	function petszone_shop_preview_styles() {

		wp_enqueue_style( 'wdt-shop-size-guide' );

	}

}

PetsZone_Shop_Elementor_Others_Size_Guide_Widgets::instance();