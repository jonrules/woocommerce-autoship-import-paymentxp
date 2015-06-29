<?php
/*
Plugin Name: WC Autoship Import PaymentXP
Plugin URI: http://wooautoship.com
Description: Import autoship schedules for PaymentXP customers
Version: 1.0.0
Author: Patterns in the Cloud
Author URI: http://patternsinthecloud.com
License: Single-site
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce-autoship/woocommerce-autoship.php' ) ) {
	
	function wc_autoship_import_paymentxp_install() {

	}
	register_activation_hook( __FILE__, 'wc_autoship_import_paymentxp_install' );
	
	function wc_autoship_import_paymentxp_deactivate() {
	
	}
	register_deactivation_hook( __FILE__, 'wc_autoship_import_paymentxp_deactivate' );
	
	function wc_autoship_import_paymentxp_uninstall() {

	}
	register_uninstall_hook( __FILE__, 'wc_autoship_import_paymentxp_uninstall' );
	
	function wc_autoship_import_paymentxp_admin_scripts() {
		wp_enqueue_style( 'wc-autoship-import-paymentxp-admin', plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), '1.0.0' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'wc-autoship-import-paymentxp-admin', plugin_dir_url( __FILE__ ) . 'js/admin.js', array('jquery'), '1.0.0', true );
	}
	add_action( 'admin_enqueue_scripts', 'wc_autoship_import_paymentxp_admin_scripts' );
	
	function wc_autoship_import_paymentxp_settings( $settings ) {
		$settings[] = array(
			'title' => __( 'Import PaymentXP', 'wc-autoship-import-paymentxp' ),
			'desc' => __( 'Import autoship schedules for PaymentXP customers.', 'wc-autoship-import-paymentxp' ),
			'desc_tip' => false,
			'type' => 'title',
			'id' => 'wc_autoship_import_paymentxp_title'
		);
		$settings[] = array(
			'name' => __( 'Import File', 'wc-autoship-import-paymentxp' ),
			'desc' => __( 'The Autoship CSV file to import', 'wc-autoship-import-paymentxp' ),
			'desc_tip' => true,
			'type' => 'wc_autoship_import_paymentxp_file',
			'id' => 'wc_autoship_import_paymentxp_file'
		);
		$settings[] = array(
			'type' => 'sectionend',
			'id' => 'wc_autoship_import_paymentxp_sectionend'
		);
		return $settings;
	}
	add_filter( 'wc_autoship_settings', 'wc_autoship_import_paymentxp_settings', 10, 1 );
	
	function wc_autoship_import_paymentxp_file( $value ) {
		$vars = array(
			'value' => $value,
			'description' => WC_Admin_Settings::get_field_description( $value ),
			'frequency_options' => get_option( $value['id'] )
		);
		$relative_path = 'admin/wc-settings/wc-autoship/import-paymentxp-file';
		wc_autoship_import_paymentxp_include_plugin_template( $relative_path, $vars );
	}
	add_action( 'woocommerce_admin_field_wc_autoship_import_paymentxp_file', 'wc_autoship_import_paymentxp_file' );
	
	function wc_autoship_import_paymentxp_get_plugin_template_path( $relative_path ) {
		return plugin_dir_path( __FILE__ ) . 'templates/' . $relative_path . '.php';
	}
	
	function wc_autoship_import_paymentxp_include_plugin_template( $relative_path, $vars = array() ) {
		extract( $vars );
		include ( wc_autoship_import_paymentxp_get_plugin_template_path( $relative_path, $vars ) );
	}
}
