<?php
/**
 * Archive template.
 *
 * @package okaydktheme
 */

get_header();
?>
<main id="primary" class="site-main section" data-scroll-section>
    <div class="container">
        <header class="mb-5 text-center">
            <h1 class="section-title"><?php the_archive_title(); ?></h1>
            <p class="section-lead"><?php the_archive_description(); ?></p>
        </header>
        <div class="blog-grid" data-scroll data-scroll-speed="1">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class( 'blog-card' ); ?> data-scroll data-scroll-delay="0.15">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="blog-card__content">
                            <div class="blog-card__meta">
                                <span><?php echo esc_html( get_the_date() ); ?></span>
                                <span>•</span>
                                <span><?php echo esc_html( get_the_author() ); ?></span>
                            </div>
                            <h2 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22, '…' ) ); ?></p>
                            <a class="btn btn-link text-decoration-none text-uppercase fw-semibold mt-3" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'okaydktheme' ); ?></a>
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
