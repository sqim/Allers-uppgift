<?php

if(!function_exists('create_post_type')){
	add_action( 'init', 'create_post_type' );
	function create_post_type() {
		register_post_type( 'custom_post',
			array(
				'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
				'labels' => array(
					'name' => __( 'Custom posts' ),
					'singular_name' => __( 'custom_post' )
				),
			'public' => true,
			'has_archive' => true,
			)
		);
	}
}

?>