<?php
/**
 * Functions and definitions for OKAY DK theme.
 *
 * @package okaydktheme
 */

define( 'OKAYDKTHEME_VERSION', '1.0.0' );

define( 'OKAYDKTHEME_DIR', get_template_directory() );

define( 'OKAYDKTHEME_URI', get_template_directory_uri() );

require_once OKAYDKTHEME_DIR . '/inc/class-tgm-plugin-activation.php';

if ( ! function_exists( 'okaydktheme_setup' ) ) {
    /**
     * Theme setup.
     */
    function okaydktheme_setup() {
        load_theme_textdomain( 'okaydktheme', OKAYDKTHEME_DIR . '/languages' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'align-wide' );

        add_image_size( 'okaydktheme-project', 960, 720, true );

        register_nav_menus(
            array(
                'primary' => __( 'Primary Menu', 'okaydktheme' ),
                'footer'  => __( 'Footer Menu', 'okaydktheme' ),
            )
        );

        add_theme_support(
            'html5',
            array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' )
        );
    }
}
add_action( 'after_setup_theme', 'okaydktheme_setup' );

/**
 * Set content width.
 */
function okaydktheme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'okaydktheme_content_width', 1200 );
}
add_action( 'after_setup_theme', 'okaydktheme_content_width', 0 );

/**
 * Register widget area.
 */
