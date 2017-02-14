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
		add_action( 'ac/list_screens', array( $this, 'register_list_screen' ) );
		add_filter( 'acp/editing/model', array( $this, 'add_editing_strategy' ) );
	}

	/**
	 * @param ACP_Editing_Model $model
	 */
	public function add_editing_strategy( $model ) {
		if ( 'mla-media-assistant' === $model->get_column()->get_list_screen()->get_key() ) {
			require_once plugin_dir_path( __FILE__ ) . 'editing-strategy.php';

			$model->set_strategy( new AC_Addon_MLA_Editing_Strategy( $model ) );
		}

		return $model;
	}

	/**
	 * MLA list screen
	 */
	public function register_list_screen() {
		if ( ! class_exists( 'MLACore' ) ) {
			return;
		}

		require_once plugin_dir_path( __FILE__ ) . 'listscreen.php';

		AC()->register_list_screen( new AC_Addon_MLA_ListScreen );
	}

}

new AC_Addon_MLA;