<?php
/*
 * Template Name: Impressum
 */
?>

<?php get_header(); ?>

        <div id="content">

            <?php if ( have_posts() ) while ( have_posts() ) : the_post();
                    the_content();
                endwhile; ?>
            
        </div>

<!-- end index.php -->
<?php get_footer() ?>