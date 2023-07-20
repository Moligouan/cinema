<?php

$offresDao = new OffresDAO();

$offre = new Offres(null, "JEE Developpeur", "Super job de développeur");

$status = $offresDao->add($offre);


if ($status) {
    $message =  "Ajout OK";
} else {
    $message = "Erreur Ajout";
}


echo $twig->render('creer_offre.html.twig', [
    'message' => $message,
    'offre' => $offre
]);
