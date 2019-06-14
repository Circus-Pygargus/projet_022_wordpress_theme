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

