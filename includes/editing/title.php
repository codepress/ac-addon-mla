<?php

class ACP_Addon_MLA_Editing_Model_Media_Title extends ACP\Editing\Model\Media\Title {

	/**
	 * Remove JavaScript selector settings
	 */
	public function get_view_settings() {
		return array(
			'type'         => 'text',
			'display_ajax' => false,
		);
	}
}