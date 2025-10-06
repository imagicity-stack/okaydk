<?php
/**
 * Front page template for OKAY DK theme.
 *
 * @package okaydktheme
 */

get_header();
$options      = okaydktheme_get_options();
$rotators_raw = isset( $options['hero_rotators'] ) ? $options['hero_rotators'] : '';
$rotators     = array_filter( array_map( 'trim', explode( "\n", $rotators_raw ) ) );
?>
<main id="primary" class="site-main" data-scroll-section>
    <section class="hero" id="about" data-scroll data-scroll-speed="1">
        <div class="container hero__content">
            <p class="hero__subtitle text-uppercase fw-semibold" data-scroll data-scroll-delay="0.1">
                <span><?php esc_html_e( 'Meet the kinetic marketer', 'okaydktheme' ); ?></span>
            </p>
            <h1 class="hero__title" data-scroll data-scroll-delay="0.15">
                <?php echo esc_html( $options['hero_text'] ); ?>
            </h1>
            <?php if ( $rotators ) : ?>
            <div class="hero__subtitle mt-3" data-scroll data-scroll-delay="0.25">
                <span><?php esc_html_e( 'I am', 'okaydktheme' ); ?></span>
                <div class="rotating-text">
                    <?php foreach ( $rotators as $index => $rotator ) : ?>
                        <span class="<?php echo 0 === $index ? 'is-active' : ''; ?>"><?php echo esc_html( $rotator ); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="mt-5" data-scroll data-scroll-delay="0.4">
                <a class="btn-gradient" href="#projects"><?php esc_html_e( 'View the Work', 'okaydktheme' ); ?></a>
            </div>
        </div>
    </section>

    <section class="section" id="about-me" data-scroll-section data-scroll data-scroll-speed="1">
        <div class="container">
            <div class="row align-items-center g-5">
                <?php
                $about_page = get_page_by_path( 'about-me' );
                if ( ! $about_page ) {
                    $about_page = get_page_by_title( __( 'About Me', 'okaydktheme' ) );
                }
                $about_image = $about_description = '';
                if ( $about_page ) {
                    if ( function_exists( 'get_field' ) ) {
                        $image_field = get_field( 'profile_image', $about_page->ID );
                        if ( $image_field && isset( $image_field['url'] ) ) {
                            $about_image = $image_field['url'];
                        }
                        $about_description = get_field( 'about_description', $about_page->ID );
                    }
                    if ( empty( $about_description ) ) {
                        $about_description = apply_filters( 'the_content', $about_page->post_content );
                    }
                }
                ?>
                <div class="col-md-5" data-scroll data-scroll-delay="0.1">
                    <?php if ( $about_image ) : ?>
                        <img class="img-fluid rounded-4 shadow" src="<?php echo esc_url( $about_image ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                    <?php endif; ?>
                </div>
                <div class="col-md-7" data-scroll data-scroll-delay="0.2">
                    <h2 class="section-title"><?php esc_html_e( 'About Dewesh', 'okaydktheme' ); ?></h2>
                    <p class="section-lead mb-4"><?php esc_html_e( 'Bold ideas, sharper funnels, unforgettable campaigns.', 'okaydktheme' ); ?></p>
                    <div class="about-content">
                        <?php echo wp_kses_post( $about_description ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="projects" data-scroll-section data-scroll data-scroll-speed="1">
        <div class="container">
            <div class="d-flex justify-content-between flex-wrap align-items-end mb-4">
                <div>
                    <h2 class="section-title"><?php esc_html_e( 'Featured Growth Experiments', 'okaydktheme' ); ?></h2>
                    <p class="section-lead"><?php esc_html_e( 'A punchy selection of marketing plays engineered for velocity.', 'okaydktheme' ); ?></p>
                </div>
                <a class="btn-gradient" href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'All Projects', 'okaydktheme' ); ?></a>
            </div>
            <div class="projects-grid">
                <?php
                $projects = new WP_Query(
                    array(
                        'post_type'      => 'project',
                        'posts_per_page' => 6,
                    )
                );
                if ( $projects->have_posts() ) :
                    while ( $projects->have_posts() ) :
                        $projects->the_post();
                        $short_description = function_exists( 'get_field' ) ? get_field( 'short_description' ) : get_the_excerpt();
                        ?>
                        <article <?php post_class( 'project-card' ); ?> data-scroll data-scroll-delay="0.15">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_post_thumbnail_url( 'full' ); ?>" class="okaydktheme-lightbox-trigger" data-lightbox="project-<?php the_ID(); ?>">
                                    <?php the_post_thumbnail( 'okaydktheme-project' ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="project-card__content">
                                <h3 class="h4 mb-2"><?php the_title(); ?></h3>
                                <?php if ( $short_description ) : ?>
                                    <p><?php echo esc_html( wp_strip_all_tags( $short_description ) ); ?></p>
                                <?php endif; ?>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p><?php esc_html_e( 'Add some Projects to showcase the hustle.', 'okaydktheme' ); ?></p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>

    <section class="section" id="blog" data-scroll-section data-scroll data-scroll-speed="1">
        <div class="container">
            <div class="d-flex justify-content-between flex-wrap align-items-end mb-4">
                <div>
                    <h2 class="section-title"><?php esc_html_e( 'Latest Brainsparks', 'okaydktheme' ); ?></h2>
                    <p class="section-lead"><?php esc_html_e( 'Insights, playbooks, and experiments straight from the lab.', 'okaydktheme' ); ?></p>
                </div>
                <?php
                $blog_page_id = (int) get_option( 'page_for_posts' );
                $blog_link    = $blog_page_id ? get_permalink( $blog_page_id ) : get_post_type_archive_link( 'post' );
                ?>
                <a class="btn-gradient" href="<?php echo esc_url( $blog_link ); ?>"><?php esc_html_e( 'Read the Blog', 'okaydktheme' ); ?></a>
            </div>
            <div class="blog-grid">
                <?php
                $posts_query = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                    )
                );
                if ( $posts_query->have_posts() ) :
                    while ( $posts_query->have_posts() ) :
                        $posts_query->the_post();
                        ?>
                        <article <?php post_class( 'blog-card' ); ?> data-scroll data-scroll-delay="0.2">
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
                                <h3 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '…' ) ); ?></p>
                                <a class="btn btn-link text-decoration-none text-uppercase fw-semibold mt-3" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Dive In', 'okaydktheme' ); ?></a>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p><?php esc_html_e( 'No blog posts yet. Drop some knowledge bombs!', 'okaydktheme' ); ?></p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
