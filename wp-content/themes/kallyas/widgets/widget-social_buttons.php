<?php

/**
 * Text widget class
 *
 * @since 2.8.0
 */

class ZN_Widget_Social_Buttons extends WP_Widget {



	function __construct() { 

		$widget_ops = array('classname' => 'widget_social_buttons', 'description' => __('This widget will display your desired social buttons.',THEMENAME));

		$control_ops = array('width' => 400, 'height' => 350);

		parent::__construct('social_buttons', __('['.THEMENAME.'] Social Buttons Widget'), $widget_ops, $control_ops);

	}



	function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$facebook = empty( $instance['facebook'] ) ? '' : $instance['facebook'] ;
		$twitter = empty( $instance['twitter'] ) ? '' : $instance['twitter'] ;
		$gplus = empty( $instance['gplus'] ) ? '' : $instance['gplus'] ;
		$pinterest = empty( $instance['pinterest'] ) ? '' : $instance['pinterest'] ;
		
		$facebook_page = empty( $instance['facebook_page'] ) ? '' : $instance['facebook_page'] ;

		$twitter_username = empty( $instance['twitter_username'] ) ? '' : $instance['twitter_username'] ;
		$twitter_text = empty( $instance['twitter_text'] ) ? '' : $instance['twitter_text'] ;
		$twitter_hastag = empty( $instance['twitter_hastag'] ) ? '' : $instance['twitter_hastag'] ;
		
		$pin_image = empty( $instance['pin_image'] ) ? '' : urlencode ($instance['pin_image']) ;
		$pin_desc = empty( $instance['pin_desc'] ) ? '' : urlencode ($instance['pin_desc']) ;
		$pin_url = urlencode (current_page_url());

		echo $before_widget;

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>

			<ul class="social-share fixclear">
				<?php 
				
				if ( !empty ( $facebook ) && !empty( $facebook_page ) ) {
					echo '<li class="sc-facebook">';
					echo '<div class="fb-like" data-href="http://facebook.com/'.$facebook_page.'" data-send="false" data-layout="button_count" data-width="120" data-show-faces="false" data-font="lucida grande"></div>';
					echo '</li><!-- facebook like -->';
				}
				
				if ( !empty ( $twitter ) && !empty ( $twitter_username ) && !empty ( $twitter_text ) && !empty ( $twitter_hastag ) ) {
					echo '<li class="sc-twitter">';
					echo '<a href="https://twitter.com/share" class="twitter-share-button" data-text="'.$twitter_text.'" data-via="'.$twitter_username.'" data-hashtags="'.$twitter_hastag.'">Tweet</a>';
					echo '</li><!-- twitter  -->';
				}
				
				if ( !empty ( $gplus ) ) {
					echo '<li class="sc-gplus">';
					echo '<script type="text/javascript">';
					echo "						
							(function() {
							var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							po.src = 'https://apis.google.com/js/plusone.js';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							})();
						";
					echo '</script>';
					echo '<div class="g-plusone" data-size="medium"></div>';
					echo '</li><!-- Gplus like -->';
				}
				

				
				if ( !empty ( $pinterest ) && !empty ( $pin_image ) && !empty ( $pin_desc ) ) {
					echo '<li class="sc-pinterest">';
					echo '<a href="http://pinterest.com/pin/create/button/?url='.$pin_url.'&amp;media='.$pin_image.'&amp;description='.$pin_desc.'" class="pin-it-button" count-layout="horizontal"><img src="http://assets.pinterest.com/images/PinExt.png" title="Pin It" alt="Pin It" /></a>';
					echo '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
					echo '</li><!-- pinterest like -->';
				}
				
				?>
			</ul>
		

		<?php

		echo $after_widget;

	}



	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		$instance['facebook'] = isset($new_instance['facebook']);
		$instance['twitter'] = isset($new_instance['twitter']);
		$instance['gplus'] = isset($new_instance['gplus']);
		$instance['pinterest'] = isset($new_instance['pinterest']);
		
		$instance['facebook_page'] = strip_tags($new_instance['facebook_page']);

		$instance['twitter_username'] = strip_tags($new_instance['twitter_username']);
		$instance['twitter_text'] = strip_tags($new_instance['twitter_text']);
		$instance['twitter_hastag'] = strip_tags($new_instance['twitter_hastag']);
		
		$instance['pin_image'] = strip_tags($new_instance['pin_image']);
		$instance['pin_desc'] = strip_tags($new_instance['pin_desc']);

		return $instance;

	}



	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 
														'title' => '', 
														'twitter_text' => '',
														'twitter_username' => '',
														'twitter_hastag' => '',
														'pin_image' => '',
														'pin_desc' => '',
														'facebook_page' => ''
														) 
								);

		$title = strip_tags($instance['title']);

		$facebook_page = strip_tags($instance['facebook_page']);
		
		$twitter_text = strip_tags($instance['twitter_text']);
		$twitter_username = strip_tags($instance['twitter_username']);
		$twitter_hastag = strip_tags($instance['twitter_hastag']);
		
		$pin_image = strip_tags($instance['pin_image']);
		$pin_desc = strip_tags($instance['pin_desc']);
		


		

?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',THEMENAME); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><input id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="checkbox" <?php checked(isset($instance['facebook']) ? $instance['facebook'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Show Facebook Button ?',THEMENAME); ?></label></p>
		<p><i>In order for Facebook button to appear, you need to configure the Facebook options from inside the theme's option pannel</i></p>
		<p><input id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="checkbox" <?php checked(isset($instance['twitter']) ? $instance['twitter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Show twitter Button ?',THEMENAME); ?></label></p>
		<p><input id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" type="checkbox" <?php checked(isset($instance['gplus']) ? $instance['gplus'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e('Show Google Plus Button ?',THEMENAME); ?></label></p>
		<p><input id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="checkbox" <?php checked(isset($instance['pinterest']) ? $instance['pinterest'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Show pinterest Button ?',THEMENAME); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('facebook_page'); ?>"><?php _e('Facebook Username:',THEMENAME); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id('facebook_page'); ?>" name="<?php echo $this->get_field_name('facebook_page'); ?>" type="text" value="<?php echo esc_attr($facebook_page); ?>" /></p>
		

		<p><label for="<?php echo $this->get_field_id('twitter_text'); ?>"><?php _e('Twitter Text:',THEMENAME); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id('twitter_text'); ?>" name="<?php echo $this->get_field_name('twitter_text'); ?>" type="text" value="<?php echo esc_attr($twitter_text); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e('Twitter Username:',THEMENAME); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo esc_attr($twitter_username); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('twitter_hastag'); ?>"><?php _e('Twitter HashTag:',THEMENAME); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id('twitter_hastag'); ?>" name="<?php echo $this->get_field_name('twitter_hastag'); ?>" type="text" value="<?php echo esc_attr($twitter_hastag); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('pin_image'); ?>"><?php _e('Pinterest Image:',THEMENAME); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id('pin_image'); ?>" name="<?php echo $this->get_field_name('pin_image'); ?>" type="text" value="<?php echo esc_attr($pin_image); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('pin_desc'); ?>"><?php _e('Pinterest Description:',THEMENAME); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id('pin_desc'); ?>" name="<?php echo $this->get_field_name('pin_desc'); ?>" type="text" value="<?php echo esc_attr($pin_desc); ?>" /></p>
		
<?php

	}

}





add_action( 'widgets_init', create_function( '', 'register_widget( "ZN_Widget_Social_Buttons" );' ) );



?>