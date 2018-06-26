<?php

class ACP_Addon_MLA_ColumnPro_MenuOrder extends ACP\Column\Post\Order {

	public function __construct() {
		$this->set_original( true );
		$this->set_type( 'menu_order' );
	}

}