<?php
/**
 * @package GFB Author Bio Widget by Global Food Book
 * @version 1.0
 */
/*
Plugin Name: GFB Author Bio Widget
Plugin URI: http://wordpress.org/extend/plugins/gfb-author-bio-widget/
Description: This plugin is an extract from <a href='http://globalfoodbook.com' target='_blank'>globalfoodbook.com</a>.  This plugin is built to help other site owners who require this an author bio tool with flexible options. It is implemented to allow easy setup and customization of a blogs author bio. It is best used with food and cook recipe theme made with woo themes.
Author: Ikenna N. Okpala
Version: 1.0
Author URI: http://ikennaokpala.com/
*/

// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}

/*---------------------------------------------------------------------------------*/
/* GFB Author Bio Widget */
/*---------------------------------------------------------------------------------*/
class GFB_AuthorBio extends WP_Widget {
	var $settings = array( 'title', 'bio', 'custom_email', 'avatar_size', 'avatar_align', 'read_more_text', 'read_more_url', 'page', 'make_circular' );

	function GFB_AuthorBio() {
		$widget_ops = array( 'description' => 'This is Global food book\'s author bio widget.' );
		parent::WP_Widget( false, __( 'GFB - Author Bio', 'woothemes' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		$settings = $this->woo_get_settings();
		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( $instance, $settings );
		extract( $instance, EXTR_SKIP );

		// Enforce defaults
		foreach ( array( 'avatar_size', 'avatar_align' ) as $setting ) {
			if ( !$$setting )
				$$setting = $settings[$setting];
		}

		if ( ( $page == "home" && is_home() ) || ( $page == "single" && is_single() ) || $page == "all" ) {
      $make_circular = $instance['make_circular'] ? 'true' : 'false';
      if ($make_circular == 'true') {
        $half_size = floatval($avatar_size)/2;
        $circular = 'border-radius: '.$half_size.'px;	-webkit-border-radius: '.$half_size.'px;	-moz-border-radius: '.$half_size.'px;';
      } else {
        $circular = '';
      }
    ?>
			<?php echo $before_widget; ?>
      <?php if ( $title ) { echo "<h3 style='margin:0;padding:0;'>". apply_filters( 'widget_title', $title, $instance, $this->id_base ). "</h3>"; } ?>
      <span style="width:160px;margin-top:5px;display:inline;vertical-align:baseline;float:<?php if($avatar_align == 'right'){echo 'left;';}else{echo 'right;padding-right:20px;';}?>overflow:hidden;font: 300 13px/20px 'Open Sans', Helvetica, sans-serif;">
        <?php echo $bio; ?>
        <?php if ( $read_more_url ) echo '<a href="' . esc_url( $read_more_url ) . '">' . esc_html( $read_more_text ) . '</a>'; ?>
    	</span>
			<span style="display:inline;margin-top:5px;float:<?php if($avatar_align == 'left'){echo 'left;';}else{echo 'right;margin-right:20px;';}?>overflow:hidden;<?php echo $circular?>">
        <?php if($custom_email) echo get_avatar( $custom_email, $size = $avatar_size ); ?>
      </span>
			<div style="display:block;height:0;overflow:hidden;content:' 0020';clear:both;zoom:1;"></div>
			<?php echo $after_widget;
		}
	}

	function update($new_instance, $old_instance) {
		foreach ( array( 'read_more_text', 'read_more_url', 'make_circular' ) as $setting )
			$new_instance[$setting] = strip_tags( $new_instance[$setting] );
		$new_instance['bio'] = wp_kses_post( $new_instance['bio'] );
		$new_instance['avatar_size'] = absint( $new_instance['avatar_size'] );
		if ( $new_instance['avatar_size'] < 1 )
			$new_instance['avatar_size'] = '';
		return $new_instance;
	}

	/**
	 * Provides an array of the settings with the setting name as the key and the default value as the value
	 * This cannot be called get_settings() or it will override WP_Widget::get_settings()
	 */
	function woo_get_settings() {
		// Set the default to a blank string
		$settings = array_fill_keys( $this->settings, '' );
		// Now set the more specific defaults
		$settings['avatar_size'] = 140;
		$settings['avatar_align'] = 'right';
		$settings['make_circular'] = 1;
		return $settings;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, $this->woo_get_settings() );
		extract( $instance, EXTR_SKIP );
		?>
		<p>
		   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','woothemes'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id('bio'); ?>"><?php _e('Bio:','woothemes'); ?></label>
			<textarea name="<?php echo $this->get_field_name('bio'); ?>" class="widefat" id="<?php echo $this->get_field_id('bio'); ?>"><?php echo esc_textarea( $bio ); ?></textarea>
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id('custom_email'); ?>"><?php _e('<a href="http://www.gravatar.com/">Gravatar</a> E-mail:','woothemes'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('custom_email'); ?>"  value="<?php echo esc_attr( $custom_email ); ?>" class="widefat" id="<?php echo $this->get_field_id('custom_email'); ?>" />
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('Gravatar Size:','woothemes'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('avatar_size'); ?>"  value="<?php echo esc_attr( $avatar_size ); ?>" class="widefat" id="<?php echo $this->get_field_id('avatar_size'); ?>" placeholder="Default size is 140" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('avatar_align'); ?>"><?php _e('Gravatar Alignment:','woothemes'); ?></label>
			<select name="<?php echo $this->get_field_name('avatar_align'); ?>" class="widefat" id="<?php echo $this->get_field_id('avatar_align'); ?>">
				<option value="left" <?php if($avatar_align == "left"){ echo "selected='selected'";} ?>><?php _e('Left', 'woothemes'); ?></option>
				<option value="right" <?php if($avatar_align == "right"){ echo "selected='selected'";} ?>><?php _e('Right', 'woothemes'); ?></option>
			</select>
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id('make_circular'); ?>"><?php _e('Make Image Circular (optional):','woothemes'); ?></label>
		   <input type="checkbox" name="<?php echo $this->get_field_name('make_circular'); ?>"  <?php checked($instance['make_circular'], 'on'); ?> class="widefat" id="<?php echo $this->get_field_id('make_circular'); ?>" />
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id('read_more_text'); ?>"><?php _e('Read More Text (optional):','woothemes'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('read_more_text'); ?>"  value="<?php echo esc_attr( $read_more_text ); ?>" class="widefat" id="<?php echo $this->get_field_id('read_more_text'); ?>" />
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id('read_more_url'); ?>"><?php _e('Read More URL (optional):','woothemes'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('read_more_url'); ?>" value="<?php echo esc_attr( $read_more_url ); ?>" class="widefat" id="<?php echo $this->get_field_id('read_more_url'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('page'); ?>"><?php _e('Visible Pages:','woothemes'); ?></label>
			<select name="<?php echo $this->get_field_name('page'); ?>" class="widefat" id="<?php echo $this->get_field_id('page'); ?>">
				<option value="all" <?php selected( $page, 'all' ); ?>><?php _e('All', 'woothemes'); ?></option>
				<option value="home" <?php selected( $page, 'home' ); ?>><?php _e('Home only', 'woothemes'); ?></option>
				<option value="single" <?php selected( $page, 'single' ); ?>><?php _e('Single only', 'woothemes'); ?></option>
			</select>
		</p>
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("GFB_AuthorBio");'), 1);
?>
