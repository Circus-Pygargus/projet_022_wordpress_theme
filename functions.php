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
    // leaflet (for map)    
    wp_enqueue_style('viokVinyl_leaflet_style', get_template_directory_uri() . '/leaflet/leaflet.css', array(), VIOKVINYL_VERSION, 'all');
    // comme 'viokVinyl_custom' a 'viokVinyl_bootstrap-core' comme dépendance, il pourrait être placé avant lui, mais c'est plus clair ainsi ;)
    wp_enqueue_style('viokVinyl_custom', get_template_directory_uri() . '/style.css', array('viokVinyl_bootstrap-core'), VIOKVINYL_VERSION, 'all');



    // ici true fait appeler le script juste avant la fermeture de la balise body  (et plus besoin de the_post ^^)
    // ces trois sont pour bootstrap
    wp_enqueue_script('viokVinyl_bootstrap-1', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), VIOKVINYL_VERSION, true);
    wp_enqueue_script('viokVinyl_bootstrap-2', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), VIOKVINYL_VERSION, true);
    wp_enqueue_script('viokVinyl_bootstrap-3', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), VIOKVINYL_VERSION, true);
    // leaflet
    wp_enqueue_script('viokVinyl_leaflet_script', get_template_directory_uri() . '/leaflet/leaflet.js', array(), VIOKVINYL_VERSION, true);
    // ajout de la dépendance jquery comme prévu par wordpress
    wp_enqueue_script('viokVinyl_work_leaflet_script', get_template_directory_uri() . '/js/viokVinyl_work_leaflet_script.js', array(), VIOKVINYL_VERSION, true);
    wp_enqueue_script('viokVinyl_theme_script', get_template_directory_uri() . '/js/theme.js', array(), VIOKVINYL_VERSION, true);
    // script ajax wordpress , lié  à mon script
    wp_localize_script('viokVinyl_ajax_script', 'wpAjaxScript', admin_url('admin_ajax.php'));
}

add_action('wp_enqueue_scripts', 'viokVinyl_scripts');





function viok_add_admin_enqueued_scripts () {

    wp_enqueue_style('viok_vinyle_coordinates_modif_style', get_template_directory_uri() . '/style_admin.css', array(), VIOKVINYL_VERSION, 'all');

    wp_enqueue_script('viok_vinyle_coordinates_modif_script', get_template_directory_uri() . '/js/vinyle_address_form.js', array(), VIOKVINYL_VERSION, true);
}

add_action('admin_enqueue_scripts', 'viok_add_admin_enqueued_scripts');







/**
 * post-type vinyle
 */

