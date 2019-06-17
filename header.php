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
        <nav class="container py-4 navbar navbar-expand-lg">
            <!--   <div class="row">  -->
            <!-- logo -->
            <a href="#" class="navbar-brand">VINYLE</a>
            <!-- burger -->
            <button id="myBurger" class="navbar-toggler" type="button" data-toggler="collapse" data-target="#navbarToggler_01" aria-controls="navbarToggler_01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- navbar -->
            <div id="navbarToggler_01" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#myHeader">HOME<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ACTUS DU VINYLE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">BLUES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">DISCO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ROCK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">JAZZ</a>
                    </li>
                </ul>
            </div>
            <!--   </div>  -->
        </nav>
    </header>