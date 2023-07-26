<?php

$filmDao = new FilmDAO();
$roleDao = new RoleDAO();
$acteurDao = new ActeurDAO();

// $film = new Film($_POST['id'], $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']);

// $status = $filmDao->add($film);
// $message = "";
$film = null;
$message = null;

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titre"]) && isset($_POST["realisateur"]) && isset($_POST["affiche"]) && isset($_POST["annee"]) && isset($_POST["nom_1"]) && isset($_POST["prenom_1"]) && isset($_POST["personnage_1"])) {
        if (($filmDao->checkfilm($_POST['titre'], $_POST['realisateur'], $_POST['annee'])) == 1){
            $film = new Film($filmDao->fillid(), $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee']); // nom de l'offre et description
            $status = $filmDao->add($film);
            $stratus = actperso(1, $film, $acteurDao, $roleDao);

            if (isset($_POST["nom_2"]) && isset($_POST["prenom_2"]) && isset($_POST["personnage_2"])){
                $stratus = actperso(2, $film, $acteurDao, $roleDao);
            }

            if (isset($_POST["nom_3"]) && isset($_POST["prenom_3"]) && isset($_POST["personnage_3"])){
                $stratus = actperso(3, $film, $acteurDao, $roleDao);
            }

            if ($status && $stratus) {
                $message =  "Ajout OK";
            } else {
                $message = "Erreur Ajout";
            }
        }
        else{
            $message = "Film déjà existant";
        }
    }
} catch (Exception $err) {
    $message = "ERROR : " . $err->getMessage();
}

echo $twig->render('creer_film.html.twig', [
    'message' => $message,
    'film' => $film
]);


function actperso($num, $film, $acteurDao, $roleDao){
    if (($acteurDao->checkact($_POST['nom_'.$num], $_POST['prenom_'.$num])) == NULL){
        ${'acteur'.$num} = new Acteur($acteurDao->fillid(), $_POST['nom_'.$num], $_POST['prenom_'.$num]);
        $stactus = $acteurDao->add(${'acteur'.$num});
    }
    else {
        ${'acteur'.$num} = $acteurDao->checkact($_POST['nom_'.$num], $_POST['prenom_'.$num]);
    }
    ${'role'.$num} = new Role($roleDao->fillid(), $_POST['personnage_'.$num], ${'acteur'.$num}->getId(), $film->getId());
    $stratus = $roleDao->add(${'role'.$num});

}
