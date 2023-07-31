<?php

$userDAO = new UserDAO();
$user = null;
$users = null;
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['email']) && isset($_POST['pw']))) {
    $user = new User(null, null, $_POST['email'], $_POST['pw']);

    $user = $userDAO->getOne($user);
 // Verifie le type de user apres la fonction getOne qui retourne un type pour user (dans la BDD ,si nombre email pas ok, si null mot de passe pas ok )
    if (gettype($user) == "integer") {
        $msg = "Login error : unknown user";
    } else if ($user == null) {
        $msg = "mot de passe incorrect";
    } else {
//on definit session.user (different de register car on ne recupere pas username dans le formulaire mais directement depuis BDD)
        $_SESSION['user'] = $user->getUsername();
        header("Location: films");

    }

}


echo $twig->render('user.html.twig', [
    'msg' => $msg,
]);
