<?php

//On appelle la fonction getAll()
$offresDao = new FilmDAO();

$offers = $offresDao->getAll();

//On affiche le template Twig correspondant
echo $twig->render('offres.html.twig', [
    'offers' => $offers
]);
