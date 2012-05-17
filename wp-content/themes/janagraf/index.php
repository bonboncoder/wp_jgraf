<?php get_header(); ?>

        <div id="sidebar">

            <?php get_sidebar(); ?>

        </div><!-- sidebar -->

        <div id="content">

            <?php
            $zindex = 100;
            $marginleft = 50;
            foreach (get_categories() as $category) {
            	query_posts('cat='.$category->term_id);
            	if (have_posts()) {
            ?>
			<div class="column" style="margin-left: <?php echo $marginleft; ?>px; z-index: <?php echo $zindex--; ?>">
            <?php
            		$marginleft += 270;
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