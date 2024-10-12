<?php

var_dump($_SESSION);

?>

<p style='color: green'>Bem-vindo(a) <?= $_SESSION['user_name'] ?></p>

<a href='<?= URLADM . '/' . 'Logout' ?>'>Sair</a>