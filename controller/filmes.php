<?php

//On appelle la fonction getAll()
$offresDao = new FilmDAO();

$offers = $offresDao->getAll();

//On affiche le template Twig correspondant
echo $twig->render('films.html.twig', [
    'offers' => $offers
]);
