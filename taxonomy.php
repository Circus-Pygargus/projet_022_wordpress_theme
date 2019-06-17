<?php get_header(); ?>

<main>
    <section>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article>
                    <?php the_post(); ?>
                </article>
            <?php endwhile; else : ?>
            <article>
                <p>Aucun vinyle trouvé !</p>
            </article>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>