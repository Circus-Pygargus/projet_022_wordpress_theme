<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title(); ?></title>
    <!-- emplacement de chargement des fichiers de style -->
    <?php wp_head(); ?>
</head>

<body>
    <!-- menu bar -->
    <header id="myHeader" class="container-fluid">
        <nav class="container py-4 navbar navbar-expand-lg" role="navigation">
            <div class="row"> 
                <!-- logo -->
                <!-- burger -->
                <button id="myBurger" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#viok-navbar-collapse-1" aria-controls="viok-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                    <span>
                        <svg id="SvgjsSvg1001" width="35" height="35" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                            <defs id="SvgjsDefs1002"></defs>
                                <g id="SvgjsG1008" transform="matrix(0.9167,0,0,0.9167,11.995200000000011,11.995200000000011)">
                                    <!--?xml version="1.0" encoding="UTF-8" standalone="no"?-->
                                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 32 32" width="30" height="30">
                                        <defs>
                                            <style>.cls-1{fill:#ba63c6;}</style>
                                        </defs>
                                        <title>AIS Exp</title>
                                        <path d="M3,9H29a2,2,0,0,0,0-4H3A2,2,0,0,0,3,9Z" style="" fill="#ffffff" class="colorrgb18699198 svgShape"></path>
                                        <path d="M29,14H3a2,2,0,0,0,0,4H29a2,2,0,0,0,0-4Z" style="" fill="#ffffff" class="colorrgb18699198 svgShape"></path>
                                        <path d="M29,23H3a2,2,0,0,0,0,4H29a2,2,0,0,0,0-4Z" style="" fill="#ffffff" class="colorrgb18699198 svgShape"></path>
                                        <metadata>
                                            <rdf:rdf xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#" xmlns:dc="http://purl.org/dc/elements/1.1/">
                                                <rdf:description about="https://iconscout.com/legal#licenses" dc:title="List, Text, Menu, Numbers, String, Burger" dc:description="List, Text, Menu, Numbers, String, Burger" dc:publisher="Iconscout" dc:date="2016-12-14" dc:format="image/svg+xml" dc:language="en">
                                                    <dc:creator>
                                                        <rdf:bag>
                                                            <rdf:li>Kirill Kazachek</rdf:li>
                                                        </rdf:bag>
                                                    </dc:creator>
                                                </rdf:description>
                                            </rdf:rdf>
                                        </metadata>
                                    </svg>
                                </g>
                            </svg>
                    </span>
                </button>
                <a href="/" class="navbar-brand">VINYLE</a>
                <!-- navbar -->
                <!-- <div id="navbarToggler_01" class="collapse navbar-collapse"> -->
                    <!-- <a class="navbar-brand" href='#'>Navbar</a> -->
                        <?php wp_nav_menu( array( 
                                            'theme_location'    => 'header-menu', 
                                            'depth'             => 2,  // 1 = no dropdowns, 2= with dropdowns
                                            'container'         => 'div',
                                            'container_class'   => 'collapse navbar-collapse ml-auto',
                                            'container_id'      => 'navbarTogglerDemo01',
                                            'menu_class'        => 'navbar-nav ml-auto',
                                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                            'walker'            => new WP_Bootstrap_Navwalker()
                        ) );
                    ?>
                <!--<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">HOME<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page_id=71">ACTUS DU VINYLE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vinyle/blues/">BLUES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vinyle/disco/">DISCO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?type-musicaux=Rock">ROCK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?type-musicaux=Jazz">JAZZ</a>
                    </li>
                </ul>-->
            <!-- </div>  -->
                </div> 
        </nav>
    </header>