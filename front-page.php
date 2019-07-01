<?php get_header(); ?>
    <main>
        <!-- carousel -->
        <section id="carousel_section" class="container-fluid">
            <div class="myCarousel container">
                <div id="myCarouselCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarouselCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarouselCaptions" data-slide-to="1"></li>
                        <li data-target="#myCarouselCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php // 1. on défini ce que l'on veut
                                $args = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 3,                                    
                                    'post_status' => 'publish',
                                    'order' => 'DESC',
                                    'orderby' => 'post_date'
                                );

                                // 2. on exécute la query
                                $slider_query = new WP_Query($args);

                            //    var_dump($slider_query);

                                // 3. on lance la boucle !
                                 // compteur pour l'activ de la première carousel-item
                                 $i = 0;

                                 if ( $slider_query->have_posts() ) : while ( $slider_query->have_posts() ) : $slider_query->the_post();

                                 // 4. on affiche selon les besoin
                        ?>
                                    
                                
                                <?php if ($i === 0) {
                                    echo '<div class="carousel-item active">';
                                    }
                                    else {
                                        echo '<div class="carousel-item">';
                                    }
                                    $i++;
                                ?>

                                    <img src="wp-content\themes\viok_vinyl\img\albums\janis_joplin_move_over.jpeg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </div>

                                <?php endwhile;
                                    endif;

                                // 4. On réinitialise à la requête principale (important)
                                    wp_reset_query(); 
                                ?>
                    </div>
                    <!-- les flèches de contrôle (< et >) du carousel -->
                    <a class="carousel-control-prev" href="#myCarouselCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarouselCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>

        <section class="container-fluid" id="contact_section">
            <div class="container">
                <!-- vignettes types-musicaux -->
                <div class="row" id="taxo_links">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 home-category-link_div">
                        <!-- image en css pour histoire de taille ;) -->
                        <div class="taxo_img" id="blues-img"><a href="/vinyle/blues/"></a></div>
                        <a href="/vinyle/blues/">BLUES</a>
                                <?php                 
                                    $args = array(
                                                'post_type' => 'vinyles',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'type_musicaux',
                                                        'field'    => 'slug',
                                                        'terms'    => 'blues',
                                                    ),
                                                ),
                                            ); 
                                    $the_query = new WP_Query( $args );                            

                                   $totalpost = $the_query->found_posts; ?>
                        <p class="nbr-vinyles"><?php echo $totalpost ?> Titres</p>
                                   <?php
                            // 4. On réinitialise à la requête principale (important)
                                wp_reset_query(); 
                            ?>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <!-- image en css pour histoire de taille ;) -->
                        <div class="taxo_img" id="disco-img"><a href="/vinyle/disco/"></a></div>
                        <a href="/vinyle/disco/">Disco</a>
                                <?php                 
                                    $args = array(
                                                'post_type' => 'vinyles',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'type_musicaux',
                                                        'field'    => 'slug',
                                                        'terms'    => 'disco',
                                                    ),
                                                ),
                                            ); 
                                    $the_query = new WP_Query( $args );
                            

                                   $totalpost = $the_query->found_posts; ?>
                        <p class="nbr-vinyles"><?php echo $totalpost ?> Titres</p>
                                   <?php
                            // 4. On réinitialise à la requête principale (important)
                                wp_reset_query(); 
                            ?>
                    </div>


                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <!-- image en css pour histoire de taille ;) -->
                        <div class="taxo_img" id="rock-img"><a href="/vinyle/rock/"></a></div>
                        <a href="/vinyle/rock/">Rock</a>
                                <?php                 
                                    $args = array(
                                                'post_type' => 'vinyles',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'type_musicaux',
                                                        'field'    => 'slug',
                                                        'terms'    => 'rock',
                                                    ),
                                                ),
                                            ); 
                                    $the_query = new WP_Query( $args );
                            

                                   $totalpost = $the_query->found_posts; ?>
                        <p class="nbr-vinyles"><?php echo $totalpost ?> Titres</p>
                                   <?php
                            // 4. On réinitialise à la requête principale (important)
                                wp_reset_query(); 
                            ?>
                    </div>


                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <!-- image en css pour histoire de taille ;) -->
                        <div class="taxo_img" id="jazz-img"><a href="/vinyle/jazz/"></a></div>
                        <a href="/vinyle/jazz/">Jazz</a>
                                <?php                 
                                    $args = array(
                                                'post_type' => 'vinyles',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'type_musicaux',
                                                        'field'    => 'slug',
                                                        'terms'    => 'jazz',
                                                    ),
                                                ),
                                            ); 
                                    $the_query = new WP_Query( $args );
                            

                                   $totalpost = $the_query->found_posts; ?>
                        <p class="nbr-vinyles"><?php echo $totalpost ?> Titres</p>
                                   <?php
                            // 4. On réinitialise à la requête principale (important)
                                wp_reset_query(); 
                            ?>
                    </div>
                </div>

                <!-- form + map -->
                <div class="row">
                    <!-- contact form -->
                    <div id="contact-mother-div" class=" col-12 col-sm-12 col-md-5 col-lg-5 col-xl-6">
                        <div id="contact-form">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" aria-describedby="eamilHelp" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="eamilHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" rows="3" class="form-control"></textarea>
                                </div>
                                <input name="message-submit" type="submit" class="btn btn-primary mb-2" value="Send">
                                <input type="hidden" name="hidden" value="1">
                            </form>
                            <?php if (isset($_GET['send']) && $_GET['send'] === 'sent') {
                                    echo 'Votre mail est bien parti !'; 
                                }
                                else if (isset($_GET['send']) && $_GET['send'] === 'notSent') {
                                    echo 'Le serveur de mail ne fonctionne plus ! Désolé';
                                }
                            ?>
                        </div>
                        
                        
                        <!-- ajouter un id et un padding coté centre de row sur les 2 col pour séparer proprement -->
                    </div>
                    <!-- google map -->
                    <div id="map-mother-div" class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-6 ml-auto">
                        <div id="leaflet-map" data-latitude="<?php echo get_option('viok_vinyle_latitude') ?>" data-longitude="<?php echo get_option('viok_vinyle_longitude') ?>"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>




    <!--
    <div id="bgRef"></div>  -->

    <!-- emplacement de chargement des fichiers scripts -->
    <?php get_footer(); ?>