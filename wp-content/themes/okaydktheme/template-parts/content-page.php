<?php
/**
 * Template part for displaying page content.
 *
 * @package okaydktheme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-scroll data-scroll-speed="1">
    <header class="mb-4">
        <?php the_title( '<h1 class="section-title">', '</h1>' ); ?>
    </header>
    <div class="entry-content">
        <?php
        the_content();
        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'okaydktheme' ),
                'after'  => '</div>',
            )
        );
        ?>
    </div>
</article>
