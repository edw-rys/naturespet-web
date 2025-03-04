<?php
/**
 * Plugin Name:	PetsZone Shop
 * Description: Adds shop features for PetsZone Theme.
 * Version: 1.0.0
 * Author: the WeDesignTech team
 * Author URI: https://wedesignthemes.com/
 * Text Domain: petszone-shop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * The main class that initiates and runs the plugin.
 */
final class PetsZone_Shop {

	/**
	 * Instance variable
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
	public function __construct() {

		add_action( 'init', array( $this, 'petszone_shop_i18n' ) );
		add_filter( 'petszone_required_plugins_list', array( $this, 'upadate_required_plugins_list' ) );
		add_action( 'plugins_loaded', array( $this, 'petszone_shop_plugins_loaded' ) );

	}

	/**
	 * Load Textdomain
	 */
		public function petszone_shop_i18n() {

			load_plugin_textdomain( 'petszone-shop', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

	/**
	 * Update required plugins list
	 */
		function upadate_required_plugins_list($plugins_list) {

            $required_plugins = array(
                array(
                    'name'				=> 'WooCommerce',
                    'slug'				=> 'woocommerce',
                    'required'			=> true,
                    'force_activation'	=> false,
                )
            );
            $new_plugins_list = array_merge($plugins_list, $required_plugins);

            return $new_plugins_list;

        }

	/**
	 * Initialize the plugin
	 */
		public function petszone_shop_plugins_loaded() {

			// Check for WooCommerce plugin
				if( !function_exists( 'is_woocommerce' ) ) {
					add_action( 'admin_notices', array( $this, 'petszone_shop_woo_plugin_req' ) );
					return;
				}

			// Check for PetsZone Theme plugin
				if( !function_exists( 'petszone_pro' ) ) {
					add_action( 'admin_notices', array( $this, 'petszone_shop_dttheme_plugin_req' ) );
					return;
				}

			// Setup Constants
				$this->petszone_shop_setup_constants();

			// Load Modules & Helper
				$this->petszone_shop_load_modules();
                $this->load_helper();

			// Locate Module Files
				add_filter( 'petszone_woo_pro_locate_file',  array( $this, 'petszone_woo_pro_shop_locate_file' ), 10, 2 );

			// Load WooCommerce Template Files
				add_filter( 'woocommerce_locate_template',  array( $this, 'petszone_shop_woocommerce_locate_template' ), 30, 3 );

		}


	/**
	 * Admin notice
	 * Warning when the site doesn't have WooCommerce plugin.
	 */
		public function petszone_shop_woo_plugin_req() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: Required plugin name */
				esc_html__( '"%1$s" requires "%2$s" plugin to be installed and activated.', 'petszone-shop' ),
				'<strong>' . esc_html__( 'PetsZone Shop', 'petszone-shop' ) . '</strong>',
				'<strong>' . esc_html__( 'WooCommerce - excelling eCommerce', 'petszone-shop' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

	/**
	 * Admin notice
	 * Warning when the site doesn't have PetsZone Theme plugin.
	 */
		public function petszone_shop_dttheme_plugin_req() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: Required plugin name */
				esc_html__( '"%1$s" requires "%2$s" plugin to be installed and activated.', 'petszone-shop' ),
				'<strong>' . esc_html__( 'PetsZone Shop', 'petszone-shop' ) . '</strong>',
				'<strong>' . esc_html__( 'PetsZone Pro', 'petszone-shop' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

	/**
	 * Define constant if not already set.
	 */
		public function petszone_shop_define_constants( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

	/**
	 * Configure Constants
	 */
		public function petszone_shop_setup_constants() {

			$this->petszone_shop_define_constants( 'PETSZONE_SHOP_VERSION', '1.0' );
			$this->petszone_shop_define_constants( 'PETSZONE_SHOP_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
			$this->petszone_shop_define_constants( 'PETSZONE_SHOP_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
			$this->petszone_shop_define_constants( 'PETSZONE_SHOP_NAME', esc_html__('PetsZone Shop', 'petszone-shop') );

			$this->petszone_shop_define_constants( 'PETSZONE_SHOP_MODULE_PATH', trailingslashit( PETSZONE_SHOP_PATH . 'modules' ) );
			$this->petszone_shop_define_constants( 'PETSZONE_SHOP_MODULE_URL', trailingslashit( PETSZONE_SHOP_URL . 'modules' ) );

		}

	/**
	 * Load Modules
	 */
		public function petszone_shop_load_modules() {

			foreach( glob( PETSZONE_SHOP_MODULE_PATH. '*/index.php' ) as $module ) {
				include_once $module;
			}

		}

	/**
	 * Locate Module Files
	 */
		public function petszone_woo_pro_shop_locate_file( $file_path, $module ) {

			$file_path = PETSZONE_SHOP_PATH . 'modules/' . $module .'.php';

			$located_file_path = false;
			if ( $file_path && file_exists( $file_path ) ) {
				$located_file_path = $file_path;
			}

			return $located_file_path;

		}

	/**
	 * Override WooCommerce default template files
	 */
		public function petszone_shop_woocommerce_locate_template( $template, $template_name, $template_path ) {

			global $woocommerce;

			$_template = $template;

			if ( ! $template_path ) $template_path = $woocommerce->template_url;

			$plugin_path  = PETSZONE_SHOP_PATH . 'templates/';

			// Look within passed path within the theme - this is priority
			$template = locate_template(
				array(
					$template_path . $template_name,
					$template_name
				)
			);

			// Modification: Get the template from this plugin, if it exists
			if ( ! $template && file_exists( $plugin_path . $template_name ) )
			$template = $plugin_path . $template_name;

			// Use default template
			if ( ! $template )
			$template = $_template;

			// Return what we found
			return $template;

		}

	/**
	 * Load helper
	 */
        function load_helper() {
            require_once PETSZONE_SHOP_PATH . 'functions.php';
        }

}

if( !function_exists('petszone_shop_instance') ) {
	function petszone_shop_instance() {
		return PetsZone_Shop::instance();
	}
}

petszone_shop_instance();