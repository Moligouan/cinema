<?php

//On appelle la fonction getAll()
$filmDao = new FilmDAO();
$roleDao = new RoleDAO();
$acteurDao = new ActeurDAO();

// fonction recherche
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["recherche"])) {
    $film = $filmDao->search($_POST["recherche"]);
}
else {
    $film = $filmDao->getAll();
}
// $role = $roleDao->getRole($film[0]->getId());
// $acteur = $acteurDao->getOne($role[0]->getIdAct());
//test de la fonction qui fait correspondre film avec acteur et role
$a = 0;
$b = 0;
while($b <= (count($film)-1)){
    $role = $roleDao->getRole($film[$b]->getId());
    while($a <= (count($role)-1)){
        $acteur = $acteurDao->getOne($role[$a]->getIdAct());
        $role[$a]->setActeur($acteur);
        $film[$b]->addRole($role[$a], $a);
        $a = $a+1;
    }
    $a = $a-$a;
    $b = $b+1;
}   
$test = count($film);

echo $twig->render('films.html.twig', [
    'films' => $film,

    'count' => $b,

]);
