<?php

namespace Adms\Controllers;

class ViewUsers
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
        echo "Controller - ViewUsers<br>";

        $this->data = [];

        $loadView = new \Core\ConfigView('adms/Views/users/viewUser', $this->data);
        $loadView->loadView();
    }
}