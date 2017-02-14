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

		/** @see MLA_List_Table */
		$this->set_list_table_class( 'MLA_List_Table' );
	}

	public function set_manage_value_callback() {
		add_filter( 'mla_list_table_column_default', array( $this, 'column_default_value' ), 100, 3 );
	}

	/**
	 * @return array
	 */
	public function get_column_headers() {
		if ( ! class_exists( 'MLAQuery' ) ) {
			require_once( MLA_PLUGIN_PATH . 'includes/class-mla-data-query.php' );
			MLAQuery::initialize();
		}

		return apply_filters( 'mla_list_table_get_columns', MLAQuery::$default_columns );
	}

	/**
	 * @param string|null $content
	 * @param WP_Post $object
	 * @param string $column_name
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
		$class = $this->get_list_table_class();

		if ( ! class_exists( $class ) ) {
			require_once( MLA_PLUGIN_PATH . 'includes/class-mla-list-table.php' );
		}

		return new $class;
	}

}