function viok_vinyle_post_type()
{
    $labels = [
        'name'                   => _x('Vinyles', 'Post Type General Name', 'vinyle'),
        'singular_name'          => _x('Vinyle', 'Post Type Singular Name', 'vinyle'),
        'menu_name'              => __('Vinyles', 'vinyle'),
        'parent_item_colon'      => __('Parent Vinyle', 'vinyle'),
        'all_items'              => __('Tous les vinyles', 'vinyle'),
        'view_item'              => __('Voir le vinyle', 'vinyle'),
        'add_new_item'           => __('Ajouter un vinyle', 'vinyle'),
        'add_new'                => __('Ajouter un vinyle', 'vinyle'),
        'edit_item'              => __('Editer le vinyle', 'vinyle'),
        'update_item'            => __('Modifier le vinyle', 'vinyle'),
        'search_items'           => __('Rechercher un vinyle', 'vinyle'),
        'not_found'              => __('Aucun vinyle', 'vinyle'),
        'not_found_in_trash'     => __('Aucun vinyle dans la corbeille', 'vinyle'),
    ];


    $args = [
        'label'                 => __('Vinyles', 'vinyle'),
        'description'           => __('Permet de gérer vos vinyles par thèmes', 'vinyle'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menus'         => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-page',
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'rest_base'             => 'vinyle_api'

    ];

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
    /*    echo '<label for="titre">Titre de l\'album : </label>';
        echo '<input class="titre" type="text" name="titre" value="' . $titre . '">';
    */    // image
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
    // echo '<label for="genre">Genre : </label>';
    // echo '<select name="genre">';
    // echo '<option ' . selected('blues', $style, false) . 'value="blues">Blues</option>';
    // echo '<option ' . selected('disco', $style, false) . 'value="disco">Disco</option>';
    // echo '<option ' . selected('rock', $style, false) . 'value="rock">Rock</option>';
    // echo '<option ' . selected('jazz', $style, false) . 'value="jazz">Jazz</option>';
    // echo '</select>';
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
    /*    if (isset($_POST['titre'])) {
            update_post_meta($post_ID, '_titre', esc_html($_POST['titre']));
        } 
        if (isset($_POST['image'])) {
            update_post_meta($post_ID, '_image', esc_html($_POST['image']));
        }*/
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
    // if (isset($_POST['style'])) {
    //     update_post_meta($post_ID, '_style', esc_html($_POST['style']));
    // }
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

function type_vinyle_taxonomy()
{
    $labels = [
        'name'                      => _x('Types musicaux', 'taximony general name'),
        'singular_name'             => _x('Type musical', 'taximony singular name'),
        'search_items'              => __('Rechercher un type musical'),
        'all_items'                 => __('Tous les types musicaux'),
        'parent_item'               => __('Type musical parent'),
        'parent_item_colon'         => __('Type musical parent'),
        'add_new_item'              => __('Ajouter un type musical'),
        'edit_item'                 => __('Editer un type musical', 'vinyle'),
        'update_item'               => __('Modifier un type musical', 'vinyle'),
        'new_item_name'             => __('Nouveau type musical', 'vinyle'),
        'menu_name'                 => __('Type musicaux')
    ];

    $args = [
        'hierarchical'        => true,
        'labels'              => $labels,
        'show_ui'             => true,
        'show_admin_columns'  => true,
        'query_var'           => true,
        'rewrite'             => ['slug' => 'vinyle'],
        'show_in_rest'        => true,
        'query_var'           => true
    ];

    register_taxonomy('type_musicaux', 'vinyles', $args);
}

add_action('init', 'type_vinyle_taxonomy');



function vinyle_rest_api_custom_values () {

    register_rest_field(
        'vinyles',
        'vinyles_meta',
        array(
            'get_callback'  => 'vinyles_meta_information',
            'schema'        => null,
            'update_callback'   => null
        )
    );

    register_rest_field(
        'vinyles',
        'vinyles_taxonomies',
        array(
            'get_callback'  => 'vinyles_taxonomies_information',
            'schema'        => null,
            'update_callback'   => null
        )
    );

    register_rest_field(
        'vinyles',
        'vinyles_term_type_musicaux',
        array(
            'get_callback'  => 'vinyles_term_type_musicaux',
            'schema'        => null,
            'update_callback'   => null
        )
    );
}

function vinyles_meta_information () {
    global $post;
    $post_id = $post->ID;
    return get_post_meta($post_id);
}

function vinyles_taxonomies_information () {
    global $post;
    return get_object_taxonomies($post);
}

function vinyles_term_type_musicaux () {
    global $post;
    $post_id = $post->ID;
    return wp_get_post_terms($post_id, 'type_musicaux');
}

add_action('rest_api_init', 'vinyle_rest_api_custom_values');


// theme support ajout thumbnails (image à la une) dans création de post
add_theme_support('post-thumbnails');



// my menu
function register_my_menu()
{
    register_nav_menu('header-menu', __('Header Menu'));
}

add_action('init', 'register_my_menu');

// for a working bootstrap menu burger
// register custom navigation walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';






// add a custom menu to dashboard
/**
 * Register a custom menu page.
 */
// here we want to be able to change and save in db the address used in home page's map

add_action('admin_init', 'register_viok_vinyle_address_modifier');
add_action('admin_menu', 'viok_admin_address_modifier');

function register_viok_vinyle_address_modifier () {
    register_setting('viok_vinyle_address_modifier', 'viok_vinyle_address');
    register_setting('viok_vinyle_address_modifier', 'viok_vinyle_latitude');
    register_setting('viok_vinyle_address_modifier', 'viok_vinyle_longitude');
}

function viok_admin_address_modifier () {
    add_menu_page(
        'Changement de l\'adresse de la map situé en page d\'accueil',
        'Changer l\'adresse',
        'manage_options',
        'viok_vinyle_address_change',
        'viok_vinyle_map_address_build_form', // appel construction form
        'dashicons-location-alt',
        6
    );
}

function viok_vinyle_map_address_build_form () {

    // le script correspondant à ce formulaire se trouve dans js/vinyle_address_form.js et est appelé par viok_add_admin_enqueued_scripts() 
        
    echo '<h2>Entrez la nouvelle adresse</h2>';
    echo '<div class="viok_form_div">';
    echo    '<form method="post" action="options.php">';

    echo    settings_fields("viok_vinyle_address_modifier");
    echo    do_settings_sections("viok_vinyle_address_modifier");

    echo        '<div class="form-group">';
    echo            '<label for="viok_address">Nouvelle adresse</label>';
    echo            '<input type="text" class="form-control" id="viok_address" name="viok_vinyle_address" placeholder="' . esc_attr(get_option('viok_vinyle_address')) . '">';
    echo        '</div>';

    echo        '<div id="viok_get_coordinates_button">Récupérer les coordonnées</div>';

    echo        '<div id="hidden_lat_long_but_div" hidden="true">';
    echo            '<div class="form-group">';
    echo                '<label for="viok_latitude">Latitude</label>';
    echo                '<input type="text" class="form-control" id="viok_latitude" name="viok_vinyle_latitude" value="' . esc_attr(get_option('viok_vinyle_latitude')) . '">';
    echo            '</div>';

    echo            '<div class="form-group">';
    echo                '<label for="viok_longitude">Longitude</label>';
    echo                '<input type="text" class="form-control" id="viok_longitude" name="viok_vinyle_longitude" value="' . esc_attr(get_option('viok_vinyle_longitude')) . '">';
    echo            '</div>';

    echo            submit_button();
    echo        '</div>';

    echo    '</form>';
    echo '</div>';
}




// pour le formulaire de la page d'accueil

function vinyle_save_contact () {
    global $wpdb;
//var_dump($_POST);die();
    if ( isset($_POST['message-submit']) && $_POST['hidden'] === "1") {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_text_field($_POST['message']);

        $admin_email = get_option('admin-email');
        $headers = "From: \"".$name."\" <".$email.">\r\n";

        $envoie = wp_mail($admin_email, 'Message depuis le site', $message, $headers);

        $textSend = ($envoie === true)? 'sent': 'notSent';

        global $wp;
        $wp->add_query_var('send');
        $url = get_page_by_title('home');
      //  var_dump($url); die();
        wp_redirect(get_permalink($url).'?send='.$textSend);

        exit();
    }
}

add_action('init', 'vinyle_save_contact');