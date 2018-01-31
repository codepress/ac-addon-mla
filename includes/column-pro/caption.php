<?php

class ACP_Addon_MLA_ColumnPro_Caption extends ACP_Column_Media_Caption {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'caption' );
	}

}