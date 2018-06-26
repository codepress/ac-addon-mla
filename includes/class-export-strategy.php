<?php

class AC_Addon_MLA_Export_Strategy extends ACP\Export\Strategy\Post {

	public function modify_posts_query( $query ) {
		$per_page = $this->get_num_items_per_iteration();

		$query->set( 'nopaging', false );
		$query->set( 'offset', $this->get_export_counter() * $per_page );
		$query->set( 'posts_per_page', $per_page );
		$query->set( 'posts_per_archive_page', $per_page );
		$query->set( 'fields', 'all' );
	}

	public function catch_posts( $posts, $query ) {
		$this->export( wp_list_pluck( $posts, 'ID' ) );
	}

}