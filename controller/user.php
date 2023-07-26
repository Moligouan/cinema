<?php

$userDAO = new UserDAO();
$user = null;
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['email']) && isset($_POST['pw']))) {
    $user = new User(null, null, $_POST['email'], $_POST['pw']);

    $user = $userDAO->getOne($user);

    if (gettype($user) == "integer") {
        $msg = "Login error : unknown user";
    } else if ($user == null) {
        $msg = "mot de passe incorrect";
    } else {
        $_SESSION['user'] = $_POST['email'];
        header("Location: films");
    }

}


echo $twig->render('user.html.twig', [
    'users' => $user,
    'msg' => $msg
]);
