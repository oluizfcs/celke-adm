<?php

var_dump($_SESSION);

?>

<p style='color: green'>Bem-vindo(a) <?= $_SESSION['user_name'] ?></p>

<a href='<?= URLADM ?>'>Voltar pra página de login</a>