<?php
/**
 * blocks/clients/render.php
 */

$posts_to_show = isset($attributes['postsToShow']) ? (int) $attributes['postsToShow'] : 12;

$q = new WP_Query([
    'post_type'      => 'client',
    'posts_per_page' => $posts_to_show,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if (!$q->have_posts()) {
    return '<p>Aucun client.</p>';
}

 ?>
    <div class="trust-clients">
        <div class="swiper gg-clients-swiper">
            <div class="swiper-wrapper">
        <?php while ($q->have_posts()) : $q->the_post(); ?>
            <?php
                $post_id = get_the_ID();

                $nom  = function_exists('get_field') ? get_field('nom', $post_id) : '';
                $logo = function_exists('get_field') ? get_field('logo', $post_id) : null;

            ?>

                    <div class="swiper-slide">
                        <?php if (!$logo) : ?>
                            <div class="is-logo-empty">
                                <p><?= esc_html($nom) ?></p>
                            </div>
                        <?php else : ?>
                            <?= wp_get_attachment_image($logo['ID'], 'medium'); ?>
                        <?php endif ?>
                    </div>

        <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
    </div>




