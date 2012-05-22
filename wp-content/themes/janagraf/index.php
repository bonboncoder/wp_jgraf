<?php get_header(); ?>

        <div id="sidebar">

            <?php get_sidebar(); ?>

        </div><!-- sidebar -->

        <div id="content">

            <?php
            //init z-index and margin-left values
            $zindex = 100;
            $marginleft = 160;
            $colId = 0;
            foreach (get_categories(array('exclude' => '11, 12', 'order' => 'desc')) as $category) {
            	rewind_posts();
            	$posts_by_cat = query_posts('cat='.$category->term_id);
            	$post_title_chars = str_split($posts_by_cat[0]->post_title);
            	$post_tags = wp_get_post_tags($posts_by_cat[0]->ID);
            	$post_tag_chars;
            	if (sizeof($post_tags) == 1) {
            		$post_tag_chars = str_split($post_tags[0]->name);
            	}
            	if (have_posts()) {
            ?>
            <div id="ct<?php echo $colID; ?>" class="column_title" style="margin-left: <?php echo $marginleft; ?>px; z-index: <?php echo $zindex--; ?>">
            	<div class="column_title_name">
			<?php
					$marginleft += 30;
					foreach ($post_title_chars as $char) {
						echo $char . '<br>';
					}
			?>
				</div>
				<div class="column_title_year">
			<?php
				foreach ($post_tag_chars as $char) {
					echo $char . '<br>';
				}
			?>
				</div>
			</div>	            
			<div id="cc<?php echo $colID++;?>" class="column" style="margin-left: <?php echo $marginleft; ?>px; z-index: <?php echo $zindex--; ?>">
            <?php
            		$marginleft += 220;
            		while (have_posts()) {
	            		echo do_shortcode('[gallery_edit columns="1" id='.the_post().' orderby="title" size="thumbnail"]');
            		}
            ?>
            </div>
            
            <?php }
            } ?>

        </div>

<!-- end index.php -->
<?php get_footer() ?>