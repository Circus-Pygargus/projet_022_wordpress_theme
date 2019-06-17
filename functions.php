<?php

// création de la constante version 
define('VIOKVINYL_VERSION', '1.0.0');

// loads style.css
function viokVinyl_scripts()
{
    /* 5 arguments à wp_enqueue_style:
        un identifiant unique
        le chemin vers le fichier
        un tableau contenant les dépendances du fichier style
        la version 
        le type d'écran sur lesquels sera utilisé le fichier de style
    */
    wp_enqueue_style('viokVinyl_bootstrap-core', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), VIOKVINYL_VERSION, 'all');
    // comme 'viokVinyl_custom' a 'viokVinyl_bootstrap-core' comme dépendance, il pourrait être placé avant lui, mais c'est plus clair ainsi ;)
    wp_enqueue_style('viokVinyl_custom', get_template_directory_uri() . '/style.css', array('viokVinyl_bootstrap-core'), VIOKVINYL_VERSION, 'all');



    // ici true fait appeler le script juste avant la fermeture de la balise body  (et plus besoin de the_post ^^)
    // ces trois sont pour bootstrap
    wp_enqueue_script('viokVinyl_bootstrap-1', 'https://code.jquery.com/jquery-3.3.1.slim.min.js', array(), VIOKVINYL_VERSION, true);
    wp_enqueue_script('viokVinyl_bootstrap-2', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), VIOKVINYL_VERSION, true);
    wp_enqueue_script('viokVinyl_bootstrap-3', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), VIOKVINYL_VERSION, true);
    // ajout de la dépendance jquery comme prévu par wordpress
    wp_enqueue_script('viokVinyl_script', get_template_directory_uri() . '/js/viokVinyle.js', array(), VIOKVINYL_VERSION, true);
}
add_action('wp_enqueue_scripts', 'viokVinyl_scripts');




/**
 * post-type vinyle
 */

