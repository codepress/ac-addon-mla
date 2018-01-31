<?php
/*
Plugin Name: 		Admin Columns - Media Library Assistant
Version: 			1.1
Description: 		Compatibility add-on for Media Library Assistant
Author: 			Codepress
Author URI: 		https://admincolumns.com
Text Domain: 		codepress-admin-columns
*/

defined( 'ABSPATH' ) or die();

define( 'ADDON_MLA_FILE', __FILE__ );

class AC_Addon_MLA {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'init' ) );
	}

	public function init() {
		if ( ! class_exists( 'MLACore' ) ) {
			return;
		}

		// Listscreen
		add_action( 'ac/list_screens', array( $this, 'register_list_screen' ) );
		add_action( 'acp/list_screens', array( $this, 'register_list_screen_pro' ) );

		// Columns
		add_filter( 'ac/column/custom_field/meta_keys', array( $this, 'remove_custom_columns' ) );

		// Export
		add_action( 'ac/table/list_screen', array( $this, 'export_table_global' ) );
	}

	public static function get_plugin_dir() {
		return plugin_dir_path( __FILE__ ) . 'includes/';
	}

	/**
	 * MLA list screen
	 */
	public function register_list_screen() {
		require_once self::get_plugin_dir() . 'class-listscreen.php';

		AC()->register_list_screen( new AC_Addon_MLA_ListScreen );
	}

	/**
	 * MLA list screen
	 */
	public function register_list_screen_pro() {
		require_once self::get_plugin_dir() . 'class-listscreen.php';
		require_once self::get_plugin_dir() . 'class-listscreen-pro.php';

		AC()->register_list_screen( new AC_Addon_MLA_ListScreen_Pro );
	}

	/**
	 * Remove duplicate columns from the Admin Columns "Custom" section
	 *
	 * @since 2.52
	 *
	 * @param array $keys Distinct meta keys from DB
	 */
	public static function remove_custom_columns( $keys ) {
		// Find the fields already present in the submenu table
		$mla_columns = apply_filters( 'mla_list_table_get_columns', MLAQuery::$default_columns );
		$mla_custom = array();
		foreach ( $mla_columns as $slug => $heading ) {
			if ( 'c_' === substr( $slug, 0, 2 ) ) {
				$mla_custom[] = $heading;
			}
		}

		// Remove the fields already present in the submenu table
		foreach ( $keys as $index => $value ) {
			if ( in_array( esc_html( $value ), $mla_custom ) ) {
				unset( $keys[ $index ] );
			}
		}

		return $keys;
	}

	/**
	 * Currently the MLA_List_Table prepare query is loaded after the <head>.
	 *
	 * When exporting the same page is being requested by an ajax request and triggers the filter 'the_posts'.
	 * The callback for this filter will print a json string. This needs to be done before any rendering of the page.
	 *
	 *  Also, export needs the $GLOBALS['wp_list_table'] to be populated for displaying the export button.
	 *
	 * @param AC_ListScreen $list_screen
	 */
	public function export_table_global( AC_ListScreen $list_screen ) {
		if ( ! $list_screen instanceof AC_Addon_MLA_ListScreen_Pro ) {
			return;
		}

		global $wp_list_table;

		require_once( MLA_PLUGIN_PATH . 'includes/class-mla-list-table.php' );

		$wp_list_table = new MLA_List_Table();
		$wp_list_table->prepare_items();
	}

}

new AC_Addon_MLA;