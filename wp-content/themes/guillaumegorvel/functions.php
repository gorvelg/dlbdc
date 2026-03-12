<?php




add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/**
 * 1) Enregistrer automatiquement tous les blocks du dossier /blocks
 */
add_action('init', function () {
    $blocks_dir = get_stylesheet_directory() . '/blocks';
    foreach (glob($blocks_dir . '/*/block.json') as $block_json) {
        register_block_type(dirname($block_json));
    }
});

/**
 * 2) CPT: Programmes (DOIT être sur init, hors des autres hooks)
 */
add_action('init', function () {
    register_post_type('client', [
        'labels' => [
            'name'          => 'Clients',
            'singular_name' => 'Client',
            'add_new_item'  => 'Ajouter un client',
            'edit_item'     => 'Modifier le client',
            'all_items'     => 'Tous les clients',
        ],
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-welcome-learn-more',
        'supports'     => ['title'],
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'clients'],
    ]);

    register_post_type('galerie', [
        'labels' => [
            'name'          => 'Galerie',
            'singular_name' => 'Galerie',
            'add_new_item'  => 'Ajouter une photo',
            'edit_item'     => 'Modifier une photo',
            'all_items'     => 'Toutes les photos',
        ],
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-format-gallery',
        'supports'     => ['title'],
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'galerie'],
    ]);
});

/**
 * 3) Un seul JS éditeur pour enregistrer tous les blocs (preview PHP)
 */
add_action('enqueue_block_editor_assets', function () {
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    $script_path = $theme_dir . '/blocks/blocks-editor.js';
    $script_uri  = $theme_uri . '/blocks/blocks-editor.js';

    // Build GG_BLOCKS depuis block.json
    $blocks_dir = $theme_dir . '/blocks';
    $blocks = [];

    foreach (glob($blocks_dir . '/*/block.json') as $json_path) {
        $data = json_decode(file_get_contents($json_path), true);
        if (!empty($data['name'])) {
            $blocks[] = [
                'name'        => $data['name'],
                'title'       => $data['title'] ?? $data['name'],
                'category'    => $data['category'] ?? 'widgets',
                'icon'        => $data['icon'] ?? 'smiley',
                'description' => $data['description'] ?? '',
                'keywords'    => $data['keywords'] ?? [],
                'supports'    => $data['supports'] ?? [],
            ];
        }
    }

    wp_enqueue_script(
        'gg-blocks-editor',
        $script_uri,
        ['wp-blocks', 'wp-element', 'wp-server-side-render'],
        file_exists($script_path) ? filemtime($script_path) : null,
        true
    );

    wp_add_inline_script(
        'gg-blocks-editor',
        'window.GG_BLOCKS=' . wp_json_encode($blocks) . ';',
        'before'
    );
});

add_filter('wpcf7_mail_html_footer', function ($output, $form) {
    ob_start();

    get_template_part('template-parts/mail/cf7', 'footer');

    return ob_get_clean();
}, 10, 2);


function theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_style(
        'theme-style',
        get_stylesheet_directory_uri() . '/assets/css/theme.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/theme.css')
    );

    wp_enqueue_style(
        'footer-style',
        get_stylesheet_directory_uri() . '/assets/css/_footer.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/_footer.css')
    );

    wp_enqueue_style(
        'contact-style',
        get_stylesheet_directory_uri() . '/assets/css/_contact.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/_contact.css')
    );

    wp_enqueue_style(
        'header-style',
        get_stylesheet_directory_uri() . '/assets/css/_header.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/_header.css')
    );

    wp_register_style(
        'accueil-style',
        get_stylesheet_directory_uri() . '/assets/css/pages/accueil.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/pages/accueil.css')
    );

    if (is_front_page()) {
        wp_enqueue_style('accueil-style');
    }

    wp_register_style(
        'galerie-style',
        get_stylesheet_directory_uri() . '/assets/css/pages/galerie.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/pages/galerie.css')
    );

    if (is_page('galerie')) {
        wp_enqueue_style('galerie-style');
    }

    wp_register_script(
        'contact-script',
        get_stylesheet_directory_uri() . '/assets/js/contact.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/contact.js'),
        true
    );
    wp_enqueue_script('contact-script');

    wp_register_script(
        'animation-script',
        get_stylesheet_directory_uri() . '/assets/js/animation.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/animation.js'),
        true
    );
    wp_enqueue_script('animation-script');

    if (is_page('galerie')){
        wp_enqueue_script(
            'gg-gallery-filter',
            get_stylesheet_directory_uri() . '/assets/js/gallery-filter.js',
            [],
            filemtime(get_stylesheet_directory() . '/assets/js/gallery-filter.js'),
            true
        );
    }

}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
