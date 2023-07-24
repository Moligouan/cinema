<?php

$filmDao = new FilmDAO();

// $film = new Film($_POST['id'], $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']);

// $status = $filmDao->add($film);
// $message = "";
$nfilm = null;
$message = null;
try {

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titre"]) && isset($_POST["realisateur"]) && isset($_POST["affiche"]) && isset($_POST["annee"])) {
        $offre = new Film(null, $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']); // nom de l'offre et description
        $status = $filmDao->add($offre);
        if ($status) {
            $message =  "Ajout OK";
        } else {
            $message = "Erreur Ajout";
        }
    }
} catch (Exception $err) {
    $message = "ERROR : " . $err->getMessage();
}

// if ($status) {
//     $message =  "Ajout OK";
// } else {
//     $message = "Erreur Ajout";
// }


echo $twig->render('creer_film.html.twig', [
    'message' => $message,
    'film' => $nfilm
]);
