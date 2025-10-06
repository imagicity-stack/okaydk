<?php
/**
 * Single project template.
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
            $short_description = function_exists( 'get_field' ) ? get_field( 'short_description' ) : get_the_excerpt();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-project' ); ?> data-scroll data-scroll-speed="1">
                <header class="mb-5 text-center">
                    <h1 class="section-title"><?php the_title(); ?></h1>
                    <?php if ( $short_description ) : ?>
                        <p class="section-lead mx-auto" style="max-width: 720px;"><?php echo esc_html( wp_strip_all_tags( $short_description ) ); ?></p>
                    <?php endif; ?>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="featured-image mt-4">
                            <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded-4 shadow' ) ); ?>
                        </div>
                    <?php endif; ?>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <footer class="entry-footer mt-5">
                    <a class="btn-gradient" href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'Back to all projects', 'okaydktheme' ); ?></a>
                </footer>
            </article>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
