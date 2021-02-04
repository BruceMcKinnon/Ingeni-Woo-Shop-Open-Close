<?php
/*
Plugin Name: Ingeni Woocommerce Shop Open and Close
Version: 2021.02
Plugin URI: http://ingeni.net
Author: Bruce McKinnon - ingeni.net
Author URI: http://ingeni.net
Description: Open or Close the Woocommerce shop front.
*/

/*
Copyright (c) 2021 ingeni.net
Released under the GPL license
http://www.gnu.org/licenses/gpl.txt

Disclaimer: 
	Use at your own risk. No warranty expressed or implied is provided.
	This program is free software; you can redistribute it and/or modify 
	it under the terms of the GNU General Public License as published by 
	the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
 	See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA


Requires : Wordpress 3.x or newer ,PHP 5 +

*/

//
// Filter the General settings of Woocommerce
//
add_filter( 'woocommerce_general_settings', 'add_order_number_start_setting' );

function add_order_number_start_setting( $settings ) {
  $updated_settings = array();

  foreach ( $settings as $section ) {
    // at the bottom of the General Options section
    if ( isset( $section['id'] ) && 'general_options' == $section['id'] &&

			isset( $section['type'] ) && 'sectionend' == $section['type'] ) {
				$updated_settings[] = array(
					'name'     => __( 'Shop is Closed', 'wc_ingeni_shop_closed' ),
					'desc_tip' => __( 'Check this box to Close your store front', 'wc_ingeni_shop_closed' ),
					'id'       => 'woocommerce_ingeni_shop_closed',
					'type'     => 'checkbox',
					'css'      => 'min-width:300px;',
					'desc'     => __( 'Check this box to Close your store front', 'wc_ingeni_shop_closed'  ),
				);
		}

    $updated_settings[] = $section;
  }
  return $updated_settings;
}


// Allow closing of the shop as required
add_action('woocommerce_before_shop_loop','ingeni_woo_shop_start');
add_action('woocommerce_before_add_to_cart_button','ingeni_woo_shop_start');
function ingeni_woo_shop_start() {
  $closed = get_option( 'woocommerce_ingeni_shop_closed');
  $extra_class = "shop_open";
  if ( ( $closed === 'yes' ) || ($closed == 1) || ($closed === true) ) {
    $extra_class = "shop_closed";
  }

  echo ( '<div class="'.$extra_class.'">' );
}
// Allow closing of the shop as required
add_action('woocommerce_after_shop_loop','ingeni_woo_shop_end');
add_action('woocommerce_after_add_to_cart_button','ingeni_woo_shop_end');
function ingeni_woo_shop_end() {
  echo ( '</div>' );
	$closed = get_option( 'woocommerce_ingeni_shop_closed');
		if ( ( $closed === 'yes' ) || ($closed == 1) || ($closed === true) ) {
			echo ( '<div class="shop_closed_after"> </div>');
		}
}


function ingeni_load_shop_open() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'shop-open', $plugin_url . 'ingeni-woo-shop-open.css', false ); 


	// Init auto-update from GitHub repo
	require 'plugin-update-checker/plugin-update-checker.php';
	$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/BruceMcKinnon/Ingeni-Woo-Shop-Open-Close',
		__FILE__,
		'Ingeni-Woo-Shop-Open-Close'
	);
}
add_action( 'wp_enqueue_scripts', 'ingeni_load_shop_open' );



// Plugin activation/deactivation hooks
function ingeni_shop_open_activation() {
  flush_rewrite_rules( false );
}
register_activation_hook(__FILE__, 'ingeni_shop_open_activation');

function ingeni_shop_open_deactivation() {
  flush_rewrite_rules( false );
}
register_deactivation_hook( __FILE__, 'ingeni_shop_open_deactivation' );

?>