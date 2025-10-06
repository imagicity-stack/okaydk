<?php
/**
 * Search results template.
 *
 * @package okaydktheme
 */

get_header();
?>
<main id="primary" class="site-main section" data-scroll-section>
    <div class="container">
        <header class="mb-5 text-center">
            <h1 class="section-title"><?php printf( esc_html__( 'Search results for "%s"', 'okaydktheme' ), get_search_query() ); ?></h1>
        </header>
        <?php if ( have_posts() ) : ?>
            <div class="blog-grid" data-scroll data-scroll-speed="1">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class( 'blog-card' ); ?> data-scroll data-scroll-delay="0.15">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="blog-card__content">
                            <h2 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22, '…' ) ); ?></p>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <div class="mt-5">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
