<?php

namespace Adms\Controllers;

/**
 * Realiza o logout do usuário
 */
class Logout
{
    /**
     * Destrói os dados do usuário previamente logado e o redireciona para a página inicial
     *
     * @return void
     */
    public function index(): void
    {
        unset($_SESSION['user_name'], $_SESSION['user_nickname'], $_SESSION['user_email'], $_SESSION['user_image'], $_SESSION['user_id']);

        $_SESSION['msg'] = "<p style='color: green'>Logout realizado com sucesso!</p>";

        header('Location: ' . URLADM);
    }
}