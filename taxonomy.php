<?php get_header(); ?>

<!--  PLUS BESOIN !!! REMPLAC2 PAR TAXONOMY-TYPE_MUSICAUX.PHP -->

<main>
    <section>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php echo(get_the_title()); ?></a></h2>
                    By: <?php the_author(); ?>
                </article>
            <?php endwhile; else : ?>
            <article>
                <p>Aucun vinyle trouvé !</p>
            </article>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>