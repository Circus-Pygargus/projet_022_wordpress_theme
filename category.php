<?php
/* ce fichier sert à afficher le contenu de la page affichée par un clic sur Actus */
get_header();
?>

<section>
<div class="row">
    <div class="col-12">
        <div id="actu" data-url="<?php echo get_rest_url(null, '/wp/v2/posts'); ?>" data-categoryid="<?php echo get_query_var('cat'); ?>">
            <!-- liste des articles -->
        </div>
    </div>
</div>
</section>

<?php 
wp_footer(); 
?>