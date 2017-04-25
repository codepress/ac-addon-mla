<?php

class ACA_MLA_Column_MenuOrder extends AC_Column
	implements ACP_Column_EditingInterface {

	public function __construct() {

		// Mark as an existing column
		$this->set_original( true );

		// Type of column
		$this->set_type( 'menu_order' );
	}

	/**
	 * Add inline editing support
	 *
	 * @return ACP_Editing_Model_Post_Order
	 */
	public function editing() {
		return new ACP_Editing_Model_Post_Order( $this );
	}

}