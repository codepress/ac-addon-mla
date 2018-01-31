<?php

class ACP_Addon_MLA_Column_Caption extends AC_Column_Media_Caption {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'caption' );
	}

}