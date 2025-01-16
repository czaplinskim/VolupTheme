<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();

    wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.13.2/jquery-ui.min.js', ['jquery'], '1.13.2', false);
    wp_enqueue_script('jquery-ui-accordion');

}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();


}, 100);


add_action('admin_enqueue_scripts', function () {
    bundle('editor')->enqueue();

    wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.13.2/jquery-ui.min.js', ['jquery'], '1.13.2', true);
    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css');
    wp_enqueue_script('jquery-ui-sortable');

}, 100);




add_action('customize_controls_enqueue_scripts', function() {
    // Wczytaj swoje skrypty i style

    wp_enqueue_editor(); // Załadowanie skryptów edytora
    wp_enqueue_media();

    
           // Sprawdź, czy jesteśmy na stronie edytowania posta
            wp_enqueue_style(
            'my-customizer-styles',
            \Roots\asset('my-customizer.css'),
            [],
            null
        );

        // Zablokowanie przeciągania meta boxów
        wp_enqueue_script(
            'my-customizer-scripts',
            \Roots\asset('my-customizer.js'),
            ['jquery', 'jquery-ui-sortable', 'media-upload'],
            null,
            false
        );
    
});


/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage'),

    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support( 'custom-logo' );

    add_theme_support('custom-header', array(
        'width'                  => 1920,  // Szerokość obrazu
        'height'                 => 1080,   // Wysokość obrazu
        'flex-height'            => true,  // Elastyczna wysokość
        'flex-width'             => true,  // Elastyczna szerokość
        'header-text'            => false, // Tekst w nagłówku (jeśli potrzebny)
        'uploads'                => true,  // Możliwość przesyłania własnych obrazów
    ));

}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});


require_once trailingslashit(dirname(__FILE__)) .
    'Functions/custom-functions.php';

require_once trailingslashit(dirname(__FILE__)) .
    'Customizer/load.customizer.php';
