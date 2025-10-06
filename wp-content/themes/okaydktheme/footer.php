<?php
/**
 * Footer template for OKAY DK theme.
 *
 * @package okaydktheme
 */
?>
        </div><!-- #content -->
        <footer class="site-footer" data-scroll-section>
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-md-6">
                        <p class="m-0">OKAY DK © <?php echo date_i18n( 'Y' ); ?> Dewesh Karan | <?php esc_html_e( "Let's talk growth.", 'okaydktheme' ); ?></p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end">
                        <div class="social-links">
                            <?php
                            $options = okaydktheme_get_options();
                            $socials = array(
                                'linkedin'  => array( 'label' => 'LinkedIn', 'icon' => 'bi-linkedin' ),
                                'instagram' => array( 'label' => 'Instagram', 'icon' => 'bi-instagram' ),
                                'x'         => array( 'label' => 'X', 'icon' => 'bi-twitter' ),
                            );

                            foreach ( $socials as $key => $meta ) {
                                $url = isset( $options[ $key ] ) ? $options[ $key ] : '';
                                if ( ! empty( $url ) ) {
                                    printf(
                                        '<a href="%1$s" target="_blank" rel="noopener" aria-label="%2$s"><i class="bi %3$s"></i></a>',
                                        esc_url( $url ),
                                        esc_attr( $meta['label'] ),
                                        esc_attr( $meta['icon'] )
                                    );
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="footer-widgets mt-5">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </footer>
    </div><!-- #page -->
    <button class="scroll-top" aria-label="Scroll to top"><span>&uarr;</span></button>
<?php wp_footer(); ?>
</body>
</html>
