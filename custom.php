<?php
/*
*Funktion för att skapa en custom post type
*/
if(!function_exists('create_post_type')){
	add_action( 'init', 'create_post_type' ); //Kör create_post_type när wordpress laddat klart
	function create_post_type() {
		register_post_type( 'custom_post', //Registrera en custom post type
			array(
				'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ), //Definierar vad den ska innehålla
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