<?php

class ACP_Addon_MLA_ColumnPro_AltText extends ACP_Column_Media_AlternateText {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'alt_text' );
	}

}