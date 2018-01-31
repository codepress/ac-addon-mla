<?php

class AC_Addon_MLA_Editing_Strategy extends ACP_Editing_Strategy_Post {

	/**
	 * @return int[]
	 */
	public function get_rows() {
		require_once( MLA_PLUGIN_PATH . 'includes/class-mla-list-table.php' );

		$table = new MLA_List_Table();
		$table->prepare_items();

		return $this->get_editable_rows( $table->items );
	}

}