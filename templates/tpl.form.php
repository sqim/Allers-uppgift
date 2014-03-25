<p>
	<label for="<?php echo $this->get_field_id( 'post_per_page' ); ?>"><?php _e( 'Antal poster:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'post_per_page' ); ?>" name="<?php echo $this->get_field_name( 'post_per_page' ); ?>" type="text" value="<?php echo esc_attr( $post_per_page ); ?>">
</p>