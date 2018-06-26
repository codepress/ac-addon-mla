<?php

class ACP_Addon_MLA_Column_AltText extends AC\Column\Media\AlternateText {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'alt_text' );
	}

}