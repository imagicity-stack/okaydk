<?php
/**
 * Archive template for projects.
 *
 * @package okaydktheme
 */

get_header();
?>
<main id="primary" class="site-main section" data-scroll-section>
    <div class="container">
        <header class="mb-5 text-center">
            <h1 class="section-title"><?php esc_html_e( 'Projects', 'okaydktheme' ); ?></h1>
            <p class="section-lead"><?php esc_html_e( 'The greatest hits from Dewesh’s growth lab.', 'okaydktheme' ); ?></p>
        </header>
        <div class="projects-grid" data-scroll data-scroll-speed="1">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class( 'project-card' ); ?> data-scroll data-scroll-delay="0.15">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_post_thumbnail_url( 'full' ); ?>" class="okaydktheme-lightbox-trigger" data-lightbox="project-archive-<?php the_ID(); ?>">
                                <?php the_post_thumbnail( 'okaydktheme-project' ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="project-card__content">
                            <h2 class="h4 mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php
                            $short_description = function_exists( 'get_field' ) ? get_field( 'short_description' ) : get_the_excerpt();
                            if ( $short_description ) :
                                ?>
                                <p><?php echo esc_html( wp_strip_all_tags( $short_description ) ); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>
        </div>
        <div class="mt-5">
            <?php the_posts_pagination(); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
