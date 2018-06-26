<?php

class ACP_Addon_MLA_ColumnPro_Title extends ACP\Column\Media\Title {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'post_title' );
	}

	public function editing() {
		require_once( AC_Addon_MLA::get_plugin_dir() . 'editing/title.php' );

		return new ACP_Addon_MLA_Editing_Model_Media_Title( $this );
	}

}