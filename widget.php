<?php

class show_custom_post_widget extends WP_Widget {
	
	// constructor
	function show_custom_post_widget() {
		parent::WP_Widget(false, $name = __('Show custom post', 'show_custom_post_widget') );
	}

	public function get_custom_posts($post_per_page){
		//vilken typ av post ska hämtas
		$args = array( 'post_type' => 'custom_post', 'posts_per_page' => $post_per_page );
		//hämta posts
		$posts = get_posts( $args );
		return $posts;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'post_per_page' ] ) ) { //om post_per_page har ett värde
			$post_per_page = $instance[ 'post_per_page' ];//populera input fältet
		}
		else {
			$post_per_page = __( '3', 'text_domain' ); //placeholder siffra för input fält
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'post_per_page' ); ?>"><?php _e( 'Antal poster:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'post_per_page' ); ?>" name="<?php echo $this->get_field_name( 'post_per_page' ); ?>" type="text" value="<?php echo esc_attr( $post_per_page ); ?>">
		</p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['post_per_page'] = ( ! empty( $new_instance['post_per_page'] ) ) ? strip_tags( $new_instance['post_per_page'] ) : ''; //ifall post_per_page data finns så gör en ny instans
		return $instance;
	}
	public function get_post_per_page($instance){
		//hämta antal poster som ska visas från widget-settings
		$post_per_page = $instance;
		return $post_per_page;
	}
	public function get_excerpt_by_id($post_id, $length) {

	$the_post = get_post($post_id); //Hämtar post ID
	$the_excerpt = $the_post->post_content; //Hämtar post_content som används som bas till sammanfattning
	$excerpt_length = $length; //Längden på sammanfattningen
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Tar bort taggar och bilder
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);
		if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '…');
		$the_excerpt = implode(' ', $words);
		endif;
	$the_excerpt = '<p class="postexcerpt lead">' . $the_excerpt . '</p>';
	return $the_excerpt;

	}
	public function widget($args, $instance){

		$posts = $this->get_custom_posts($this->get_post_per_page($instance['post_per_page'])); //hämtar poster och skickar in antal poster från wp_settings
		$html = array(); 
		foreach ($posts as $post) { //loopar igenom alla poster
			$html[] = $post->post_title; //hämtar postens titel
			if(has_post_thumbnail( $post->ID )){//kollar ifall posten har en bild
				$html[] = get_the_post_thumbnail( $post->ID, array(50, 50)); //hämtar post bild
			}
			$excerpt = $this->get_excerpt_by_id($post->ID, 50); //hämtar en sammanfattning av postens innehåll
			$html[] = $excerpt;
		}
		$output = implode(" ", $html); //gör om array till sträng
		echo $output; //visar ut html
	}

}
// registrerar widgeten
add_action('widgets_init', create_function('', 'return register_widget("show_custom_post_widget");'));
?>