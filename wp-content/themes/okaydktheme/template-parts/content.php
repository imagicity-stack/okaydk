<?php
/**
 * Template part for displaying posts.
 *
 * @package okaydktheme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card mb-5' ); ?> data-scroll data-scroll-speed="1">
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
        <?php the_title( '<h2 class="h4"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24, '…' ) ); ?></p>
        <a class="btn btn-link text-decoration-none text-uppercase fw-semibold mt-3" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading', 'okaydktheme' ); ?></a>
    </div>
</article>
