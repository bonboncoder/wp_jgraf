<?php get_header(); ?>

        <div id="sidebar">
            
            <?php get_sidebar(); ?>
            
        </div><!-- sidebar -->

        <div id="content">
            
            <div id="show_image">
                <div>
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                    <?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>
                <?php endwhile; ?>
                <?php endif; ?>
                </div>
            </div>
            <div id="imagetitle"><?php the_title(); ?></div>

        </div><!-- navi -->

<!-- end index.php -->
<?php get_footer() ?>