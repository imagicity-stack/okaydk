<?php
/**
 * Page template.
 *
 * @package okaydktheme
 */

get_header();
?>
<main id="primary" class="site-main section" data-scroll-section>
    <div class="container">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-scroll data-scroll-speed="1">
                <header class="mb-5 text-center">
                    <h1 class="section-title"><?php the_title(); ?></h1>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        endwhile;
        ?>
    </div>
</main>
<?php get_footer(); ?>
