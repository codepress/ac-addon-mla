<?php

class ACP_Addon_MLA_Column_MenuOrder extends AC_Column_Post_Order {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'menu_order' );
	}

}