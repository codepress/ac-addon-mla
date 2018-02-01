<?php

defined( 'ABSPATH' ) or die();

class AC_Addon_MLA_ListScreen_Pro extends AC_Addon_MLA_ListScreen
	implements ACP_Editing_ListScreen, ACP_Export_ListScreen {

	public function editing( $model ) {
		require_once( AC_Addon_MLA::get_plugin_dir() . 'class-editing-strategy.php' );

		return new AC_Addon_MLA_Editing_Strategy( $model );
	}

	public function export() {
		require_once( AC_Addon_MLA::get_plugin_dir() . 'class-export-strategy.php' );

		return new AC_Addon_MLA_Export_Strategy( $this );
	}

	public function register_column_types() {
		parent::register_column_types();

		$this->register_column_type( new ACP_Column_CustomField );
		$this->register_column_type( new ACP_Column_Menu );

		$columns = array(
			'alt-text.php'   => 'ACP_Addon_MLA_ColumnPro_AltText',
			'caption.php'    => 'ACP_Addon_MLA_ColumnPro_Caption',
			'menu-order.php' => 'ACP_Addon_MLA_ColumnPro_MenuOrder',
			'title.php'      => 'ACP_Addon_MLA_ColumnPro_Title',
		);

		foreach ( $columns as $file => $column ) {
			require_once( AC_Addon_MLA::get_plugin_dir() . 'column-pro/' . $file );

			$this->register_column_type( new $column );
		}
	}

}