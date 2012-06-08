<?php
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'leftnavi' ),
	) );
        
	// Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Gallery shortcode remove inline css
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	add_shortcode('gallery_edit', 'gallery_shortcode_edit');
	
	/**
	 * The Gallery shortcode.
	 *
	 * This implements the functionality of the Gallery Shortcode for displaying
	 * WordPress images on a post.
	 *
	 * @since 2.5.0
	 *
	 * @param array $attr Attributes of the shortcode.
	 * @return string HTML content to display gallery.
	 */
	function gallery_shortcode_edit($attr) {
		global $post;
	
		static $instance = 0;
		$instance++;
		
		static $img_instance = 0;
		
		// Allow plugins/themes to override the default gallery template.
		$output = apply_filters('post_gallery', '', $attr);
		if ( $output != '' )
			return $output;
	
		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}
	
		extract(shortcode_atts(array(
				'order'      => 'ASC',
				'orderby'    => 'menu_order ID',
				'id'         => $post->ID,
				'itemtag'    => 'dl',
				'icontag'    => 'dt',
				'captiontag' => 'dd',
				'columns'    => 3,
				'size'       => 'thumbnail',
				'include'    => '',
				'exclude'    => ''
		), $attr));
	
		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';
	
		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
	
		if ( empty($attachments) )
			return '';
	
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}
	
		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$columns = intval($columns);
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';
	
		$selector = "gallery-{$instance}";
	
		$gallery_style = $gallery_div = '';
		if ( apply_filters( 'use_default_gallery_style', true ) )
			$gallery_style = "
			<style type='text/css'>
				#{$selector} {
					margin: auto;
				}
				#{$selector} .gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
				}
				#{$selector} img {
					border: 2px solid #cfcfcf;
				}
				#{$selector} .gallery-caption {
					margin-left: 0;
				}
			</style>
			<!-- see gallery_shortcode() in wp-includes/media.php -->";
		$size_class = sanitize_html_class( $size );
		$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
		$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
	
		$i = 0;
		$rnd = rand($i, sizeof($attachments)-1);
		
		$material = get_post_meta($id, 'material', true);
		
		$news_content = get_post($id)->post_content;
		foreach ( $attachments as $id => $attachment ) {
			if ($news_content != '' && $i == $rnd) {
				$output .= '<div class="news">'
							. $news_content .
							'</div>
							<br style="clear: both; line-height: 1.3em;" />';
			}
			$thumb_img_url = wp_get_attachment_image_src($id, 'thumbnail');
			$medium_img_url = wp_get_attachment_image_src($id, 'medium');
			$cap = wptexturize($attachment->post_content);
			$link = '<a href="' . $medium_img_url[0] . '" target="_blank" title="' . $cap . '" id="img' . $img_instance . '" onclick="return enlargeImg(\'img'. $img_instance++ . '\', \'' . $medium_img_url[0] .'\', \'' . $thumb_img_url[1] . '\', \'' . $thumb_img_url[2] .'\', \'' . $medium_img_url[1] . '\', \'' . $medium_img_url[2] . '\', false);">'
						. wp_get_attachment_image($id, 'thumbnail') .
					'</a>';
			$cap2 = "<{$captiontag} class='gallery-caption'>"
						. $cap .
					"</{$captiontag}>";
			$output .= "<{$icontag} class='gallery-icon'>$link$cap2</{$icontag}>";
			
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= '<br style="clear: both; line-height: 1.3em;" />';
		}
		if ($material != '') {
			$output .= '<div class="description">'
							. $material .
					   '</div>';
		}
	
		$output .= '<br style="clear: both;" />
					</div>';
	
		return $output;
	}
	
	
	/* 
	 * Custom CSS styles on WYSIWYG Editor – Start 
	 * Code taken from http://www.wdmac.com/how-to-use-custom-styles-in-the-word-press-post-editor
	 * Thanks!
	 * 
	 */
	if ( ! function_exists( 'myCustomTinyMCE' ) ) :
	function myCustomTinyMCE($init) {
		$init['theme_advanced_buttons2_add_before'] = 'styleselect'; // Adds the buttons at the begining. (theme_advanced_buttons2_add adds them at the end)
		$init['theme_advanced_styles'] = 'Info Shadow Blue=shadow_blue,Info Shadow Green=shadow_green,Info Shadow Red=shadow_red,Info Shadow Yellow=shadow_yellow,Info Year=info_year,News Arial 12 230=news_arial_12_230,News Arial 16 140=news_arial_16_140,News Arial 22 70=news_arial_22_70,News Arial 22 140=news_arial_22_140,News Courier Bold Blue=news_courier_bold_blue,News Courier Bold Red=news_courier_bold_red,News Courier Bold Yellow=news_courier_bold_yellow,News Courier Reg Blue=news_courier_reg_blue';
		return $init;
	}
	endif;
	add_filter('tiny_mce_before_init', 'myCustomTinyMCE' );
	add_filter( 'mce_css', 'tdav_css' );
	add_editor_style('mycustomstyles.css');
	// including the Custom CSS on our theme.
	function mycustomStyles(){
		wp_enqueue_style( 'myCustomStyles', get_bloginfo('stylesheet_directory').'/editor_styles.css', ",",'all' );
	}
	add_action('init', 'mycustomStyles');
?>
