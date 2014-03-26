<?php

class Show_Custom_Post_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name
	 */
	function show_custom_post_widget() {
		parent::WP_Widget(false, $name = __('Show custom post', 'show_custom_post_widget') );
	}

	/**
   * Get custom posts
   *
   * @param Int $post_per_page
   *   Number of posts to fetch
   * @return Array
   *   Returns an array of posts
   */
   public function get_custom_posts($post_per_page){
		$args = array( 'post_type' => 'custom_post', 'posts_per_page' => $post_per_page );//Gets our custom post
		//hämta posts
		$posts = get_posts( $args );
		return $posts;
	}

	/**
   * Widget Form
   *
   * @param Array $instance
   *   Number of posts to fetch
   * @return Html
   *   Returns form field
   */
	public function form( $instance ) {
		if ( isset( $instance[ 'post_per_page' ] ) ) { //if post_per_page has a value
			$post_per_page = $instance[ 'post_per_page' ];//populate input field
		}
		else {
			$post_per_page = __( '3', 'text_domain' ); //placeholder
		}
    include PLUGIN_BASE_DIR_LONG . '/templates/tpl.form.php';
    }

	/**
   * Update settings
   *
   * @param Array $new_instance
   *   New settings
   * @param Array $old_instance
   *   Old settings
   * @return Array
   *   Returns settings
   */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['post_per_page'] = ( ! empty( $new_instance['post_per_page'] ) ) ? strip_tags( $new_instance['post_per_page'] ) : ''; //If post_per_page data exists make a new instance
		return $instance;
	}
	/**
   * Get settings for post per page 
   *
   * @param Array $instance
   *   Number of post per page
   * @return Array
   *   Returns post per page
   */
	public function get_post_per_page($instance){
		$post_per_page = $instance;
		return $post_per_page;
	}

		/**
   * Get excerpt version of post
   *
   * @param Int $post_id
   *   Post ID
   * @param Int $length
   *   Length of excerpt
   * @return Html
   *   Returns excerpt of post
   */
	public function get_excerpt_by_id($post_id, $length) {

		$the_post = get_post($post_id); //Get post ID
		$the_excerpt = $the_post->post_content; //Get post_content that is used for excerpt
		$excerpt_length = $length; //Length of excerpt
		$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //strips tags and images
		$words = explode(' ', $the_excerpt, $excerpt_length + 1);
		if(count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '…');
			$the_excerpt = implode(' ', $words);
		}
		$the_excerpt = '<p class="postexcerpt lead">' . $the_excerpt . '</p>';
		return $the_excerpt;

	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 * Number of posts per page
	 */
	public function widget($args, $instance){

		$posts = $this->get_custom_posts($this->get_post_per_page($instance['post_per_page'])); // Get posts according to number of posts from settings 
		$html = array(); 
		foreach ($posts as $post) { 
			$html[] = $post->post_title; 
			if(has_post_thumbnail( $post->ID )){
				$html[] = get_the_post_thumbnail( $post->ID, array(50, 50));
			}
			$excerpt = $this->get_excerpt_by_id($post->ID, 50);
			$html[] = $excerpt;
		}
		$output = implode(" ", $html);
		echo $output; //shows html
	}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("show_custom_post_widget");'));
?>