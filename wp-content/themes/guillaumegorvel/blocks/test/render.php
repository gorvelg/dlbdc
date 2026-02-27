<?php
/**
 * @var array $attributes
 * @var string $content
 * @var WP_Block $block
 */


?>
<div class="jm-hello">
    <h3 class="jm-hello__title">test depuis le thème enfant 👋</h3>
    <p class="jm-hello__text">Ce HTML est rendu via <strong>render.php</strong>.</p>
</div>

<?php
$query = new WP_Query([
    'post_type'      => 'programme',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);



if ($query->have_posts()): ?>
    <section class="programmes">
        <h2 class="programmes__title">Programmes</h2>
        <div class="programmes__grid">
            <?php while ($query->have_posts()): $query->the_post(); ?>

                <?php
                    $price = get_field('prix');
                    $description = get_field('description');
                    $title = strtolower(get_field('nom'));
                ?>

                <article class="programmes__card <?php echo $title === 'premium' ? 'is-focus' : ''; ?>">
                    <h3 class="programmes__title"><?php the_title(); ?></h3>
                    <p><?php echo esc_html($price)?> €/mois</p>
                    <p><?= esc_html($description)?></p>
                    <a class="programmes__link" href="<?php the_permalink(); ?>">Voir le programme</a>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
<?php endif; ?>