function viok_vinyle_post_type()
{

    // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
    $labels = array(
        // Le nom au pluriel
        'name' => _x('Vinyles', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x('Vinyle', 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name' => __('Vinyles'),
        // Les différents libellés de l'administration
        'all_items' => __('Liste des vinyles'),
        'view_item' => __('Voir les vinyles'),
        'add_new_item' => __('Ajouter un nouveau vinyle'),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Editer le vinyle'),
        'update_item' => __('Modifier le vinyle'),
        'search_items' => __('Rechercher un vinyle'),
        'not_found' => __('Non trouvé'),
        'not_found_in_trash' => __('Non trouvée dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre custom post type

    $args = array(
        'label' => __('Vinyles'),
        'description' => __('Tous les vinyles'),
        'labels' => $labels,
        // On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
        //'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'author', 'comments'),
        'supports' => array('thumbnail', 'excerpt'),
        /* 
* Différentes options supplémentaires
*/
        'show_in_rest' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_admin_bar' => true,
        'hierarchical' => false,
        'public' => true,
        'has_archive' => true,
        'rewrite'    => array('slug' => 'vinyle'),

    );

    // On enregistre notre custom post type qu'on nomme ici "recettes" et ses arguments
    register_post_type('vinyles', $args);
}

add_action('init', 'viok_vinyle_post_type', 0);





// initialisation de la meta box
add_action('add_meta_boxes', 'init_metabox_vinyle');

function init_metabox_vinyle()
{
    /**
     *  argument de add_meta_box    /* voir page : https://developer.wordpress.org/reference/functions/add_meta_box/
     *      _ id de la metabox
     *     _ nom affiché de la metabox
     *    _ nom de la fonction qui parametre la metabox
     *        _ screen sur lesquels la box devrait etre affichée
     *   - les suivantes sont optionnelles
     *      _ context, default: advanced
     *     _ priorité high, low, default: default
     *    _ array callback args default null
     */
    add_meta_box('id_metabox_vinyle', 'vinyle', 'marker_metabox_vinyle', 'vinyles', 'normal', 'default');
    
}

    function marker_metabox_vinyle($post)
    {
        // variables
        $titre = get_post_meta($post->ID, 'titre', true);
        // pas l'image
        $date = get_post_meta($post->ID, 'date', true);
        $pressage = get_post_meta($post->ID, 'pressage', true);
        $label = get_post_meta($post->ID, 'label', true);
        $numId = get_post_meta($post->ID, 'numId', true);
        $style = get_post_meta($post->ID, 'style', true);
        $duree = get_post_meta($post->ID, 'duree', true);
        $prix = get_post_meta($post->ID, 'prix', true);
        $description = get_post_meta($post->ID, 'description', true);

        // html
        // style
        echo '<div style="display: flex; flex-direction: column;">';
        // titre
        echo '<label for="titre">Titre de l\'album : </label>';
        echo '<input class="titre" type="text" name="titre" value="' . $titre . '">';
        // image
        // echo '<label for="image">Image : </label>';
        // echo '<input class="image" type="text" name="image" value="'.$image.'">';
        // echo '<img class="image" >'
        // date
        echo '<label for="date">Date : </label>';
        echo '<input class="date" type="text" name="date" value="' . $date . '">';
        // pressage
        echo '<label for="pressage">Pressage : </label>';
        echo '<input class="pressage" type="text" name="pressage" value="' . $pressage . '">';
        // label
        echo '<label for="label">Label : </label>';
        echo '<input class="label" type="text" name="label" value="' . $label . '">';
        // numéro d'identification
        echo '<label for="numId">Numéro d\'identification : </label>';
        echo '<input class="numId" type="text" name="numId" value="' . $numId . '">';
        // genre
        echo '<label for="genre">Genre : </label>';
        echo '<select name="genre">';
        echo '<option ' . selected('blues', $style, false) . 'value="blues">Blues</option>';
        echo '<option ' . selected('disco', $style, false) . 'value="disco">Disco</option>';
        echo '<option ' . selected('rock', $style, false) . 'value="rock">Rock</option>';
        echo '<option ' . selected('jazz', $style, false) . 'value="jazz">Jazz</option>';
        echo '</select>';
        // durée
        echo '<label for="duree">Durée : </label>';
        echo '<input class="duree" type="text" name="duree" value="' . $duree . '">';
        // prix
        echo '<label for="prix">Prix : </label>';
        echo '<input class="prix" type="text" name="prix" value="' . $prix . '">';
        // description
        echo '<label for="description">Description : </label>';
        echo '<textarea class="description" name="description">' . $description . '</textarea>';
        // fin
        echo '</div>';
    }

    /**
     * Meta Box Save
     * 
     * Upload Meta Box Vinyle
     */
    add_action('save_post', 'save_metaboxe_vinyle');
    function save_metaboxe_vinyle($post_ID)
    {
        if (isset($_POST['titre'])) {
            update_post_meta($post_ID, '_titre', esc_html($_POST['titre']));
        }
        if (isset($_POST['image'])) {
            update_post_meta($post_ID, '_image', esc_html($_POST['image']));
        }
        if (isset($_POST['date'])) {
            update_post_meta($post_ID, '_date', esc_html($_POST['date']));
        }
        if (isset($_POST['pressage'])) {
            update_post_meta($post_ID, '_pressage', esc_html($_POST['pressage']));
        }
        if (isset($_POST['label'])) {
            update_post_meta($post_ID, '_label', esc_html($_POST['label']));
        }
        if (isset($_POST['numId'])) {
            update_post_meta($post_ID, '_numId', esc_html($_POST['numId']));
        }
        if (isset($_POST['style'])) {
            update_post_meta($post_ID, '_style', esc_html($_POST['style']));
        }
        if (isset($_POST['duree'])) {
            update_post_meta($post_ID, '_duree', esc_html($_POST['duree']));
        }
        if (isset($_POST['prix'])) {
            update_post_meta($post_ID, '_prix', esc_html($_POST['prix']));
        }
        if (isset($_POST['description'])) {
            update_post_meta($post_ID, '_description', esc_html($_POST['description']));
        }
    }

    /**
     * Taxomony Save
     * 
     * Defined Taxomony Vinyle
     */
        register_taxonomy(
            'genre',
            'vinyles',
            array(
                'label' => 'Genre',
                'labels' => array(
                    'name' => 'Genres',
                    'singular_name' => 'Genre',
                    'all_items' => 'Toutes les genres',
                    'edit_item' => 'Éditer le genre',
                    'view_item' => 'Voir le genre',
                    'update_item' => 'Mettre à jour le genre',
                    'add_new_item' => 'Ajouter un genre',
                    'new_item_name' => 'Nouveau genre',
                    'search_items' => 'Rechercher parmi les genres',
                    'popular_items' => 'Genres les plus utilisées'
                ),
                'hierarchical' => false
            )
        );

        register_taxonomy_for_object_type('genre', 'vinyles');
