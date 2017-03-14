<?php
/*
Plugin Name: 		Admin Columns - Media Library Assistant add-on
Version: 			1.0
Description: 		Compatibility add-on for Media Library Assistant
Author: 			Codepress
Author URI: 		https://admincolumns.com
Text Domain: 		codepress-admin-columns
*/

defined( 'ABSPATH' ) or die();

class AC_Addon_MLA {

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function init() {
		if ( ! class_exists( 'MLACore' ) ) {
			return;
		}

		add_action( 'ac/list_screens', array( $this, 'register_list_screen' ) );
		add_filter( 'acp/editing/model', array( $this, 'add_editing_strategy' ) );
		add_action( 'ac/column_types', array( $this, 'remove_column_types' ) );
		add_action( 'acp/column_types', array( $this, 'remove_column_types' ) );
	}

	/**
	 * Editing strategy for MLA
	 *
	 * @param ACP_Editing_Model $model
	 */
	public function add_editing_strategy( $model ) {
		if ( $model->get_column()->get_list_screen() instanceof AC_Addon_MLA_ListScreen ) {

			require_once plugin_dir_path( __FILE__ ) . 'editing-strategy.php';

			$model->set_strategy( new AC_Addon_MLA_Editing_Strategy( $model ) );
		}

		return $model;
	}

	/**
	 * MLA list screen
	 */
	public function register_list_screen() {
		require_once plugin_dir_path( __FILE__ ) . 'listscreen.php';

		AC()->register_list_screen( new AC_Addon_MLA_ListScreen );
	}

	/**
	 * @param AC_ListScreen $listscreen
	 */
	public function remove_column_types( $listscreen ) {
		if ( $listscreen instanceof AC_Addon_MLA_ListScreen ) {

			$exclude = array(
				'column-description',
				'column-caption',
				'column-mime_type',
			);

			foreach ( $exclude as $column_type ) {
				$listscreen->deregister_column_type( $column_type );
			}
		}
	}

}

new AC_Addon_MLA;