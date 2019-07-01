<?php

get_header();

$post_id = $post->ID;

$term = wp_get_post_terms($post_id, 'type_musicaux');

?>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap">
                <div class="row" id="type-musicaux" data-url="<?php echo get_rest_url(null,
                    '/wp/v2/vinyle_api'); ?>" data-categoryid="<?php echo $term[0]->term_id; ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
