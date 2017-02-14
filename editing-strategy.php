<?php

class AC_Addon_MLA_Editing_Strategy extends ACP_Editing_Strategy_Post {

	/**
	 * @return int[]
	 */
	public function get_rows() {
		$table = $this->column->get_list_screen()->get_list_table();
		$table->prepare_items();

		return $this->get_editable_rows( $table->items );
	}

}