<?php

$userDAO = new UserDAO();
$user = null;
$msg = "";
$errMsg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && (!empty($_POST['email']) && !empty($_POST['pw']) && !empty($_POST['username']))) {
    // Vérification de l'écriture de l'email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalidated email. Please enter a proper one.";
    } else {
        $user = new User(null, $_POST['username'], $_POST['email'], $_POST['pw']);
        $query = $userDAO->checkNew($user);

        if ($query) {
            $errMsg = "This email already exists. Please type a different one.";
        } else if ($_POST['pw'] != $_POST['confirmPW']) {
            $msg = "Password not confirmed. Please confirm it correctly.";
        } else {
            $user = $userDAO->add($user);
            $_SESSION['user'] = $_POST['username'];
            header("Location: films");
        }
    }
}



echo $twig->render('user.html.twig', [
    'msg' => $msg,
    'errMsg' => $errMsg
]);
