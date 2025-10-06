<?php
/**
 * Template tags for OKAY DK theme.
 *
 * @package okaydktheme
 */

if ( ! function_exists( 'okaydktheme_posted_on' ) ) {
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function okaydktheme_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            __( 'Posted on %s', 'okaydktheme' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            /* translators: %s: post author. */
            __( 'by %s', 'okaydktheme' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
    }
}

if ( ! function_exists( 'okaydktheme_entry_footer' ) ) {
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function okaydktheme_entry_footer() {
        if ( 'post' === get_post_type() ) {
            $categories_list = get_the_category_list( __( ', ', 'okaydktheme' ) );
            if ( $categories_list ) {
                printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'okaydktheme' ) . '</span>', wp_kses_post( $categories_list ) );
            }

            $tags_list = get_the_tag_list( '', __( ', ', 'okaydktheme' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'okaydktheme' ) . '</span>', wp_kses_post( $tags_list ) );
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link( __( 'Leave a comment', 'okaydktheme' ), __( '1 Comment', 'okaydktheme' ), __( '% Comments', 'okaydktheme' ) );
            echo '</span>';
        }
    }
}
