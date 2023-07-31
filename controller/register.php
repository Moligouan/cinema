<?php

$userDAO = new UserDAO();
$user = null;
$msg = "";
$errMsg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && (!empty($_POST['email']) && !empty($_POST['pw']) && !empty($_POST['username']))) {
    // Vérification email valide
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalidated email. Please enter a proper one.";
    } else {
        $user = new User(null, $_POST['username'], $_POST['email'], $_POST['pw']);
        // Test sur email pour verifier nouvel user n'existe pas dans la BDD (check new return booleen)
        $query = $userDAO->checkNew($user);

        if ($query) {
            $errMsg = "This email already exists. Please type a different one.";
        } // Test si mot de passe et confirmation son les mêmes
        else if ($_POST['pw'] != $_POST['confirmPW']) {
            $msg = "Password not confirmed. Please confirm it correctly.";
        } else {
            $user = $userDAO->add($user);
             //on definit le session.user après l'avoir ajouter a la BDD
            $_SESSION['user'] = $_POST['username'];
            header("Location: films");
        }
    }
}



echo $twig->render('user.html.twig', [
    'msg' => $msg,
    'errMsg' => $errMsg
]);
