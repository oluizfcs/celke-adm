<?php

namespace Adms\Controllers;

class Login
{
    /** Recebe os dados a serem enviados para a view */
    private array|string|null $data;

    /**
     * Instanciar a classe responsável por carregar a view e enviar os dados para a mesma.
     *
     * @return void
     */
    public function index(): void
    {
        echo 'Controller - Login<br>';

        $this->data = null;

        $loadView = new \Core\ConfigView('adms/Views/login/login', $this->data);
        $loadView->loadView();
    }
}