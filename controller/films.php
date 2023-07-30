<?php

//On appelle la fonction getAll()
$filmDao = new FilmDAO();

$listFilms = $filmDao->getAll();



//On affiche le template Twig correspondant
echo $twig->render('films.html.twig', [
    'listFilms' => $listFilms,

]);
