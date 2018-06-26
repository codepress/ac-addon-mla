<?php

class ACP_Addon_MLA_ColumnPro_AltText extends ACP\Column\Media\AlternateText {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'alt_text' );
	}

}