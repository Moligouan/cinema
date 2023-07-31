<?php
//remise a null de session.user
unset($_SESSION['user']);
header('Location: films');
