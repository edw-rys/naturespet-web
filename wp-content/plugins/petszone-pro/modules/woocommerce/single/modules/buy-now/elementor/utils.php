<?php

/*
* Update Summary - Options Filter
*/

if( ! function_exists( 'petszone_shop_woo_single_summary_options_bn_render' ) ) {
	function petszone_shop_woo_single_summary_options_bn_render( $options ) {

		$options['buy_now'] = esc_html__('Summary Buy Now', 'petszone-pro');
		return $options;

	}
	add_filter( 'petszone_shop_woo_single_summary_options', 'petszone_shop_woo_single_summary_options_bn_render', 10, 1 );

}

/*
* Update Summary - Styles Filter
*/

if( ! function_exists( 'petszone_shop_woo_single_summary_styles_bn_render' ) ) {
	function petszone_shop_woo_single_summary_styles_bn_render( $styles ) {

		array_push( $styles, 'wdt-shop-buy-now' );
		return $styles;

	}
	add_filter( 'petszone_shop_woo_single_summary_styles', 'petszone_shop_woo_single_summary_styles_bn_render', 10, 1 );

}

/*
* Update Summary - Scripts Filter
*/

if( ! function_exists( 'petszone_shop_woo_single_summary_scripts_bn_render' ) ) {
	function petszone_shop_woo_single_summary_scripts_bn_render( $scripts ) {

		array_push( $scripts, 'wdt-shop-buy-now' );
		return $scripts;

	}
	add_filter( 'petszone_shop_woo_single_summary_scripts', 'petszone_shop_woo_single_summary_scripts_bn_render', 10, 1 );

}