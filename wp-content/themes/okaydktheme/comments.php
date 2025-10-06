<?php
/**
 * Comments template.
 *
 * @package okaydktheme
 */

if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-area" data-scroll data-scroll-speed="1">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title section-title">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                printf( _x( 'One comment', 'comments title', 'okaydktheme' ) );
            } else {
                printf( _nx( '%1$s comment', '%1$s comments', $comments_number, 'comments title', 'okaydktheme' ), number_format_i18n( $comments_number ) );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'avatar_size'=> 72,
                )
            );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'okaydktheme' ); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php comment_form(); ?>
</div>
