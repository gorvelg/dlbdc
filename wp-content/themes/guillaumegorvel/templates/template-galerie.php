<?php
/*
Template Name: Galerie
*/
wp_head();
echo do_blocks('<!-- wp:template-part {"slug":"dlbdc-header-menu","theme":"guillaumegorvel","area":"header"} /-->');

function gg_extract_gallery_ids($blocks) {
    $ids = [];

    foreach ($blocks as $block) {
        if (empty($block['blockName'])) {
            continue;
        }

        if ($block['blockName'] === 'core/gallery') {
            if (!empty($block['attrs']['ids']) && is_array($block['attrs']['ids'])) {
                $ids = array_merge($ids, $block['attrs']['ids']);
            }

            if (!empty($block['innerBlocks']) && is_array($block['innerBlocks'])) {
                foreach ($block['innerBlocks'] as $inner_block) {
                    if (
                        !empty($inner_block['blockName']) &&
                        $inner_block['blockName'] === 'core/image' &&
                        !empty($inner_block['attrs']['id'])
                    ) {
                        $ids[] = (int) $inner_block['attrs']['id'];
                    }
                }
            }
        }

        if (!empty($block['innerBlocks']) && is_array($block['innerBlocks'])) {
            $ids = array_merge($ids, gg_extract_gallery_ids($block['innerBlocks']));
        }
    }

    return array_unique(array_filter($ids));
}
?>

    <main class="wp-block-group main-content has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">
        <?php while (have_posts()) : the_post(); ?>

            <?php
            $media_taxonomy    = 'attachment_category';
            $content           = get_the_content();
            $blocks            = parse_blocks($content);
            $gallery_image_ids = gg_extract_gallery_ids($blocks);
            $used_terms        = [];

            if (!empty($gallery_image_ids)) {
                foreach ($gallery_image_ids as $image_id) {
                    $terms = get_the_terms($image_id, $media_taxonomy);

                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            $used_terms[$term->term_id] = $term;
                        }
                    }
                }
            }
            ?>


            <div class="wp-block-group alignfull has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">
                <div class="entry-content alignfull wp-block-post-content is-layout-flow wp-block-post-content-is-layout-flow">
                    <div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">
                <?php if (!empty($gallery_image_ids)) : ?>
                    <section class="wp-block-group alignfull has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">
                        <header class="wp-block-group  page-header gallery-header">
                            <h1>Découvrez la galerie</h1>
                            <p></p>
                        </header>
                        <div class="wp-block-group gallery-filters is-nowrap is-layout-flex wp-block-group-is-layout-flex" aria-label="Filtres de galerie">
                            <button type="button" class="is-active" data-filter="all">Tout</button>

                            <?php foreach ($used_terms as $term) : ?>
                                <button type="button" data-filter="<?php echo esc_attr($term->slug); ?>">
                                    <?php echo esc_html($term->name); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>

                        <div class="wp-block-group gallery-grid is-nowrap is-layout-flex wp-block-group-is-layout-flex">
                            <?php foreach ($gallery_image_ids as $image_id) : ?>
                                <?php
                                $terms    = get_the_terms($image_id, $media_taxonomy);
                                $slugs    = [];
                                $names    = [];
                                $caption  = wp_get_attachment_caption($image_id);
                                $full_url = wp_get_attachment_image_url($image_id, 'full');

                                if ($terms && !is_wp_error($terms)) {
                                    foreach ($terms as $term) {
                                        $slugs[] = $term->slug;
                                        $names[] = $term->name;
                                    }
                                }
                                ?>
                                <figure
                                        class="gallery-item"
                                        data-category="<?php echo esc_attr(implode(' ', $slugs)); ?>"
                                >
                                    <span class="tag"><?= esc_attr(implode(' ', $names)); ?></span>
                                    <a href="<?php echo esc_url($full_url); ?>" class="gallery-link">
                                        <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                                    </a>

                                    <?php if (!empty($caption)) : ?>
                                        <figcaption class="gallery-caption">
                                            <?php echo esc_html($caption); ?>
                                        </figcaption>
                                    <?php endif; ?>
                                </figure>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php endwhile; ?>
                    </div>
                </div>
            </div>

    </main>

<?php
echo do_blocks('<!-- wp:template-part {"slug":"footer","theme":"guillaumegorvel"} /-->');
wp_footer();
?>