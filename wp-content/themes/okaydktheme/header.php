<?php
/**
 * Header template for OKAY DK theme.
 *
 * @package okaydktheme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> data-scroll-container>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-scroll-container>
<?php wp_body_open(); ?>
<div class="animated-cursor"></div>
<div class="cursor-trail"></div>
<div class="parallax-layer layer-1" data-depth="0.2"></div>
<div class="parallax-layer layer-2" data-depth="0.4"></div>
<div id="page" class="site" data-scroll-container>
    <header class="site-header" data-scroll-section>
        <div class="container d-flex justify-content-between align-items-center">
            <div class="branding">
                <?php
                $options = okaydktheme_get_options();
                if ( ! empty( $options['logo'] ) ) :
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo esc_url( $options['logo'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                    </a>
                <?php else : ?>
                    <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                <?php endif; ?>
            </div>
            <nav class="primary-nav">
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'fallback_cb'    => 'okaydktheme_menu_fallback',
                            'menu_class'     => 'menu d-flex gap-3 list-unstyled m-0',
                        )
                    );
                ?>
            </nav>
        </div>
    </header>
    <div id="content" class="site-content" data-scroll-section>
