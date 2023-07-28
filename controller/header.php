<?php
if (!empty($_SESSION)) {
    echo $twig->render('header.html.twig', [
        'users' => $_SESSION['user'],


    ]);
} else {
    echo $twig->render('header.html.twig');

}