function okaydktheme_widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Footer Widgets', 'okaydktheme' ),
            'id'            => 'footer-1',
            'description'   => __( 'Add widgets for the footer.', 'okaydktheme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'okaydktheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function okaydktheme_scripts() {
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css', array(), '1.11.3' );
    wp_enqueue_style( 'okaydktheme-style', get_stylesheet_uri(), array( 'bootstrap', 'bootstrap-icons' ), OKAYDKTHEME_VERSION );
    wp_enqueue_style( 'okaydktheme-main', OKAYDKTHEME_URI . '/assets/css/main.css', array( 'okaydktheme-style' ), OKAYDKTHEME_VERSION );

    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
    wp_enqueue_script( 'gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), '3.12.5', true );
    wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', array( 'gsap' ), '3.12.5', true );
    wp_enqueue_script( 'locomotive-scroll', 'https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js', array(), '4.1.4', true );

    wp_enqueue_script( 'okaydktheme-main', OKAYDKTHEME_URI . '/assets/js/main.js', array( 'gsap', 'gsap-scrolltrigger', 'locomotive-scroll' ), OKAYDKTHEME_VERSION, true );

    $options = okaydktheme_get_options();

    wp_localize_script(
        'okaydktheme-main',
        'okaydkthemeSettings',
        array(
            'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
            'primaryColor' => $options['primary_gradient'] ?? '',
            'heroText'     => $options['hero_text'] ?? __( "HEY, I'M DEWESH KARAN", 'okaydktheme' ),
        )
    );
}
add_action( 'wp_enqueue_scripts', 'okaydktheme_scripts' );

/**
 * Editor assets.
 */
function okaydktheme_editor_assets() {
    wp_enqueue_style( 'okaydktheme-editor', OKAYDKTHEME_URI . '/assets/css/editor.css', array(), OKAYDKTHEME_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'okaydktheme_editor_assets' );

/**
 * Register custom post type Projects.
 */
function okaydktheme_register_post_types() {
    $labels = array(
        'name'               => _x( 'Projects', 'post type general name', 'okaydktheme' ),
        'singular_name'      => _x( 'Project', 'post type singular name', 'okaydktheme' ),
        'menu_name'          => _x( 'Projects', 'admin menu', 'okaydktheme' ),
        'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'okaydktheme' ),
        'add_new'            => _x( 'Add New', 'project', 'okaydktheme' ),
        'add_new_item'       => __( 'Add New Project', 'okaydktheme' ),
        'new_item'           => __( 'New Project', 'okaydktheme' ),
        'edit_item'          => __( 'Edit Project', 'okaydktheme' ),
        'view_item'          => __( 'View Project', 'okaydktheme' ),
        'all_items'          => __( 'All Projects', 'okaydktheme' ),
        'search_items'       => __( 'Search Projects', 'okaydktheme' ),
        'parent_item_colon'  => __( 'Parent Projects:', 'okaydktheme' ),
        'not_found'          => __( 'No projects found.', 'okaydktheme' ),
        'not_found_in_trash' => __( 'No projects found in Trash.', 'okaydktheme' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-rocket',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'project', $args );
}
add_action( 'init', 'okaydktheme_register_post_types' );

/**
 * Theme options defaults.
 */
function okaydktheme_default_options() {
    return array(
        'logo'            => '',
        'primary_gradient'=> 'linear-gradient(135deg, #00c6ff 0%, #ff5f6d 50%, #f6ff00 100%)',
        'linkedin'        => '#',
        'instagram'       => '#',
        'x'               => '#',
        'hero_text'       => "HEY, I'M DEWESH KARAN",
        'hero_rotators'   => "Marketing Strategist\nGrowth Hacker\nCreative Devil of the First Order",
    );
}

/**
 * Get theme options.
 */
function okaydktheme_get_options() {
    $defaults = okaydktheme_default_options();
    $options  = get_option( 'okaydktheme_options', array() );

    return wp_parse_args( $options, $defaults );
}

/**
 * Add theme settings page under Appearance.
 */
function okaydktheme_register_settings_page() {
    add_theme_page(
        __( 'OKAY DK Settings', 'okaydktheme' ),
        __( 'OKAY DK Settings', 'okaydktheme' ),
        'manage_options',
        'okaydktheme-settings',
        'okaydktheme_render_settings_page'
    );
}
add_action( 'admin_menu', 'okaydktheme_register_settings_page' );

/**
 * Register settings.
 */
function okaydktheme_register_settings() {
    register_setting( 'okaydktheme_options_group', 'okaydktheme_options', 'okaydktheme_sanitize_options' );

    add_settings_section( 'okaydktheme_general', __( 'General', 'okaydktheme' ), '__return_false', 'okaydktheme-settings' );

    $fields = array(
        'logo'            => __( 'Logo URL', 'okaydktheme' ),
        'primary_gradient'=> __( 'Primary Gradient (CSS)', 'okaydktheme' ),
        'linkedin'        => __( 'LinkedIn URL', 'okaydktheme' ),
        'instagram'       => __( 'Instagram URL', 'okaydktheme' ),
        'x'               => __( 'X (Twitter) URL', 'okaydktheme' ),
        'hero_text'       => __( 'Hero Headline', 'okaydktheme' ),
        'hero_rotators'   => __( 'Hero Rotating Subtitles (one per line)', 'okaydktheme' ),
    );

    foreach ( $fields as $key => $label ) {
        add_settings_field(
            $key,
            $label,
            'okaydktheme_render_field',
            'okaydktheme-settings',
            'okaydktheme_general',
            array(
                'label_for' => $key,
                'type'      => 'textarea' === $key ? 'textarea' : 'text',
                'option'    => $key,
            )
        );
    }
}
add_action( 'admin_init', 'okaydktheme_register_settings' );

/**
 * Settings sanitizer.
 *
 * @param array $input Input values.
 *
 * @return array
 */
function okaydktheme_sanitize_options( $input ) {
    $defaults = okaydktheme_default_options();
    $sanitized = array();

    foreach ( $defaults as $key => $default ) {
        if ( isset( $input[ $key ] ) ) {
            if ( in_array( $key, array( 'hero_rotators' ), true ) ) {
                $sanitized[ $key ] = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", wp_unslash( $input[ $key ] ) ) ) );
            } else {
                $sanitized[ $key ] = sanitize_text_field( wp_unslash( $input[ $key ] ) );
            }
        }
    }

    return wp_parse_args( $sanitized, $defaults );
}

/**
 * Render settings field callback.
 *
 * @param array $args Field args.
 */
function okaydktheme_render_field( $args ) {
    $options = okaydktheme_get_options();
    $key     = $args['option'];
    $value   = isset( $options[ $key ] ) ? $options[ $key ] : '';

    if ( 'hero_rotators' === $key ) {
        printf(
            '<textarea id="%1$s" name="okaydktheme_options[%1$s]" rows="5" style="width:100%%;">%2$s</textarea>',
            esc_attr( $key ),
            esc_textarea( $value )
        );
    } else {
        printf(
            '<input type="text" id="%1$s" name="okaydktheme_options[%1$s]" value="%2$s" class="regular-text" />',
            esc_attr( $key ),
            esc_attr( $value )
        );
    }
}

/**
 * Render settings page markup.
 */
function okaydktheme_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'OKAY DK Theme Settings', 'okaydktheme' ); ?></h1>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'okaydktheme_options_group' );
                do_settings_sections( 'okaydktheme-settings' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Output dynamic styles in head.
 */
function okaydktheme_inline_styles() {
    $options = okaydktheme_get_options();
    $gradient = $options['primary_gradient'];
    if ( ! empty( $gradient ) ) {
        echo '<style>:root{--okaydktheme-primary-gradient:' . esc_attr( $gradient ) . ';}</style>';
    }
}
add_action( 'wp_head', 'okaydktheme_inline_styles' );

/**
 * Setup ACF fields.
 */
function okaydktheme_register_acf_fields() {
    if ( function_exists( 'acf_add_local_field_group' ) ) {
        acf_add_local_field_group(
            array(
                'key'    => 'group_okaydktheme_about',
                'title'  => __( 'About Me Content', 'okaydktheme' ),
                'fields' => array(
                    array(
                        'key'   => 'field_okaydktheme_about_image',
                        'label' => __( 'Profile Image', 'okaydktheme' ),
                        'name'  => 'profile_image',
                        'type'  => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                    ),
                    array(
                        'key'   => 'field_okaydktheme_about_richtext',
                        'label' => __( 'About Description', 'okaydktheme' ),
                        'name'  => 'about_description',
                        'type'  => 'wysiwyg',
                        'tabs'  => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param'    => 'page_template',
                            'operator' => '==',
                            'value'    => 'default',
                        ),
                    ),
                ),
            )
        );

        acf_add_local_field_group(
            array(
                'key'    => 'group_okaydktheme_project',
                'title'  => __( 'Project Details', 'okaydktheme' ),
                'fields' => array(
                    array(
                        'key'   => 'field_okaydktheme_short_description',
                        'label' => __( 'Short Description', 'okaydktheme' ),
                        'name'  => 'short_description',
                        'type'  => 'textarea',
                        'new_lines' => 'br',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param'    => 'post_type',
                            'operator' => '==',
                            'value'    => 'project',
                        ),
                    ),
                ),
            )
        );
    }
}
add_action( 'acf/init', 'okaydktheme_register_acf_fields' );

/**
 * TGMPA required/recommended plugins.
 */
function okaydktheme_register_required_plugins() {
    $plugins = array(
        array(
            'name'     => 'Advanced Custom Fields',
            'slug'     => 'advanced-custom-fields',
            'required' => false,
        ),
        array(
            'name'     => 'Custom Post Type UI',
            'slug'     => 'custom-post-type-ui',
            'required' => false,
        ),
        array(
            'name'     => 'GSAP Animation Block',
            'slug'     => 'gsap-animation-block',
            'required' => false,
        ),
        array(
            'name'     => 'Simple Lightbox',
            'slug'     => 'simple-lightbox',
            'required' => false,
        ),
        array(
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name'     => 'WP Super Cache',
            'slug'     => 'wp-super-cache',
            'required' => false,
        ),
    );

    $config = array(
        'id'           => 'okaydktheme',
        'menu'         => 'okaydktheme-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'is_automatic' => false,
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'okaydktheme_register_required_plugins' );

/**
 * Include custom template tags if required.
 */
require_once OKAYDKTHEME_DIR . '/inc/template-tags.php';

if ( ! function_exists( 'okaydktheme_menu_fallback' ) ) {
    /**
     * Fallback menu output listing pages.
     */
    function okaydktheme_menu_fallback() {
        echo '<ul class="menu d-flex gap-3 list-unstyled m-0">';
        wp_list_pages(
            array(
                'title_li' => '',
            )
        );
        echo '</ul>';
    }
}
