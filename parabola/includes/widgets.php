<?php

/** 
 * PRESENTATION PAGE COLUMNS 
 */

// Counting the PP column widgets
global $parabola_column_counter;
$parabola_column_counter = 0;

class ColumnsWidget extends WP_Widget
{ 	
  var $parabolas; // theme options read in the constructor
  
  public function __construct() { 
    $widget_ops = array('classname' => 'ColumnsWidget', 'description' => 'Add columns in the presentation page' );
	$control_ops = array('width' => 350, 'height' => 350); // making widget window larger
	parent::__construct('columns_widget', 'Cryout Column', $widget_ops, $control_ops);
	$this->parabolas = parabola_get_theme_options(); // reading theme options
  } // construct()

  public function ColumnsWidget() {
	self::__construct();  
  } // PHP4 constructor
  
  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'image' => '', 'title' => '' , 'text' => '',  'link' => '',  'blank' => '' ) );
    $image = $instance['image'];
	$title = $instance['title'];
	$text = $instance['text'];
	$link = $instance['link'];
	$blank = $instance['blank'];?>
	<div>
		<p><label for="<?php echo esc_attr($this->get_field_id('image')); ?>">Image: <input class="widefat slideimages" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_url($image); ?>" /></label><a class="upload_image_button button" href="#">Select / Upload Image</a></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('text')); ?>">Text: <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo esc_html($text); ?></textarea></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('link')); ?>">Link: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_url($link); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('blank')); ?>">Open in new Window: <input id="<?php echo esc_attr($this->get_field_id('blank')); ?>" name="<?php echo esc_attr($this->get_field_name('blank')); ?>" type="checkbox" <?php checked($blank, 1); ?> value="1" /></label></p>
	</div> <?php  
  } // form()

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['image'] = $new_instance['image'];
	$instance['title'] = $new_instance['title'];
	$instance['text'] = $new_instance['text'];
	$instance['link'] = $new_instance['link'];
	$instance['blank'] = $new_instance['blank'];
    return $instance;
  } // update()
  
  function widget($args, $instance) { 
	$parabola_nrcolumns = $this->parabolas['parabola_nrcolumns']; // getting the number of columns setting
	global $parabola_column_counter; // global counter for incrementing further
	
	if( !empty($instance['image']) || !empty($instance['title']) || !empty($instance['text']) ) :
		$parabola_column_counter++; // incrementing counter only if widget has image
		$counter = $parabola_column_counter; 
		$coldata = array(
			'colno' => (($counter%$parabola_nrcolumns)?$counter%$parabola_nrcolumns:$parabola_nrcolumns),
			'counter' => $counter,
			'image' => esc_url($instance['image']),
			'link' => esc_url($instance['link']),
			'blank' => ($instance['blank']?'target="_blank"':''),
			'title' =>  $instance['title'],
			'text' => $instance['text'],
		);
		parabola_singlecolumn_output($coldata);		
	endif; 
  } // widget() function
  
} // class ColumnsWidget

function parabola_widgets_register() {
	return register_widget("ColumnsWidget");
} // parabola_widgets_register()
add_action( 'widgets_init', 'parabola_widgets_register' );

function parabola_widget_scripts() {
	// For the WP uploader
    if(function_exists('wp_enqueue_media')) {
         wp_enqueue_media();
      }
      else {
         wp_enqueue_script('media-upload');
         wp_enqueue_script('thickbox');
         wp_enqueue_style('thickbox');
      }
	wp_register_script('admin', get_template_directory_uri().'/admin/js/widgets.js');
	wp_enqueue_script('admin'); 
}

add_action ('admin_print_scripts-widgets.php','parabola_widget_scripts');

/**
 * presentation page column output
 */
if ( ! function_exists('parabola_singlecolumn_output') ):
function parabola_singlecolumn_output($data){
	global $parabolas;
	extract($data);
	?>		
		
		<div class="ppcolumn column<?php echo intval($colno) ?>" id="column<?php echo intval($counter) ?>">
			<a href="<?php echo esc_url($link) ?>" <?php echo esc_html($blank) ?>>
				<?php if (!empty($image)) { ?>
					<div class="column-image">
						<img src="<?php echo esc_url($image) ?>" id="columnImage<?php echo intval($colno); ?>" alt="<?php echo esc_attr($title) ?>" />
						<?php if ($title) { ?>
							<h3 class='column-header-image'><?php echo esc_html( $title ) ?></h3>
						<?php } ?>
					</div>
				<?php } else {
					if (!empty($title)) { ?>
							<h3 class='column-header-noimage'><?php echo esc_html( $title ) ?></h3>
					<?php } 
				} ?>
			</a> <!-- link -->

		<?php if (!empty($text)) { ?>		
			<div class="column-text"> <?php 
				echo do_shortcode($text);
				if ($parabolas['parabola_columnreadmore'] && $link): ?>
					<div class="columnmore">
						<a href="<?php echo esc_url($link) ?>" <?php echo esc_html($blank) ?>><?php echo esc_html($parabolas['parabola_columnreadmore']) ?> &raquo;</a>
					</div>
               <?php endif; ?>
			</div> <!-- column-text-->
		<?php } ?>
	
		</div> <!-- column -->	
		
	<?php
} // parabola_singlecolumn_output()
endif;

// FIN