<?php

defined( 'ABSPATH' ) or die();

class AC_Addon_MLA_ListScreen extends AC_ListScreen_Media {

	public function __construct() {
		parent::__construct();

		$this->set_key( 'mla-media-assistant' );
		$this->set_label( __( 'Media Library Assistant' ) );
		$this->set_singular_label( __( 'Assistant' ) );
		$this->set_screen_id( 'media_page_' . MLACore::ADMIN_PAGE_SLUG );
		$this->set_page( MLACore::ADMIN_PAGE_SLUG );
	}

	/**
	 * Trigger callback that renders the column's value
	 */
	public function set_manage_value_callback() {
		add_filter( 'mla_list_table_column_default', array( $this, 'column_default_value' ), 100, 3 );
	}

	/**
	 * @param string|null $content
	 * @param WP_Post     $object
	 * @param string      $column_name
	 *
	 * @return string|false
	 */
	public function column_default_value( $content, $post, $column_name ) {
		if ( is_null( $content ) ) {
			$content = $this->get_display_value_by_column_name( $column_name, $post->ID );
		}

		return $content;
	}

	/**
	 * @param array $args
	 *
	 * @return mixed
	 */
	public function get_list_table( $args = array() ) {
		require_once( MLA_PLUGIN_PATH . 'includes/class-mla-list-table.php' );

		MLA_List_Table::mla_admin_init_action();

		return new MLA_List_Table();
	}

	public function is_current_screen( $wp_screen ) {
		return $wp_screen && $wp_screen->id === $this->get_screen_id();
	}

	protected function remove_columns() {
		$columns = array(
			'comments',
			'title',
			'column-actions',
			'column-alternate_text',
			'column-attached_to',
			'column-author_name',
			'column-caption',
			'column-description',
			'column-file_name',
			'column-full_path',
			'column-mediaid',
			'column-mime_type',
			'column-taxonomy',
		);

		foreach ( $columns as $column ) {
			$this->deregister_column_type( $column );
		}
	}

	public function register_column_types() {
		parent::register_column_types();

		$this->remove_columns();

		$columns = array(
			'alt-text.php'   => 'ACP_Addon_MLA_Column_AltText',
			'caption.php'    => 'ACP_Addon_MLA_Column_Caption',
			'menu-order.php' => 'ACP_Addon_MLA_Column_MenuOrder',
			'title.php'      => 'ACP_Addon_MLA_Column_Title',
		);

		foreach ( $columns as $file => $column ) {
			require_once( AC_Addon_MLA::get_plugin_dir() . 'column/' . $file );

			$this->register_column_type( new $column );
		}
	}

}