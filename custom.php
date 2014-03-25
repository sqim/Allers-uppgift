<?php
/**
 * Create custom posts
 * @return Function
 *   Returns wordpress functions with settings
 */
if(!function_exists('create_post_type')){
  add_action( 'init', 'create_post_type' ); //Runs create_post_type when wordpress has finished loading 
  function create_post_type() {
    register_post_type( 'custom_post', //Register a custom post type
    array(
      'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ), //Defines what it will contain
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