<?php
/**
 * Single post template.
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
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?> data-scroll data-scroll-speed="1">
                <header class="mb-5 text-center">
                    <h1 class="section-title"><?php the_title(); ?></h1>
                    <div class="blog-card__meta justify-content-center">
                        <span><?php echo esc_html( get_the_date() ); ?></span>
                        <span>•</span>
                        <span><?php echo esc_html( get_the_author() ); ?></span>
                    </div>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="featured-image mt-4">
                            <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded-4 shadow' ) ); ?>
                        </div>
                    <?php endif; ?>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <div class="share-icons">
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener">in</a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>" target="_blank" rel="noopener">x</a>
                    <a href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&body=<?php echo rawurlencode( get_permalink() ); ?>">@</a>
                </div>
                <div class="author-bio">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
                    <div class="bio-text">
                        <h3 class="h5 mb-2"><?php echo esc_html( get_the_author() ); ?></h3>
                        <p><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
                    </div>
                </div>
                <footer class="entry-footer mt-5">
                    <?php okaydktheme_entry_footer(); ?>
                </footer>
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
