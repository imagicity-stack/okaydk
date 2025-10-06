<?php
/**
 * The template for displaying 404 pages.
 *
 * @package okaydktheme
 */

get_header();
?>
<main id="primary" class="site-main section" data-scroll-section>
    <div class="container text-center">
        <h1 class="section-title"><?php esc_html_e( '404 — Lost in the neon maze', 'okaydktheme' ); ?></h1>
        <p class="section-lead mb-4"><?php esc_html_e( 'That page fizzled out. Let’s redirect the energy.', 'okaydktheme' ); ?></p>
        <a class="btn-gradient" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'okaydktheme' ); ?></a>
    </div>
</main>
<?php get_footer(); ?>
