<?php

namespace Adms\Controllers;

class Dashboard
{
    /** Recebe os dados a serem enviados para a view */
    private array|string|null $data = null;

    /**
     * Instanciar a classe responsável por carregar a view e enviar os dados para a mesma.
     *
     * @return void
     */
    public function index(): void
    {
        echo "Controller - Dashboard<br>";
        
        $loadView = new \Core\ConfigView('adms/Views/dashboard/dashboard', $this->data);
        $loadView->loadView();
    }
}
