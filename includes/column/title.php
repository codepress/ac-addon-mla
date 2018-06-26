<?php

class ACP_Addon_MLA_Column_Title extends AC\Column\Media\Title {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'post_title' );
	}

}