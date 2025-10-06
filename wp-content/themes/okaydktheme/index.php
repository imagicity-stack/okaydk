<?php
/**
 * Main template file.
 *
 * @package okaydktheme
 */

get_header();
?>
<main id="primary" class="site-main container py-5">
<?php
if ( have_posts() ) :
    if ( is_home() && ! is_front_page() ) :
        ?>
        <header class="mb-5">
            <h1 class="page-title section-title"><?php single_post_title(); ?></h1>
        </header>
        <?php
    endif;

    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', get_post_type() );
    endwhile;

    the_posts_pagination();
else :
    get_template_part( 'template-parts/content', 'none' );
endif;
?>
</main>
<?php get_footer(); ?>
